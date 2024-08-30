<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sektor;
use App\Models\Program;
use App\Models\Summary;
use App\Models\Pengajuan;
use App\Models\Laporan;

class SektorAdminController extends Controller
{
    public function index()
    {
        $sektors = Sektor::paginate(10); // Atau jumlah item per halaman yang Anda inginkan
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

        return view('dashboard.sektor.sektorAdmin', compact('sektors', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function create()
    {
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

        return view('dashboard.sektor.create', compact('summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_sektor' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama_program.*' => 'required|string|max:255',
            'deskripsi_program.*' => 'required|string',
        ]);

        // Simpan sektor
        $sektor = Sektor::create([
            'nama_sektor' => $request->nama_sektor,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $request->file('thumbnail')->store('thumbnails', 'public'), // Simpan di storage/app/public/thumbnails
        ]);

        // Simpan program
        foreach ($request->nama_program as $key => $nama_program) {
            $sektor->programs()->create([
                'nama_program' => $nama_program,
                'deskripsi' => $request->deskripsi_program[$key],
            ]);
        }

        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor dan program berhasil dibuat.');
    }

    public function edit(Sektor $sektor)
    {
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

        return view('dashboard.sektor.edit', compact('sektor', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function update(Request $request, Sektor $sektor)
    {
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_sektor' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'nama_program.*' => 'required|string|max:255',
            'deskripsi_program.*' => 'required|string',
        ]);

        // Update sektor
        $sektor->update($request->only('nama_sektor', 'deskripsi'));

        // Update thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($sektor->thumbnail && $sektor->thumbnail !== 'thumbnail.png') {
                Storage::disk('public')->delete($sektor->thumbnail);
            }
            $sektor->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
            $sektor->save();
        }

        // Ambil ID program yang ada
        $programIds = $request->input('program_ids', []);

        // Hapus program yang tidak ada dalam input
        $sektor->programs()->whereNotIn('id', $programIds)->delete();

        // Update atau buat program
        foreach ($request->nama_program as $key => $nama_program) {
            $programId = $programIds[$key] ?? null;
            $program = $programId ? Program::find($programId) : new Program();
            
            $program->nama_program = $nama_program;
            $program->deskripsi = $request->deskripsi_program[$key];
            $program->id_sektor = $sektor->id;
            $program->save();
        }

        return redirect()->route('dashboard.sektor.show', $sektor->id)->with('success', 'Sektor dan program berhasil diperbarui.');
    }

    public function show(Sektor $sektor)
    {
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

        return view('dashboard.sektor.detail', compact('sektor', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->back()->with('success', 'Program berhasil dihapus.');
    }
}
