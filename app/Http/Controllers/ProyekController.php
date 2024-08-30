<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProyekController extends Controller
{
    public function show($id)
    {
        $proyek = Proyek::findOrFail($id);
        
        $mitra = User::whereHas('laporan', function ($query) use ($proyek) {
            $query->where('id_proyek', $proyek->id);
        })->with(['laporan' => function ($query) use ($proyek) {
            $query->where('id_proyek', $proyek->id)->latest();
        }])->get();

        // Menambahkan informasi kuartal
        $mitra = $mitra->map(function ($user) {
            $latestLaporan = $user->laporan->first();
            if ($latestLaporan) {
                $tanggalPengajuan = Carbon::parse($latestLaporan->created_at);
                $user->kuartal = ceil($tanggalPengajuan->month / 3);
                $user->tahun = $tanggalPengajuan->year;
            }
            return $user;
        });

        // Mendapatkan daftar tahun unik
        $tahunList = $mitra->pluck('tahun')->unique()->sort()->values();

        return view('detail', compact('proyek', 'mitra', 'tahunList'));
    }
}
