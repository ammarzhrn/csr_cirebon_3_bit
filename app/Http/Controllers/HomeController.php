<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sektor;
use App\Models\Laporan;
use App\Models\Kegiatan;
use App\Models\Proyek;
use App\Models\Summary;
use App\Models\Faq;
use App\Helpers\FormatHelper;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporanTerbaru = Laporan::where('status', 'terbit')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get()
            ->map(function ($laporan) {
                $laporan->thumbnail_url = $laporan->thumbnail 
                    ? asset('storage/' . $laporan->thumbnail) 
                    : asset('images/default-thumbnail.png');
                $laporan->images = is_array($laporan->images) 
                    ? $laporan->images 
                    : json_decode($laporan->images, true);
                return $laporan;
            });

        // Debugging
        \Log::info('Laporan Terbaru:', ['count' => $laporanTerbaru->count(), 'data' => $laporanTerbaru->toArray()]);

        // Pastikan $laporanTerbaru tidak kosong
        if ($laporanTerbaru->isEmpty()) {
            $laporanTerbaru = collect(); // Ubah menjadi koleksi kosong daripada null
        }

        $kegiatan = Kegiatan::latest()->take(4)->get()->map(function ($item) {
            $item->foto_url = $item->foto ? Storage::url($item->foto) : asset('default-thumbnail.png');
            return $item;
        });
        $sektor = Sektor::all();
        
        // Pastikan URL gambar lengkap
        $sektor->each(function ($item) {
            $item->thumbnail = $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/thumbnail.png');
        });

        $jumlahProyek = Proyek::where('status', 'terbit')->count();
        $jumlahMitra = Summary::join('users', 'summary.id_user', '=', 'users.id')
            ->where('users.level', 'mitra')
            ->count();
        $mitra = Summary::all();
        $laporan = Laporan::where('status', 'terbit')->get();
        $faq = Faq::all();

        // Menghitung total dana realisasi hanya untuk laporan yang diterbitkan
        $totalDanaRealisasi = Laporan::where('status', 'terbit')->sum('realisasi');

        // Memformat total dana realisasi
        $formattedDanaRealisasi = FormatHelper::formatRupiah($totalDanaRealisasi);

        // Menghitung jumlah proyek yang terealisasi (memiliki laporan yang diterbitkan)
        $jumlahProyekTerealisasi = Proyek::whereHas('laporan', function($query) {
            $query->where('status', 'terbit');
        })->count();

        return view('home', compact('sektor', 'faq', 'kegiatan', 'laporan', 'laporanTerbaru', 'mitra', 'jumlahProyek', 'jumlahMitra', 'formattedDanaRealisasi', 'jumlahProyekTerealisasi'));
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
        $sektor = Sektor::all();
        return view('home', compact('sektor'));
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
