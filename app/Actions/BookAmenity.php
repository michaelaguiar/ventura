<?php

namespace App\Actions;

use App\Models\AmenityBooking;
use App\Models\Community;
use App\Models\User;

class BookAmenity
{
    /**
     * Create a new amenity booking
     */
    public static function run(
        Community $community,
        ?User $user,
        string $amenityName,
        string $bookingDate,
        string $startTime,
        string $endTime,
        int $guestCount,
        string $contactName,
        string $contactPhone,
        string $contactEmail,
        ?string $specialRequests = null
    ): AmenityBooking {
        return AmenityBooking::create([
            'community_id' => $community->id,
            'user_id' => $user?->id,
            'amenity_name' => $amenityName,
            'booking_date' => $bookingDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'guest_count' => $guestCount,
            'special_requests' => $specialRequests,
            'contact_name' => $contactName,
            'contact_phone' => $contactPhone,
            'contact_email' => $contactEmail,
            'status' => 'pending',
        ]);
    }
}
