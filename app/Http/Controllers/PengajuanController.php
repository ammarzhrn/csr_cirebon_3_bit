<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Summary;
use App\Models\Laporan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default 10 item per halaman
        $search = $request->input('search');

        $query = Pengajuan::query();

        if ($search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('mitra_csr', 'like', "%{$search}%")
                  ->orWhere('nama_program', 'like', "%{$search}%");
        }

        $pengajuan = $query->paginate($perPage);

        // Fetch All Data for notifications
        $summary = Summary::all();
        $laporan = Laporan::all();

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

        return view('dashboard.pengajuan.index', compact('pengajuan', 'summary', 'laporan', 'all_notifications', 'laporan_notif'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|string',
            'tgl_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'no_telp' => 'required|string|max:20',
            'nama_instansi' => 'required|string',
            'mitra_csr' => 'nullable|string',
            'nama_program' => 'nullable|string',
        ]);

        Pengajuan::create($input);

        // dd($input);

        // Redirect to a success page or display a success message
        return back()->with('success', 'Data berhasil disimpan.');
    }

    public function notif(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->is_read = 1;
        $pengajuan->save();

        return back();
    }

    public function show(string $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        
        // Fetch other data for notifications
        $summary = Summary::all();
        $laporan = Laporan::all();

        // Notifications Filter
        $user = auth()->user();
        $laporan_admin = Laporan::where('created_at', '>', $user->created_at)->get();  
        $pengajuan_notif = Pengajuan::where('created_at', '>', $user->created_at)->get();  
        $summary_notif = Summary::where('created_at', '>', $user->created_at)->get();
        $laporan_notif = Laporan::where('id_user', $user->id)
                ->whereIn('status', ['revisi', 'tolak', 'terbit'])
                ->orderBy('created_at', 'desc')
                ->get();
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values();

        return view('dashboard.pengajuan.detail', compact('pengajuan', 'summary', 'laporan', 'all_notifications', 'laporan_notif'));
    }
}