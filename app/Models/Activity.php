<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'community_id',
        'user_id',
        'name',
        'start_date_time',
        'end_date_time',
        'location',
        'details',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
