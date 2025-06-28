<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = ["community_id"];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
