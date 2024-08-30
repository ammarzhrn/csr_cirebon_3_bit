<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_sektor',
        'id_program',
        'id_proyek',
        'judul_laporan',
        'tanggal',
        'bulan',
        'tahun',
        'realisasi',
        'deskripsi',
        'images',
        'status',
        'pesan_admin'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'id_sektor');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek')->diterbitkan();
    }

    public function getThumbnailAttribute()
    {
        $images = $this->images;
        return !empty($images) ? $images[0] : 'images/thumbnail.png';
    }

    public function getImagesAttribute($value)
    {
        return is_string($value) ? json_decode($value, true) : (is_array($value) ? $value : []);
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = is_array($value) ? json_encode($value) : $value;
    }

    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_string($value) ? json_decode($value, true) : $value,
            set: fn ($value) => is_array($value) ? json_encode($value) : $value,
        );
    }

    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit');
    }

    // Tambahkan method baru untuk menghitung jumlah laporan
    public function scopeWithLaporanCount($query)
    {
        return $query->withCount('laporan');
    }

    // Tambahkan scope untuk menghitung jumlah laporan per mitra
    public function scopeGroupByMitra($query)
    {
        return $query->select('id_user')
                     ->selectRaw('COUNT(*) as laporan_count')
                     ->groupBy('id_user');
    }
}