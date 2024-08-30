<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Mitra;
use App\Models\User;

class MitraController extends Controller
{

    public function mitra()
    {
        // Tambahkan logika yang diperlukan di sini
        return view('mitra');
    }

    public function edit()
    {
        $user = Auth::user();
        $mitra = $user->mitra ?? new Mitra(); // Jika tidak ada mitra, buat objek kosong
        return view('profile.edit', compact('user', 'mitra'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $mitra = $user->mitra;

        $validated = $request->validate([
            'nama_mitra' => ['required', 'string', 'max:255'],
            'nama_pt' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:20'],
            'email_perusahaan' => ['required', 'string', 'email', 'max:255', Rule::unique('mitras')->ignore($mitra->id)],
            'alamat' => ['nullable', 'string', 'max:500'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'foto_mitra' => ['nullable', 'image','mimes:jpeg,png,jpg','max:2048'], // 2MB Max
        ]);

        $mitra->update($validated);

        if ($request->hasFile('foto_mitra')) {
            $path = $request->file('foto_mitra')->store('mitra_photos', 'public');
            $mitra->foto_mitra = $path;
            $mitra->save();
        }

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    public function show()
    {
        $user = Auth::user();
        $mitra = $user->mitra;
        return view('profile.profile', compact('user', 'mitra'));
    }


}