<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'type',
        'description',
        'latitude',
        'longitude'
    ];

    public $timestamps = false;

    // Relación con ViewLogs
    public function viewLogs()
    {
        return $this->hasMany(ViewLog::class, 'attraction_id');
    }

    // Relación con comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class, 'attraction_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id', 'id');
    }

    // Relación para acceder a usuarios que hicieron reviews
    public function usersWhoReviewed()
    {
        return $this->belongsToMany(User::class, 'reviews', 'destination_id', 'user_id');
    }

    // Para obtener el rating promedio fácilmente
    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

}
