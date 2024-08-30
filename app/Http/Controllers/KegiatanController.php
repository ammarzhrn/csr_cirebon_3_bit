<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'terbaru');

        $query = Kegiatan::where('status', 'terbit');

        if ($sort === 'terbaru') {
            $query->latest();
        } elseif ($sort === 'terlama') {
            $query->oldest();
        }

        $kegiatan = $query->get()->map(function ($item) {
            $stripped = Str::of(strip_tags($item->deskripsi))->squish();
            $item->deskripsi_singkat = $stripped->limit(100);
            $item->foto_url = $item->foto ? Storage::url($item->foto) : null;
            return $item;
        });

        return view('kegiatan.index', compact('kegiatan', 'sort'));
    }

    public function getProjects($id)
    {
        $proyek = Proyek::where('id_program', $id)->get();
        return response()->json(['proyek' => $proyek]);
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
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->foto_url = $kegiatan->foto ? Storage::url($kegiatan->foto) : null;
        return view('kegiatan.detail', compact('kegiatan'));
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
