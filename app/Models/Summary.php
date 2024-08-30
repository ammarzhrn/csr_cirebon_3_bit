<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;

    protected $table = 'summary';

    protected $fillable = [
        'id_user',
        'foto_pp',
        'nama_mitra',
        'nama',
        'no_telp',
        'email',
        'alamat',
        'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}