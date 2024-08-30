<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'terbaru');
        $search = $request->input('search', '');

        $query = Laporan::where('status', 'terbit');

        if ($search) {
            $query->where('judul_laporan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        if ($sort === 'terbaru') {
            $query->latest();
        } elseif ($sort === 'terlama') {
            $query->oldest();
        }

        $laporans = $query->paginate(10)->withQueryString();

        $laporans = $laporans->map(function ($laporan) {
            $laporan->images = is_array($laporan->images) ? $laporan->images : json_decode($laporan->images, true);
            return $laporan;
        });

        return view('laporan.index', compact('laporans', 'sort', 'search'));
    }

    public function notif(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->is_read = 1;
        $laporan->save();

        return back();
    }

    public function notif2(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->is_read_user = 1;
        $laporan->save();

        return back();
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
        $validatedData = $request->validate([
            // ... validasi lainnya ...
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('laporan_photos', 'public');
            $validatedData['thumbnail'] = $path;
        }

        $laporan = Laporan::create($validatedData);

        return redirect()->route('dashboard.laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.detail', compact('laporan'));
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

    public function downloadCsv(Request $request)
    {
        $query = Laporan::query();

        if ($request->filled('year')) {
            $query->where('tahun', $request->year);
        }

        if ($request->filled('quarter')) {
            $quarter = $request->quarter;
            $query->where(function($q) use ($quarter) {
                if ($quarter == 1) {
                    $q->whereIn('bulan', [1, 2, 3]);
                } elseif ($quarter == 2) {
                    $q->whereIn('bulan', [4, 5, 6]);
                } elseif ($quarter == 3) {
                    $q->whereIn('bulan', [7, 8, 9]);
                } elseif ($quarter == 4) {
                    $q->whereIn('bulan', [10, 11, 12]);
                }
            });
        }

        $laporans = $query->get();

        $csvFileName = 'laporan_' . date('Y-m-d') . '.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = ['Judul', 'Lokasi', 'Realisasi', 'Tanggal Realisasi', 'Status'];

        $callback = function() use ($laporans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($laporans as $laporan) {
                $row['Judul'] = $laporan->judul_laporan;
                $row['Lokasi'] = $laporan->lokasi;
                $row['Realisasi'] = $laporan->realisasi;
                $row['Tanggal Realisasi'] = $laporan->tgl_realisasi;
                $row['Status'] = $laporan->status;

                fputcsv($file, array($row['Judul'], $row['Lokasi'], $row['Realisasi'], $row['Tanggal Realisasi'], $row['Status']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadPdf(Request $request)
    {
        // Implementasi unduh PDF
        // ...
    }

    public function removeImage(Request $request, Laporan $laporan)
    {
        $imageToRemove = $request->image;
        $currentImages = is_array($laporan->images) ? $laporan->images : json_decode($laporan->images, true) ?? [];
        
        if (($key = array_search($imageToRemove, $currentImages)) !== false) {
            unset($currentImages[$key]);
            Storage::delete($imageToRemove); // Hapus file dari storage
        }
        
        $laporan->images = array_values($currentImages); // Re-index array
        $laporan->save();
        
        return response()->json(['success' => true]);
    }
}