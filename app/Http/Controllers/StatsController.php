<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyek;
use App\Models\Summary;
use App\Models\Sektor;
use App\Models\Laporan;
use App\Models\User;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Total Proyek CSR
        $jumlahProyek = Proyek::where('status', 'terbit')->count();

        // Jumlah Mitra Bergabung
        $jumlahMitra = User::where('level', 'mitra')->count();

        // Dana Realisasi CSR
        $totalDanaRealisasi = Laporan::where('status', 'terbit')->sum('realisasi');
        $formattedDanaRealisasi = FormatHelper::formatRupiah($totalDanaRealisasi);

        // Proyek Terealisasi
        $jumlahProyekTerealisasi = Proyek::whereHas('laporan', function($query) {
            $query->where('status', 'terbit');
        })->count();

        // Data untuk grafik
        $sektors = Sektor::all();
        
        // Hitung total realisasi untuk setiap sektor
        $data = $sektors->map(function($sektor) {
            return intval(Laporan::where('id_sektor', $sektor->id)->where('status', 'terbit')->sum('realisasi'));
        });
        
        $dataJumlah = $sektors->map(function($sektor) {
            return intval(Laporan::where('id_sektor', $sektor->id)->where('status', 'terbit')->count());
        });
        
        $categories = $sektors->pluck('nama_sektor');
        
        // Data untuk pie-chart: jumlah laporan per sektor
        $pieData = $data; // Menggunakan data yang sudah dihitung sebelumnya
        $pieCategories = $categories; // Menggunakan categories yang sudah didefinisikan sebelumnya

        // Data untuk pie-chart-2: jumlah laporan per mitra
        $mitraData = Laporan::where('status', 'terbit')
            ->select('id_user', DB::raw('count(*) as jumlah_laporan'))
            ->groupBy('id_user')
            ->get();
        
        $mitraNames = Summary::whereIn('id_user', $mitraData->pluck('id_user'))
            ->pluck('nama_mitra', 'id_user');
        
        $pieChartData = $mitraData->map(function($item) use ($mitraNames) {
            return [
                'nama_mitra' => $mitraNames[$item->id_user] ?? 'Unknown',
                'jumlah_laporan' => $item->jumlah_laporan
            ];
        });
        
        $pieCategories = $pieChartData->pluck('nama_mitra');
        $pieData = $pieChartData->pluck('jumlah_laporan');
    
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

        return view('stats', compact(
            'jumlahProyek', 
            'jumlahMitra', 
            'formattedDanaRealisasi', 
            'jumlahProyekTerealisasi', 
            'categories', 
            'data', 
            'dataJumlah',
            'pieCategories', 
            'pieData',
            'kecamatanNames', 
            'totalRealisasiValues',
            'topMitraNames',
            'topMitraLaporanCounts'
        ));
    }
    
    
    
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}