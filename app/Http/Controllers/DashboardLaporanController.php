<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Summary;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use App\Models\Sektor;
use App\Models\Program;
use App\Models\Proyek;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardLaporanController extends Controller
{
   

    public function laporan(Request $request)
    {
        $user = Auth::user();
        $query = $this->getFilteredQuery($request);

        if ($user->level === 'mitra') {
            $query->where('id_user', $user->id);
        }

        // Tambahkan filter untuk mengecualikan laporan dengan status 'draf'
        $query->where('status', '!=', 'draf');

        $laporans = $query->latest()->paginate($request->input('per_page', 5))->withQueryString();

        $laporans->getCollection()->transform(function ($laporan) {
            $laporan->formatted_realisasi = 'Rp ' . number_format($laporan->realisasi, 0, ',', '.');
            $laporan->formatted_lokasi = $laporan->proyek->lokasi ?? 'Tidak ada lokasi';
            
            // Format TGL REALISASI
            $laporan->formatted_tgl_realisasi = $this->formatTanggalRealisasi($laporan);
            
            // Format LAPORAN DIKIRIM
            $laporan->formatted_tgl_laporan = $laporan->created_at ? $laporan->created_at->format('d M Y') : 'Tidak ada tanggal';
            
            return $laporan;
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

        $tahunList = Laporan::select('tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun');

        return view('dashboard.laporan.laporan', compact('laporans', 'tahunList', 'summary', 'laporan', 'pengajuan', 'all_notifications', 'laporan_notif'));
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
        $sektors = Sektor::all();
        $programs = Program::all();
        $proyeks = Proyek::where('status', 'terbit')->get(); // Hanya ambil proyek yang sudah diterbitkan

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

        return view('dashboard.laporan.create', compact('sektors', 'programs', 'proyeks', 'summary', 'laporan', 'pengajuan', 'all_notifications', 'laporan_notif'));
    }

    public function store(Request $request)
    {
        \Log::info('Laporan submission started', $request->except('images'));
        \Log::info('Files in request', ['files' => $request->allFiles()]);

        try {
            $validatedData = $request->validate([
                'id_user' => 'required',
                'id_sektor' => 'required',
                'id_program' => 'required',
                'id_proyek' => 'nullable',
                'judul_laporan' => 'required',
                'tanggal' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
                'realisasi' => 'required|numeric',
                'deskripsi' => 'nullable',
                'images' => 'nullable|array|max:4',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    if ($index >= 4) break;
                    $filename = time() . '_' . $image->getClientOriginalName();
                    $path = $image->storeAs('laporan_images', $filename, 'public');
                    $images[] = $path;
                    \Log::info('Image stored', ['path' => $path]);
                }
            } else {
                \Log::info('No images found in request');
            }

            if (empty($images)) {
                $images[] = 'images/thumbnail.png';
                \Log::info('Using default thumbnail');
            }

            $validatedData['images'] = json_encode($images);
            $validatedData['status'] = $request->has('save_draft') ? 'draf' : 'pending';

            $laporan = Laporan::create($validatedData);
            \Log::info('Laporan created', ['id' => $laporan->id, 'images' => $laporan->images]);

            return redirect()->route('dashboard.laporan')->with('success', 'Laporan berhasil disimpan.');
        } catch (\Exception $e) {
            \Log::error('Error creating Laporan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Laporan $laporan)
    {
        $user = Auth::user();
        if ($user->level === 'admin' && $laporan->status === 'draf') {
            return redirect()->route('dashboard.laporan')->with('error', 'Anda tidak memiliki akses ke laporan draft.');
        }
        if ($user->level === 'mitra' && $laporan->id_user !== $user->id) {
            return redirect()->route('dashboard.laporan')->with('error', 'Anda tidak memiliki akses ke laporan ini.');
        }
        
        // Load user dan summary relationship
        $laporan->load('user.summary');
        
        // Perbaikan di sini
        $images = is_string($laporan->images) ? json_decode($laporan->images) : $laporan->images;
        $images = $images ?? [];

        // Fetch All Data
        $summary = Summary::all();
        $laporan_all = Laporan::all();
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

        return view('dashboard.laporan.detail-laporan', compact('laporan', 'images', 'summary', 'laporan_all', 'pengajuan', 'all_notifications', 'laporan_notif'));
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $user = Auth::user();
        
        if ($user->level !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'status' => 'required|in:tolak,revisi,terbit',
            'pesan_admin' => 'nullable|string', // Ubah menjadi nullable
        ]);

        $laporan->status = $validatedData['status'];
        $laporan->pesan_admin = $validatedData['pesan_admin'] ?? null; // Gunakan null coalescing operator
        $laporan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status laporan berhasil diperbarui.',
            'newStatus' => $this->getStatusLabel($laporan->status)
        ]);
    }

    private function getStatusLabel($status)
    {
        switch ($status) {
            case 'draf':
                return 'Draf';
            case 'pending':
                return 'Pending';
            case 'revisi':
                return 'Revisi';
            case 'terbit':
                return 'Terbit';
            case 'tolak':
                return 'Tolak';
            default:
                return ucfirst($status);
        }
    }
    public function detail($id)
    {
        $laporan = Laporan::findOrFail($id);

        // Fetch All Data
        $summary = Summary::all();
        $laporan_all = Laporan::all();
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

        return view('dashboard.laporan.detail-laporan', compact('laporan', 'summary', 'laporan', 'pengajuan', 'all_notifications', 'laporan_notif'));
    }

    public function downloadCsv(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        // Implementasi unduh CSV
    }

    public function downloadPdf(Request $request)
    {
        $query = $this->getFilteredQuery($request);
        $laporans = $query->get();

        $pdf = PDF::loadView('pdf.laporan', compact('laporans'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_CSR_Kabupaten_Cirebon.pdf');
    }

    private function getFilteredQuery(Request $request)
    {
        $query = Laporan::query();
        
        $user = Auth::user();
        if ($user->level === 'mitra') {
            $query->where('id_user', $user->id);
        }

        // Tambahkan filter untuk mengecualikan laporan dengan status 'draf'
        $query->where('status', '!=', 'draf');

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('quarter')) {
            $quarter = $request->quarter;
            $query->where(function($q) use ($quarter) {
                if ($quarter == 1) {
                    $q->whereIn('bulan', ['januari', 'februari', 'maret']);
                } elseif ($quarter == 2) {
                    $q->whereIn('bulan', ['april', 'mei', 'juni']);
                } elseif ($quarter == 3) {
                    $q->whereIn('bulan', ['juli', 'agustus', 'september']);
                } elseif ($quarter == 4) {
                    $q->whereIn('bulan', ['oktober', 'november', 'desember']);
                }
            });
        }

        return $query;
    }

    public function destroy(Laporan $laporan)
    {
        $user = Auth::user();
        
        // Pastikan hanya mitra pemilik laporan yang bisa menghapus
        if ($user->level !== 'mitra' || $laporan->id_user !== $user->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus laporan ini.');
        }

        // Hapus gambar-gambar terkait
        $images = json_decode($laporan->images, true);
        foreach ($images as $image) {
            if ($image !== 'images/thumbnail.png') {
                Storage::disk('public')->delete($image);
            }
        }

        // Hapus laporan
        $laporan->delete();

        return redirect()->route('dashboard.laporan');
    }

    public function edit(Laporan $laporan)
    {
        $user = Auth::user();
        
        // Cek apakah pengguna adalah mitra dan pemilik laporan
        if ($user->level !== 'mitra' || $laporan->id_user !== $user->id) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        // Cek status laporan
        if ($laporan->status === 'tolak' || $laporan->status === 'terbit') {
            return redirect()->route('dashboard.laporan.show', $laporan)->with('error', 'Laporan yang sudah ditolak atau diterbitkan tidak dapat diedit.');
        }

        // Kode yang sudah ada untuk menampilkan halaman edit
        $sektors = Sektor::all();
        $programs = Program::all();
        $proyeks = Proyek::all();

        // Fetch All Data
        $summary = Summary::all();
        $laporan_all = Laporan::all();
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

        return view('dashboard.laporan.edit', compact('laporan', 'sektors', 'programs', 'proyeks', 'summary', 'laporan', 'pengajuan', 'all_notifications', 'laporan_notif'));
    }
    public function submit(Laporan $laporan)
    {
        // Pastikan user yang sedang login adalah pemilik laporan
        if (auth()->id() !== $laporan->id_user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Pastikan status laporan saat ini adalah 'draf'
        if ($laporan->status !== 'draf') {
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
                $currentImages = is_string($laporan->images) ? json_decode($laporan->images, true) : $laporan->images;
                $currentImages = $currentImages ?? [];
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

            // Pastikan images selalu disimpan sebagai JSON string
            $data['images'] = json_encode($data['images'] ?? []);

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