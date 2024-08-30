<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Summary;
use App\Models\Pengajuan;
use App\Models\Laporan;
use Illuminate\Support\Facades\Log;

class SummaryController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $summary = $user->summary;

        if (!$summary) {
            $summary = new Summary();
            $summary->id_user = $user->id;
            $summary->nama = $user->name;
            $summary->email = $user->email;
            $summary->save();

            $user->is_summary = true;
            $user->save();
        }

        // Fetch All Data
        $summary_all = Summary::all();
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

        return view('profile.summary', compact('user', 'summary', 'summary_all', 'laporan', 'pengajuan', 'all_notifications', 'laporan_notif'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $summary = Summary::findOrFail($id);

        // Pastikan user hanya bisa mengedit summary miliknya sendiri
        if ($summary->id_user !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch All Data
        $summary_all = Summary::all();
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

        return view('profile.summary-edit', compact('user', 'summary', 'summary_all', 'laporan', 'pengajuan', 'all_notifications', 'laporan_notif'));
    }

    public function notif(Request $request, $id)
    {
        $summary = Summary::findOrFail($id);
        $summary->is_read = 1;
        $summary->save();

        return back();
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $summary = Summary::findOrFail($id);

        if ($summary->id_user !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        if ($user->level === 'admin') {
            $validatedData = $request->validate([
                'foto_pp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'nama' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'deskripsi' => 'nullable|string',
            ]);
        } else {
            $validatedData = $request->validate([
                'foto_pp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'nama_mitra' => 'nullable|string|max:255',
                'nama' => 'nullable|string|max:255',
                'no_telp' => 'nullable|string|max:20',
                'email' => 'required|email|max:255',
                'alamat' => 'nullable|string',
                'deskripsi' => 'nullable|string',
            ]);
        }

        if ($request->hasFile('foto_pp')) {
            $imageName = time().'.'.$request->foto_pp->extension();  
            $request->foto_pp->storeAs('public/images/profile', $imageName);
            $validatedData['foto_pp'] = $imageName;
        } elseif (!$summary->foto_pp) {
            $validatedData['foto_pp'] = 'profile.png';
        }

        $summary->fill($validatedData);
        $summary->save();

        // Update user name and email
        if (isset($validatedData['nama'])) {
            $user->name = $validatedData['nama'];
        }
        $user->email = $validatedData['email'];
        $user->save();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        }

        return redirect()->route('summary.show')->with('success', 'Profile updated successfully');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $summary = new Summary();
        $summary->id_user = $user->id;

        $validatedData = $request->validate([
            'foto_pp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_mitra' => 'nullable|string|max:255',
            'nama' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_pp')) {
            $imageName = time().'.'.$request->foto_pp->extension();  
            $request->foto_pp->storeAs('public/images/profile', $imageName);
            $validatedData['foto_pp'] = $imageName;
        }

        $summary->fill($validatedData);
        $summary->save();

        // Update user name and email
        if (isset($validatedData['nama'])) {
            $user->name = $validatedData['nama'];
        }
        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route('summary.show')->with('success', 'Profile created successfully');
    }
}