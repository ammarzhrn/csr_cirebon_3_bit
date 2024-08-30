<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Summary;
use App\Models\Pengajuan;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class DashboardUserController extends Controller
{
    public function user(Request $request)
    {
        $query = Summary::query();

        // Exclude the current user's account
        $query->whereHas('user', function($q) {
            $q->where('id', '!=', Auth::id());
        });

        // Filter berdasarkan role jika ada
        if ($request->filled('status')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('level', $request->status);
            });
        }

        // Pencarian
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_mitra', 'like', '%' . $request->search . '%');
            });
        }

        // Sorting
        $sortField = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Pagination
        $perPage = $request->input('per_page', 10);
        $summaries = $query->paginate($perPage)->withQueryString();

        // Format data untuk view
        $summaries->getCollection()->transform(function ($summary) {
            $user = User::find($summary->id_user);
            $summary->formatted_created_at = $summary->created_at->format('d M Y');
            $summary->status = ($user->level);
            return $summary;
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

        return view('dashboard.user.user', compact('summaries', 'summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    private function getFilteredQuery(Request $request)
    {
        $query = Summary::query();
        
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_mitra', 'like', '%' . $request->search . '%');
            });
        }
        

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Tambahkan filter lain sesuai kebutuhan

        return $query;
    }

    public function deactivateUser($id)
    {
        DB::beginTransaction();
        try {
            $summary = Summary::findOrFail($id);
            $user = User::findOrFail($summary->id_user);
            $user->level = 'guest';
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'User berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menonaktifkan user.');
        }
    }

    public function active($id)
    {
        DB::beginTransaction();
        try {
            $summary = Summary::findOrFail($id);
            $user = User::findOrFail($summary->id_user);
            $user->level = 'mitra';
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'User berhasil diaktifkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengaktifkan user.');
        }
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

        return view('dashboard.user.create', compact('summary', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:128',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|string|min:8|max:30|confirmed',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'level' => 'mitra', // Atur level default sebagai 'mitra'
            ]);

            Summary::updateOrCreate(
                ['id_user' => $user->id],
                [
                    'nama' => $validatedData['name'],
                    'nama_mitra' => $validatedData['name'],
                    'email' => $validatedData['email'],
                ]
            );

            DB::commit();

            return redirect()->route('dashboard.user')->with('success', 'User baru berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.'])->withInput();
        }
    }

    public function show($id)
    {
        $summary = Summary::find($id);

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.user.detail-user', compact('summary', 'summary_all', 'laporan', 'pengajuan', 'all_notifications'));
    }

    private function getStatusLabel($status)
    {
        return $status === 'terbit' ? 'Diterbitkan' : 'Draf';
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

    public function edit($id)
    {
        $user = Auth::user();
        $summary = Summary::findOrFail($id);

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
            
        
        // Merge all notifications
        $all_notifications = $summary_notif
        ->concat($laporan_admin)
        ->concat($pengajuan_notif)
        ->sortByDesc('created_at')
        ->values(); // Reset the keys to avoid conflicts  

        return view('dashboard.user.edit', compact('user', 'summary', 'summary_all', 'laporan', 'pengajuan', 'all_notifications'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $summary = Summary::findOrFail($id);

        // Pastikan hanya admin yang bisa mengubah data user lain
        if ($user->level !== 'admin' && $summary->id_user !== $user->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

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

        // Update user terkait
        $relatedUser = User::find($summary->id_user);
        if ($relatedUser) {
            if (isset($validatedData['nama'])) {
                $relatedUser->name = $validatedData['nama'];
            }
            $relatedUser->email = $validatedData['email'];
            $relatedUser->save();
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        }

        return redirect()->route('dashboard.user')->with('success', 'Profile updated successfully');
    }

    public function downloadCsv()
    {
        $summaries = Summary::all();
        $csvFileName = 'users_' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Nama', 'Nama Mitra', 'Email', 'No. Telp', 'Alamat', 'Status');

        $callback = function() use ($summaries, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($summaries as $summary) {
                $row['Nama']  = $summary->nama;
                $row['Nama Mitra']    = $summary->nama_mitra;
                $row['Email']    = $summary->email;
                $row['No. Telp']  = $summary->no_telp;
                $row['Alamat']  = $summary->alamat;
                $row['Status']  = $summary->user->level;

                fputcsv($file, array($row['Nama'], $row['Nama Mitra'], $row['Email'], $row['No. Telp'], $row['Alamat'], $row['Status']));
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function downloadPdf()
    {
        $summaries = Summary::all();
        $pdf = PDF::loadView('pdf.user', compact('summaries'));
        return $pdf->stream('users_' . date('Y-m-d') . '.pdf');
    }
}