<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi lewat mass assignment.
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat model di-serialize.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'uploader_id');
    }
}
