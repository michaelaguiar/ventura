<?php

namespace App\Actions;

use App\Models\Activity;
use Carbon\Carbon;

class CreateActivity
{
    /**
     * Create a new activity
     *
     * @param string $name
     * @param string $start_date
     * @param string $start_time
     * @param string $end_date
     * @param string $end_time
     * @param string $location
     * @param string $details
     * @return Activity
     */
    public static function run(
        string $name,
        string $start_date,
        string $start_time,
        string $end_date,
        string $end_time,
        string $location,
        string $details
    ): Activity {
        $startDateTime = Carbon::parse($start_date . " " . $start_time);
        $endDateTime = Carbon::parse($end_date . " " . $end_time);

        return Activity::create([
            "community_id" => 1,
            // "user_id" => auth()->id() ?? 1, // Default to user ID 1 for demo
            "name" => $name,
            "start_date_time" => $startDateTime,
            "end_date_time" => $endDateTime,
            "location" => $location,
            "details" => $details,
        ]);
    }
}
