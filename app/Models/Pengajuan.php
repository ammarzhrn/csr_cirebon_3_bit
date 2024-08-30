<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    
    protected $table = 'pengajuans';

    protected $fillable = [
        'nama',
        'tgl_lahir',
        'alamat',
        'no_telp',
        'nama_instansi',
        'mitra_csr',
        'nama_program',
    ];
}
