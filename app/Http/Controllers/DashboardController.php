<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Summary;
use App\Models\Pengajuan;
use App\Models\Sektor;
use App\Models\Laporan;
use App\Helpers\FormatHelperFull;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PDF;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Laporan::query();

        // Total Proyek CSR
        $jumlahProyek = Proyek::where('status', 'terbit')->count();

        // Jumlah Mitra Bergabung
        $jumlahMitra = User::where('level', 'mitra')->count();

        // Dana Realisasi CSR
        $totalDanaRealisasi = Laporan::where('status', 'terbit')->sum('realisasi');
        $formattedDanaRealisasiFull = FormatHelperFull::formatRupiahFull($totalDanaRealisasi);
        $formattedDanaRealisasi = FormatHelper::formatRupiah($totalDanaRealisasi);

        // Proyek Terealisasi
        $jumlahProyekTerealisasi = Proyek::whereHas('laporan', function($query) {
            $query->where('status', 'terbit');
        })->count();

        // Data untuk grafik
        $sektors = Sektor::all();
        
        // Hitung total realisasi untuk setiap sektor
        $totalRealisasi = Laporan::where('status', 'terbit')->sum('realisasi');
        
        $data = $sektors->map(function($sektor) use ($totalRealisasi) {
            $realisasiSektor = Laporan::where('id_sektor', $sektor->id)
                                      ->where('status', 'terbit')
                                      ->sum('realisasi');
            $persentase = $totalRealisasi > 0 ? ($realisasiSektor / $totalRealisasi) * 100 : 0;
            return round($persentase, 2);
        });
        
        $dataJumlah = $sektors->map(function($sektor) {
            return intval(Laporan::where('id_sektor', $sektor->id)->where('status', 'terbit')->count());
        });
        
        $categories = $sektors->pluck('nama_sektor');

        // Fetch All Data
        $summary = Summary::all();
        $laporan = Laporan::all();
        $pengajuan = Pengajuan::all();

        // Notifications Filter
        $user = auth()->user();
        // mengambil
        $laporan_admin = Laporan::where('created_at', '>', $user->created_at)
                ->get();  
        $pengajuan_notif = Pengajuan::where('created_at', '>', $user->created_at)
                ->get();  
        $summary_notif = Summary::where('created_at', '>', $user->created_at)
                ->get();
        $laporan_notif = Laporan::where('id_user', $user->id)
                ->whereIn('status', ['revisi', 'tolak', 'terbit'])
                ->orderBy('created_at', 'desc') // Ensure it orders by creation time
                ->get();
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  
        
        // Data untuk pie-chart: persentase realisasi per sektor
        $pieData = $data;
        $pieCategories = $categories;

        // Data untuk bar-chart-2: 5 mitra dengan jumlah laporan terbit terbanyak
        $topMitras = User::where('level', 'mitra')
            ->withCount(['laporan' => function ($query) {
                $query->where('status', 'terbit');
            }])
            ->orderByDesc('laporan_count')
            ->take(5)
            ->get();

        $topMitraNames = $topMitras->pluck('name')->toArray();
        $topMitraLaporanCounts = $topMitras->pluck('laporan_count')->toArray();

        // Jika data kurang dari 5, tambahkan data kosong
        while (count($topMitraNames) < 5) {
            $topMitraNames[] = 'Tidak Ada Data';
            $topMitraLaporanCounts[] = 0;
        }

        // Data untuk bar-chart-3: Semua kecamatan dengan jumlah realisasi terbit
        $laporanPerKecamatan = Proyek::select('lokasi')
            ->join('laporans', 'proyeks.id', '=', 'laporans.id_proyek')
            ->where('laporans.status', 'terbit')
            ->selectRaw('proyeks.lokasi, SUM(laporans.realisasi) as total_realisasi')
            ->groupBy('proyeks.lokasi')
            ->orderByDesc('total_realisasi')
            ->get();

        $kecamatanNames = $laporanPerKecamatan->pluck('lokasi')->toArray();
        $totalRealisasiValues = $laporanPerKecamatan->pluck('total_realisasi')->toArray();

        // Jika data kurang dari 5, tambahkan data kosong sampai mencapai 5 data
        while (count($kecamatanNames) < 5) {
            $kecamatanNames[] = 'Tidak Ada Data';
            $totalRealisasiValues[] = 0;
        }

        if ($user->level === 'admin') {
            $query->with(['user', 'proyek'])->where('status', '!=', 'draf');
        } elseif ($user->level === 'mitra') {
            $query->where('id_user', $user->id)->with('proyek');
        }

        // Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul_laporan', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('proyek', function($query) use ($searchTerm) {
                      $query->where('lokasi', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhere('realisasi', 'LIKE', "%{$searchTerm}%");
            });
        }

        $laporans = $query->latest()->paginate(10)->withQueryString();

        // Format data laporan
        $laporans->getCollection()->transform(function ($laporan) {
            $laporan->formatted_realisasi = 'Rp ' . number_format($laporan->realisasi, 0, ',', '.');
            $laporan->formatted_lokasi = $laporan->proyek->lokasi ?? 'Tidak ada lokasi';
            $laporan->formatted_tgl_realisasi = $laporan->tanggal . ' ' . $laporan->bulan . ' ' . $laporan->tahun;
            $laporan->formatted_tgl_laporan = $laporan->created_at->format('d M Y');
            return $laporan;
        });

        return view('dashboard', compact(
            'laporans',
            'jumlahProyek',
            'jumlahMitra',
            'formattedDanaRealisasi',
            'formattedDanaRealisasiFull',
            'jumlahProyekTerealisasi',
            'categories', // Ini menggantikan $kategori
            'data',
            'dataJumlah',
            'pieCategories',
            'pieData',
            'topMitraNames',
            'topMitraLaporanCounts',
            'kecamatanNames',
            'totalRealisasiValues',
            'summary',
            'laporan',
            'pengajuan',
            'pengajuan_notif',
            'summary_notif',
            'laporan_notif',
            'laporan_admin',
            'all_notifications'
        ));
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:tolak,revisi,terbit',
            'pesan_admin' => 'required_unless:status,terbit',
        ]);

        $laporan->status = $request->status;
        $laporan->pesan_admin = $request->pesan_admin;
        $laporan->save();

        return response()->json(['message' => 'Status laporan berhasil diperbarui']);
    }

    public function downloadAdminPdf()
    {
        $data = $this->getDataForExport();
        $pdf = PDF::loadView('pdf.admin_dashboard', $data);
        return $pdf->download('admin_dashboard.pdf');
    }

    public function downloadAdminCsv()
    {
        $data = $this->getDataForExport();
        $csvFileName = 'admin_dashboard.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Statistik Umum
            fputcsv($file, ['Statistik Umum']);
            fputcsv($file, ['Total Proyek CSR', $data['jumlahProyek']]);
            fputcsv($file, ['Proyek Terealisasi', $data['jumlahProyekTerealisasi']]);
            fputcsv($file, ['Dana Realisasi CSR Mitra', $data['formattedDanaRealisasiFull']]);
            fputcsv($file, []);

            // Data per Sektor
            fputcsv($file, ['Data per Sektor']);
            fputcsv($file, ['Nama Sektor', 'Persentase', 'Jumlah Laporan']);
            foreach ($data['categories'] as $index => $category) {
                fputcsv($file, [$category, $data['pieData'][$index] . '%', $data['dataJumlah'][$index]]);
            }
            fputcsv($file, []);

            // Top 5 Mitra
            fputcsv($file, ['Top 5 Mitra']);
            fputcsv($file, ['Nama Mitra', 'Jumlah Laporan']);
            foreach ($data['topMitraNames'] as $index => $name) {
                fputcsv($file, [$name, $data['topMitraLaporanCounts'][$index]]);
            }
            fputcsv($file, []);

            // Data per Kecamatan
            fputcsv($file, ['Data per Kecamatan']);
            fputcsv($file, ['Kecamatan', 'Total Realisasi']);
            foreach ($data['kecamatanNames'] as $index => $kecamatan) {
                fputcsv($file, [$kecamatan, $data['totalRealisasiValues'][$index]]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadMitraPdf()
    {
        $laporans = Laporan::where('id_user', auth()->id())->get();
        $chartData = $this->getChartData();
        $pdf = PDF::loadView('pdf.mitra_dashboard', compact('laporans', 'chartData'));
        return $pdf->download('mitra_dashboard.pdf');
    }

    public function downloadMitraCsv()
    {
        $laporans = Laporan::where('user_id', auth()->id())->get();
        $chartData = $this->getChartData();
        $csvFileName = 'mitra_dashboard.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Judul Laporan', 'Realisasi', 'Tanggal', 'Status'];

        $callback = function() use ($laporans, $chartData, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($laporans as $laporan) {
                fputcsv($file, [$laporan->id, $laporan->judul_laporan, $laporan->realisasi, $laporan->tanggal, $laporan->status]);
            }

            // Add chart data
            fputcsv($file, ['']);
            fputcsv($file, ['Chart Data']);
            foreach ($chartData as $key => $value) {
                fputcsv($file, [$key, json_encode($value)]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getChartData()
    {
        $sektors = Sektor::all();
        $totalRealisasi = Laporan::where('status', 'terbit')->sum('realisasi');
        
        $data = $sektors->map(function($sektor) use ($totalRealisasi) {
            $realisasiSektor = Laporan::where('id_sektor', $sektor->id)
                                      ->where('status', 'terbit')
                                      ->sum('realisasi');
            $persentase = $totalRealisasi > 0 ? ($realisasiSektor / $totalRealisasi) * 100 : 0;
            return round($persentase, 2);
        });
        
        $dataJumlah = $sektors->map(function($sektor) {
            return intval(Laporan::where('id_sektor', $sektor->id)->where('status', 'terbit')->count());
        });
        
        $categories = $sektors->pluck('nama_sektor');

        $topMitras = User::where('level', 'mitra')
            ->withCount(['laporan' => function ($query) {
                $query->where('status', 'terbit');
            }])
            ->orderByDesc('laporan_count')
            ->take(5)
            ->get();

        $topMitraNames = $topMitras->pluck('name')->toArray();
        $topMitraLaporanCounts = $topMitras->pluck('laporan_count')->toArray();

        $laporanPerKecamatan = Proyek::select('lokasi')
            ->join('laporans', 'proyeks.id', '=', 'laporans.id_proyek')
            ->where('laporans.status', 'terbit')
            ->selectRaw('proyeks.lokasi, SUM(laporans.realisasi) as total_realisasi')
            ->groupBy('proyeks.lokasi')
            ->orderByDesc('total_realisasi')
            ->get();

        $kecamatanNames = $laporanPerKecamatan->pluck('lokasi')->toArray();
        $totalRealisasiValues = $laporanPerKecamatan->pluck('total_realisasi')->toArray();

        return [
            'categories' => $categories,
            'data' => $data,
            'dataJumlah' => $dataJumlah,
            'pieData' => $data,
            'pieCategories' => $categories,
            'topMitraNames' => $topMitraNames,
            'topMitraLaporanCounts' => $topMitraLaporanCounts,
            'kecamatanNames' => $kecamatanNames,
            'totalRealisasiValues' => $totalRealisasiValues,
        ];
    }

    private function getDataForExport()
    {
        return [
            'jumlahProyek' => Proyek::where('status', 'terbit')->count(),
            'jumlahProyekTerealisasi' => Proyek::whereHas('laporan', function($query) {
                $query->where('status', 'terbit');
            })->count(),
            'formattedDanaRealisasiFull' => FormatHelperFull::formatRupiahFull(Laporan::where('status', 'terbit')->sum('realisasi')),
            'categories' => $this->getChartData()['categories'],
            'pieData' => $this->getChartData()['pieData'],
            'dataJumlah' => $this->getChartData()['dataJumlah'],
            'topMitraNames' => $this->getChartData()['topMitraNames'],
            'topMitraLaporanCounts' => $this->getChartData()['topMitraLaporanCounts'],
            'kecamatanNames' => $this->getChartData()['kecamatanNames'],
            'totalRealisasiValues' => $this->getChartData()['totalRealisasiValues'],
        ];
    }
}