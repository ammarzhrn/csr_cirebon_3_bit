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
use PDF;

class StatsDownloadController extends Controller
{
    public function downloadPdf()
    {
        $data = $this->getStatsData();
        $pdf = PDF::loadView('pdf.stats_download', $data);
        return $pdf->download('statistik_csr.pdf');
    }

    public function downloadCsv()
    {
        $data = $this->getStatsData();
        $csvFileName = 'statistik_csr.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Statistik CSR Pemerintah Kabupaten Cirebon']);
            fputcsv($file, ['']);
            fputcsv($file, ['Ringkasan Statistik']);
            fputcsv($file, ['Total Proyek CSR', $data['jumlahProyek']]);
            fputcsv($file, ['Proyek Terealisasi', $data['jumlahProyekTerealisasi']]);
            fputcsv($file, ['Mitra Bergabung', $data['jumlahMitra']]);
            fputcsv($file, ['Dana Realisasi CSR', $data['formattedDanaRealisasi']]);
            fputcsv($file, ['']);

            fputcsv($file, ['Data per Sektor']);
            fputcsv($file, ['Sektor', 'Persentase', 'Jumlah Laporan']);
            foreach ($data['categories'] as $index => $category) {
                fputcsv($file, [$category, $data['pieData'][$index] . '%', $data['dataJumlah'][$index]]);
            }
            fputcsv($file, ['']);

            fputcsv($file, ['Top 5 Mitra']);
            fputcsv($file, ['Nama Mitra', 'Jumlah Laporan']);
            foreach ($data['topMitraNames'] as $index => $name) {
                fputcsv($file, [$name, $data['topMitraLaporanCounts'][$index]]);
            }
            fputcsv($file, ['']);

            fputcsv($file, ['Data per Kecamatan']);
            fputcsv($file, ['Kecamatan', 'Total Realisasi']);
            foreach ($data['kecamatanNames'] as $index => $kecamatan) {
                fputcsv($file, [$kecamatan, FormatHelper::formatRupiah($data['totalRealisasiValues'][$index])]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getStatsData()
    {
        $jumlahProyek = Proyek::where('status', 'terbit')->count();
        $jumlahMitra = User::where('level', 'mitra')->count();
        $totalDanaRealisasi = Laporan::where('status', 'terbit')->sum('realisasi');
        $formattedDanaRealisasi = FormatHelper::formatRupiah($totalDanaRealisasi);
        $jumlahProyekTerealisasi = Proyek::whereHas('laporan', function($query) {
            $query->where('status', 'terbit');
        })->count();

        $sektors = Sektor::all();
        $data = $sektors->map(function($sektor) {
            return intval(Laporan::where('id_sektor', $sektor->id)->where('status', 'terbit')->sum('realisasi'));
        });
        $dataJumlah = $sektors->map(function($sektor) {
            return intval(Laporan::where('id_sektor', $sektor->id)->where('status', 'terbit')->count());
        });
        $categories = $sektors->pluck('nama_sektor');
        $pieData = $data;

        $topMitras = User::where('level', 'mitra')
            ->withCount(['laporan' => function ($query) {
                $query->where('status', 'terbit');
            }])
            ->orderByDesc('laporan_count')
            ->take(5)
            ->get();

        $topMitraNames = $topMitras->pluck('name')->toArray();
        $topMitraLaporanCounts = $topMitras->pluck('laporan_count')->toArray();

        $laporanPerKecamatan = Proyek::select('lokasi')
            ->join('laporans', 'proyeks.id', '=', 'laporans.id_proyek')
            ->where('laporans.status', 'terbit')
            ->selectRaw('proyeks.lokasi, SUM(laporans.realisasi) as total_realisasi')
            ->groupBy('proyeks.lokasi')
            ->orderByDesc('total_realisasi')
            ->get();

        $kecamatanNames = $laporanPerKecamatan->pluck('lokasi')->toArray();
        $totalRealisasiValues = $laporanPerKecamatan->pluck('total_realisasi')->toArray();

        return compact(
            'jumlahProyek', 
            'jumlahMitra', 
            'formattedDanaRealisasi', 
            'jumlahProyekTerealisasi', 
            'categories', 
            'data', 
            'dataJumlah',
            'pieData',
            'kecamatanNames', 
            'totalRealisasiValues',
            'topMitraNames',
            'topMitraLaporanCounts'
        );
    }
}