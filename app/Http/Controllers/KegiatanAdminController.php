<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\Pengajuan;
use App\Models\Laporan;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanAdminController extends Controller
{
    // Hapus method __construct()

    public function index(Request $request)
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $perPage = $request->input('per_page', 10); // Default 10 per halaman
        $status = $request->input('status', 'semua');
        $search = $request->input('search');

        $query = Kegiatan::query();

        // Filter berdasarkan status
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $kegiatans = $query->latest()->paginate($perPage)->appends($request->query());

        // Proses deskripsi dan foto untuk setiap kegiatan
        $kegiatans->getCollection()->transform(function ($kegiatan) {
            $stripped = Str::of(strip_tags($kegiatan->deskripsi))->squish();
            $kegiatan->deskripsi_singkat = $stripped->limit(100);
            $kegiatan->foto_url = $kegiatan->foto ? Storage::url($kegiatan->foto) : null;
            return $kegiatan;
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

        return view('dashboard.kegiatan.kegiatan', compact('kegiatans', 'status', 'summary',  'laporan', 'pengajuan', 'all_notifications', 'laporan_admin'));
    }

    public function create()
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = auth()->user();

        $summary = Summary::all();
        $laporan = Laporan::all();
        $pengajuan = Pengajuan::all();

        $laporan_admin = Laporan::where('created_at', '>', $user->created_at)
        ->get();  
        $pengajuan_notif = Pengajuan::where('created_at', '>', $user->created_at)
        ->get();  
        $summary_notif = Summary::where('created_at', '>', $user->created_at)
        ->get();

        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.kegiatan.create', compact('summary',  'laporan', 'pengajuan', 'all_notifications', 'laporan_admin'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $validatedData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_kegiatan' => 'required|string|max:255',
            'tags' => 'required|string',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kegiatan_fotos', 'public');
            $validatedData['foto'] = $fotoPath;
        }

        // Ubah logika penentuan status
        $validatedData['status'] = $request->input('action') === 'terbit' ? 'terbit' : 'draf';

        // Bersihkan konten HTML dari Summernote
        $validatedData['deskripsi'] = $this->cleanHtml($validatedData['deskripsi']);

        Kegiatan::create($validatedData);

        return redirect()->route('dashboard.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(Kegiatan $kegiatan)
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = auth()->user();

        $summary = Summary::all();
        $laporan = Laporan::all();
        $pengajuan = Pengajuan::all();

        $laporan_admin = Laporan::where('created_at', '>', $user->created_at)
        ->get();  
        $pengajuan_notif = Pengajuan::where('created_at', '>', $user->created_at)
        ->get();  
        $summary_notif = Summary::where('created_at', '>', $user->created_at)
        ->get();

        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.kegiatan.edit', compact('kegiatan', 'summary', 'laporan', 'pengajuan', 'all_notifications', 'laporan_admin'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Debugging: Cetak semua data yang diterima
        \Log::info('Received data:', $request->all());

        $validatedData = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul_kegiatan' => 'required|string|max:255',
            'tags' => 'required|string',
            'deskripsi' => 'required',
        ]);

        // Debugging: Cetak data yang telah divalidasi
        \Log::info('Validated data:', $validatedData);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kegiatan->foto) {
                Storage::disk('public')->delete($kegiatan->foto);
            }
            $fotoPath = $request->file('foto')->store('kegiatan_fotos', 'public');
            $validatedData['foto'] = $fotoPath;
        }

        $validatedData['status'] = $request->input('action') === 'terbit' ? 'terbit' : 'draf';

        // Bersihkan konten HTML dari Summernote
        $validatedData['deskripsi'] = $this->cleanHtml($validatedData['deskripsi']);

        // Debugging: Cetak data sebelum update
        \Log::info('Data before update:', $validatedData);

        $kegiatan->update($validatedData);

        // Debugging: Cetak data setelah update
        \Log::info('Updated kegiatan:', $kegiatan->toArray());

        return redirect()->route('dashboard.kegiatan.index', )->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $kegiatan->delete();
        return redirect()->route('dashboard.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/kegiatan_images', $filename);
            return response()->json(['location' => Storage::url($path)]);
        }
        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    private function clean($input)
    {
        return Purifier::clean($input);
    }

    private function cleanHtml($input)
    {
        // Konfigurasi Purifier untuk mempertahankan lebih banyak elemen HTML
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'p,b,i,u,strong,em,a[href|title],ul,ol,li,br,span[style],div[style],h1,h2,h3,h4,h5,h6');
        $config->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
        $purifier = new \HTMLPurifier($config);
        return $purifier->purify($input);
    }

    public function detail(Kegiatan $kegiatan)
    {
        if (auth()->user()->level !== 'admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $user = auth()->user();

        $summary = Summary::all();
        $laporan = Laporan::all();
        $pengajuan = Pengajuan::all();

        $laporan_admin = Laporan::where('created_at', '>', $user->created_at)
        ->get();  
        $pengajuan_notif = Pengajuan::where('created_at', '>', $user->created_at)
        ->get();  
        $summary_notif = Summary::where('created_at', '>', $user->created_at)
        ->get();

        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.kegiatan.detail', compact('kegiatan', 'summary',  'laporan', 'pengajuan', 'all_notifications', 'laporan_admin'));
    }
}
