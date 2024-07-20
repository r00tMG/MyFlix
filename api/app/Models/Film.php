<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
