<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación uno a muchos (role_id en users)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relación uno a muchos con comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Método booted para asignar rol turista por defecto al crear usuario
    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->role_id) {
                $turistaRole = Role::where('name', 'turista')->first();
                $user->role_id = $turistaRole ? $turistaRole->id : null;
            }
        });
    }
    public function histories()
    {
        return $this->hasMany(UserHistory::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

}
