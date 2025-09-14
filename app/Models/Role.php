<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importa User para la relación

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
