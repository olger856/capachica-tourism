<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewLog extends Model
{
    protected $fillable = ['user_id', 'attraction_id'];

    public function attraction() {
        return $this->belongsTo(Attraction::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
