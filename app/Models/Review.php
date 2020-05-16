<?php

namespace App\Models;

use App\User;
use App\Models\Area;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
