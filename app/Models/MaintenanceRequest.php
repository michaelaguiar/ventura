<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    protected $fillable = [
        "community_id",
        "user_id",
        "title",
        "description",
        "priority",
        "category",
        "status",
        "photos",
    ];

    protected $casts = [
        "photos" => "array",
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
