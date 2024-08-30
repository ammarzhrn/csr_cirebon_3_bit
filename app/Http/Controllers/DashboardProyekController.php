<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use App\Models\Sektor;
use App\Models\Summary;
use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\Proyek;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardProyekController extends Controller
{
    public function proyek(Request $request)
    {        
        $query = $this->getFilteredQuery($request);

        $proyeks = $query->latest()->paginate($request->input('per_page', 5))->withQueryString();

        $proyeks->getCollection()->transform(function ($proyek) {
            $proyek->formatted_lokasi = $proyek->lokasi ?? 'Tidak ada lokasi';
            $proyek->formatted_tgl_awal = $proyek->tgl_awal ? Carbon::parse($proyek->tgl_awal)->format('d M Y') : 'Tidak ada tanggal';
            $proyek->formatted_tgl_akhir = $proyek->tgl_akhir ? Carbon::parse($proyek->tgl_akhir)->format('d M Y') : 'Tidak ada tanggal';
            
            // Hitung jumlah mitra unik untuk setiap proyek
            $proyek->jumlah_mitra = Laporan::where('id_proyek', $proyek->id)
                ->distinct('id_user')
                ->count('id_user');
            
            return $proyek;
        });

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        // Mengambil daftar tahun dari field tgl_awal
        $tahunList = Proyek::selectRaw('YEAR(tgl_awal) as tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');

        return view('dashboard.proyek.proyek', compact('proyeks', 'tahunList', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    private function formatTanggalRealisasi($laporan)
    {
        if (!$laporan->tanggal || !$laporan->bulan || !$laporan->tahun) {
            return 'Data tidak lengkap';
        }

        $bulanIndonesia = [
            'januari' => 'Jan', 'februari' => 'Feb', 'maret' => 'Mar',
            'april' => 'Apr', 'mei' => 'Mei', 'juni' => 'Jun',
            'juli' => 'Jul', 'agustus' => 'Agu', 'september' => 'Sep',
            'oktober' => 'Okt', 'november' => 'Nov', 'desember' => 'Des'
        ];

        $bulan = strtolower($laporan->bulan);
        $bulanFormatted = $bulanIndonesia[$bulan] ?? $laporan->bulan;

        return sprintf('%02d %s %s', $laporan->tanggal, $bulanFormatted, $laporan->tahun);
    }

    public function create()
    {
        if (auth()->user()->level !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Hanya admin yang dapat membuat proyek baru.');
        }

        // Kode yang sudah ada sebelumnya, jika ada
        $sektors = Sektor::all();
        $programs = Program::all();

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  
        

        // Lanjutkan dengan logika untuk menampilkan form pembuatan proyek
        return view('dashboard.proyek.create', compact('sektors', 'programs', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    protected function authorize($ability, $arguments = [])
    {
        \Log::info('Authorizing: ' . $ability, ['arguments' => $arguments, 'user' => auth()->user()]);
        if (! Gate::allows($ability, $arguments)) {
            abort(403, 'This action is unauthorized.');
        }
    }

    public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'id_sektor' => 'required',
            'id_program' => 'required',
            'nama_proyek' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validatedData['status'] = 'draf';

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('proyek_thumbnails', 'public');
            $validatedData['thumbnail'] = $thumbnailPath;
        }

        \Log::info('Attempting to create Proyek', $validatedData);
        $proyek = Proyek::create($validatedData);
        \Log::info('Proyek created', $proyek->toArray());

        return redirect()->route('dashboard.proyek')->with('success', 'Proyek berhasil disimpan sebagai draf.');
    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Validation error: ' . json_encode($e->errors()));
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        \Log::error('Error creating Proyek: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}

    public function show($id)
    {
        $proyek = Proyek::findOrFail($id);

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.proyek.detail', compact('proyek', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function updateStatus(Request $request, Proyek $proyek)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:draf,terbit',
        ]);

        // Update status proyek yang sudah ada
        $proyek->status = $validatedData['status'];
        $proyek->save();

        return response()->json([
            'success' => true,
            'message' => 'Status proyek berhasil diperbarui.',
            'newStatus' => $this->getStatusLabel($proyek->status)
        ]);
    }

    private function getStatusLabel($status)
    {
        return $status === 'terbit' ? 'Diterbitkan' : 'Draf';
    }
    public function detail($id)
    {        
        $proyek = Proyek::findOrFail($id);

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.proyek.detail-proyek', compact('proyek', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function downloadCsv(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $proyeks = $query->get();

        $proyeks->transform(function ($proyek) {
            $proyek->jumlah_mitra = Laporan::where('id_proyek', $proyek->id)
                ->distinct('id_user')
                ->count('id_user');
            
            $proyek->formatted_tgl_awal = $proyek->tgl_awal ? Carbon::parse($proyek->tgl_awal)->format('d/m/Y') : 'N/A';
            $proyek->formatted_tgl_akhir = $proyek->tgl_akhir ? Carbon::parse($proyek->tgl_akhir)->format('d/m/Y') : 'N/A';
            
            return $proyek;
        });

        $csvFileName = 'Proyek_CSR_Kab_Cirebon_' . date('Y-m-d') . '.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function() use ($proyeks) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, ['PEMERINTAH KABUPATEN CIREBON']);
            fputcsv($file, ['DAFTAR PROYEK CORPORATE SOCIAL RESPONSIBILITY (CSR)']);
            fputcsv($file, ['Tanggal Unduh:,' . date('d/m/Y')]);
            fputcsv($file, []);

            // Kolom
            fputcsv($file, ['No.', 'Judul Proyek', 'Lokasi', 'Jumlah Mitra', 'Tanggal Mulai', 'Tanggal Akhir', 'Status']);

            // Data
            foreach ($proyeks as $index => $proyek) {
                fputcsv($file, [
                    $index + 1,
                    $proyek->nama_proyek,
                    'Kec. ' . $proyek->lokasi,
                    $proyek->jumlah_mitra,
                    $proyek->formatted_tgl_awal,
                    $proyek->formatted_tgl_akhir,
                    ucfirst($proyek->status)
                ]);
            }

            // Footer
            fputcsv($file, []);
            fputcsv($file, ['Dokumen ini diterbitkan oleh Pemerintah Kabupaten Cirebon']);
            fputcsv($file, ['Alamat:,Jl. Sunan Kalijaga No.7, Sumber, Kec. Sumber, Kabupaten Cirebon, Jawa Barat 45611']);
            fputcsv($file, ['Telepon:,(0231) 321197']);
            fputcsv($file, ['Email:,pemkab@cirebonkab.go.id']);

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function downloadPdf(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $proyeks = $query->get();

        // Hitung jumlah mitra untuk setiap proyek
        $proyeks->transform(function ($proyek) {
            $proyek->jumlah_mitra = Laporan::where('id_proyek', $proyek->id)
                ->distinct('id_user')
                ->count('id_user');
            
            $proyek->formatted_tgl_awal = $proyek->tgl_awal ? Carbon::parse($proyek->tgl_awal)->format('d M Y') : 'Tidak ada tanggal';
            $proyek->formatted_tgl_akhir = $proyek->tgl_akhir ? Carbon::parse($proyek->tgl_akhir)->format('d M Y') : 'Tidak ada tanggal';
            
            return $proyek;
        });

        $pdf = PDF::loadView('dashboard.proyek.pdf', compact('proyeks'));
        return $pdf->stream('proyek_' . date('Y-m-d') . '.pdf');
    }

    private function getFilteredQuery(Request $request)
    {
        $query = Proyek::query();
        
        if ($request->filled('tahun')) {
            $query->whereYear('tgl_awal', $request->tahun);
        }

        if ($request->filled('quarter')) {
            $quarter = $request->quarter;
            $query->where(function($q) use ($quarter) {
                if ($quarter == 1) {
                    $q->whereMonth('tgl_awal', '>=', 1)->whereMonth('tgl_awal', '<=', 3);
                } elseif ($quarter == 2) {
                    $q->whereMonth('tgl_awal', '>=', 4)->whereMonth('tgl_awal', '<=', 6);
                } elseif ($quarter == 3) {
                    $q->whereMonth('tgl_awal', '>=', 7)->whereMonth('tgl_awal', '<=', 9);
                } elseif ($quarter == 4) {
                    $q->whereMonth('tgl_awal', '>=', 10)->whereMonth('tgl_awal', '<=', 12);
                }
            });
        }

        if ($request->filled('search')) {
            $query->where('nama_proyek', 'like', '%' . $request->search . '%');
        }

        return $query;
    }

    public function destroy(Proyek $proyek)
    {
        $user = Auth::user();

        // Hapus gambar-gambar terkait
        $images = json_decode($proyek->thumbnail, true);
        foreach ($images as $image) {
            if ($image !== 'images/thumbnail.png') {
                Storage::disk('public')->delete($image);
            }
        }

        // Hapus laporan
        $proyek->delete();

        return redirect()->route('dashboard.proyek');
    }

    public function edit(Proyek $proyek)
    {
        $user = Auth::user();
        
        // Cek apakah pengguna adalah mitra dan pemilik laporan
        if ($user->level == 'mitra') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        // Kode yang sudah ada untuk menampilkan halaman edit
        $sektors = Sektor::all();
        $programs = Program::all();
        $proyeks = Proyek::all();

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  
        return view('dashboard.laporan.edit', compact('laporan', 'sektors', 'programs', 'proyeks', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }
    public function submit(Proyek $proyek)
    {
        // Pastikan user yang sedang login adalah pemilik laporan
        if (auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Pastikan status laporan saat ini adalah 'draf'
        if ($proyek->status !== 'draf') {
            return response()->json(['success' => false, 'message' => 'Hanya laporan draf yang dapat dikirim.'], 400);
        }

        DB::beginTransaction();
        try {
            $laporan->status = 'pending';
            $laporan->save();

            DB::commit();
            Log::info('Laporan status updated to pending', ['laporan_id' => $laporan->id, 'new_status' => $laporan->status]);

            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil dikirim untuk ditinjau.',
                'newStatus' => $this->getStatusLabel($laporan->status),
                'redirectUrl' => route('dashboard.laporan.show', $laporan->id) // Tambahkan ini
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update laporan status', ['laporan_id' => $laporan->id, 'error' => $e->getMessage()]);

            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengirim laporan.'], 500);
        }
    }
    
    public function update(Request $request, Laporan $laporan)
    {
        
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'id_sektor' => 'required|exists:sektors,id',
            'id_program' => 'required|exists:programs,id',
            'id_proyek' => 'nullable|exists:proyeks,id',
            'tanggal' => 'required|integer|min:1|max:31',
            'bulan' => 'required|in:januari,februari,maret,april,mei,juni,juli,agustus,september,oktober,november,desember',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'realisasi' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draf,pending',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->except('images', 'removed_images');
            
            // Handle removed images
            if ($request->has('removed_images')) {
                $removedImages = json_decode($request->removed_images, true);
                $currentImages = $laporan->images ?? [];
                foreach ($removedImages as $removedImage) {
                    if (($key = array_search($removedImage, $currentImages)) !== false) {
                        unset($currentImages[$key]);
                        Storage::delete($removedImage);
                    }
                }
                $data['images'] = array_values($currentImages);
            }

            // Handle new images
            if ($request->hasFile('images')) {
                $newImages = [];
                foreach ($request->file('images') as $image) {
                    $path = $image->store('laporan_images', 'public');
                    $newImages[] = $path;
                }
                $data['images'] = array_merge($data['images'] ?? [], $newImages);
            }

            if ($request->input('status') === 'draf') {
                $laporan->status = 'draf';
            } else {
                $laporan->status = 'pending';
            }

            $laporan->update($data);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $laporan->status === 'draf' ? 'Laporan berhasil disimpan sebagai draft.' : 'Laporan berhasil diupdate.',
                'redirect' => route('dashboard.laporan.show', $laporan->id)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}