<?php

namespace App\Actions;

use App\Models\Activity;
use App\Models\Community;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateActivity
{
    /**
     * Create a new activity
     */
    public static function run(
        Community $community,
        string $name,
        string $start_date,
        string $start_time,
        string $end_date,
        string $end_time,
        ?string $location = null,
        ?string $details = null
    ): Activity {
        // Validate input data
        $validator = Validator::make(
            [
                "name" => $name,
                "start_date" => $start_date,
                "start_time" => $start_time,
                "end_date" => $end_date,
                "end_time" => $end_time,
                "location" => $location,
                "details" => $details,
            ],
            [
                "name" => "required|max:255",
                "start_date" => "required|date",
                "start_time" => "required",
                "end_date" => "required|date|after_or_equal:start_date",
                "end_time" => "required",
                "location" => "required|max:255",
                "details" => "nullable|max:1000",
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $startDateTime = Carbon::parse($start_date . " " . $start_time);
        $endDateTime = Carbon::parse($end_date . " " . $end_time);

        // Additional datetime validation
        if ($endDateTime->lt($startDateTime)) {
            throw new \InvalidArgumentException(
                "End date and time must be greater than or equal to start date and time"
            );
        }

        return Activity::create([
            "community_id" => $community->id,
            // "user_id" => auth()->id() ?? 1, // Default to user ID 1 for demo
            "name" => $name,
            "start_date_time" => $startDateTime,
            "end_date_time" => $endDateTime,
            "location" => $location,
            "details" => $details,
        ]);
    }
}
