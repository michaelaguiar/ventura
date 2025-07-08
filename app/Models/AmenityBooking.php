<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmenityBooking extends Model
{
    protected $fillable = [
        "community_id",
        "user_id",
        "amenity_name",
        "booking_date",
        "start_time",
        "end_time",
        "guest_count",
        "special_requests",
        "contact_name",
        "contact_phone",
        "contact_email",
        "status",
    ];

    protected $casts = [
        "booking_date" => "date",
        "start_time" => "datetime",
        "end_time" => "datetime",
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
