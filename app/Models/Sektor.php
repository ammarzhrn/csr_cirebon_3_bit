<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function programs()
    {
        return $this->hasMany(Program::class, 'id_sektor');
    }
}
