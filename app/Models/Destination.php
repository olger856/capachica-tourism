<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

    protected $primaryKey = 'destination_id'; // Definido en la migración
    protected $fillable = [
        'name',
        'state',
        'type',
        'popularity',
        'best_time_to_visit'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'destination_id', 'destination_id');
    }

    public function histories()
    {
        return $this->hasMany(UserHistory::class, 'destination_id', 'destination_id');
    }

    /**
     * Relación con las atracciones del destino
     */
    public function attractions(): HasMany
    {
        return $this->hasMany(Attraction::class);
    }

}
