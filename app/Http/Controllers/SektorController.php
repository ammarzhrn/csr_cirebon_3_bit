<?php

namespace App\Http\Controllers;

use App\Models\Sektor;
use App\Models\Program;
use App\Models\Proyek;
use Illuminate\Http\Request;

class SektorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sektor = Sektor::all();
        $proyek = Proyek::with('sektor')->where('status', 'terbit')->get();
        return view('sektor', compact('sektor', 'proyek'));
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
    public function show($id)
    {
        $sektor = Sektor::findOrFail($id);
        $programBySektor = Program::where('id_sektor', $id)->get();
        $proyekByProgram = Proyek::whereIn('id_program', $programBySektor->pluck('id'))->get();

        return view('sektor-detail', compact('sektor', 'programBySektor', 'proyekByProgram'));
    }

    /**
     * Get proyek by program ID.
     */
    public function getProyekByProgram($id)
    {
        // Ambil proyek berdasarkan program ID
        $proyek = Proyek::where('id_program', $id)->get();

        return response()->json(['proyek' => $proyek]);
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