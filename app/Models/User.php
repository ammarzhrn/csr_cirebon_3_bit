<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function summary()
    {
        return $this->hasOne(Summary::class, 'id_user');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_user');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->summary()->create([
                'nama' => $user->name,
                'email' => $user->email,
            ]);
            $user->is_summary = true;
            $user->save();
        });
    }
}