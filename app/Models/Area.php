<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Area extends Model
{
    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
