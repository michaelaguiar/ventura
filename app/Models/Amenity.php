<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = ["community_id", "user_id", "name", "description"];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
