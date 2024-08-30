<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Summary;
use App\Models\Laporan;
use App\Models\User;

class MitraListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('level', 'mitra')
            ->join('summary', 'users.id', '=', 'summary.id_user') // Ubah 'summaries' menjadi 'summary'
            ->leftJoinSub(
                Laporan::groupByMitra(),
                'laporan_counts',
                'users.id',
                '=',
                'laporan_counts.id_user'
            )
            ->select('users.*', 'summary.*', 'laporan_counts.laporan_count'); // Ubah 'summaries.*' menjadi 'summary.*'

        // Filter berdasarkan jumlah laporan
        if ($request->has('filter')) {
            if ($request->filter === 'terbanyak') {
                $query->orderByDesc('laporan_count');
            } elseif ($request->filter === 'tersedikit') {
                $query->orderBy('laporan_count');
            }
        }

        // Pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('summary.nama_mitra', 'like', "%{$search}%"); // Ubah 'summaries' menjadi 'summary'
        }

        $mitra = $query->get();
        return view('mitra-list.index', compact('mitra'));
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
        $mitra = Summary::findOrFail($id);
        return view('mitra-list.detail', compact('mitra'));
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
