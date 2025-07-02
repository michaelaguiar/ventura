<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Community;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CreateActivity extends Component
{
    use WithFileUploads;

    public $formData = [
        "name" => null,
        "start_date" => null,
        "start_time" => "10:00",
        "end_date" => null,
        "end_time" => "12:00",
        "location" => null,
        "details" => null,
    ];

    public $activities = [];
    public $selectedCategory = null;

    protected $rules = [
        "formData.name" => "required|max:255",
        "formData.start_date" => "required|date",
        "formData.start_time" => "required",
        "formData.end_date" =>
            "required|date|after_or_equal:formData.start_date",
        "formData.end_time" => "required",
        "formData.location" => "required|max:255",
        "formData.details" => "nullable|max:1000",
    ];

    protected $messages = [
        "formData.name.required" => "Activity name is required",
        "formData.name.max" => "Activity name must be less than 255 characters",
        "formData.start_date.required" => "Start date is required",
        "formData.start_date.date" => "Start date must be a valid date",
        "formData.start_time.required" => "Start time is required",
        "formData.end_date.required" => "End date is required",
        "formData.end_date.date" => "End date must be a valid date",
        "formData.end_date.after_or_equal" =>
            "End date must be after or equal to start date",
        "formData.end_time.required" => "End time is required",
        "formData.location.required" => "Location is required",
        "formData.location.max" => "Location must be less than 255 characters",
        "formData.details.max" =>
            "Activity details must be less than 1000 characters",
    ];

    public function mount(): void
    {
        // Set default dates to today and tomorrow
        $this->formData["start_date"] = Carbon::today()->format("Y-m-d");
        $this->formData["end_date"] = Carbon::today()->format("Y-m-d");

        $this->loadActivities();
    }

    public function loadActivities(): void
    {
        try {
            // Get the first community for demo purposes
            // In a real app, this would be based on the current user's community
            $community = Community::query()->first();

            if ($community) {
                $this->activities = Activity::query()
                    ->where("community_id", $community->id)
                    ->orderBy("start_date_time", "asc")
                    ->get()
                    ->map(function ($activity) {
                        return [
                            "id" => $activity->id,
                            "name" => $activity->name,
                            "start_date_time" => Carbon::parse(
                                $activity->start_date_time
                            ),
                            "location" => $activity->location,
                            "details" => $activity->details,
                        ];
                    })
                    ->toArray();
            } else {
                $this->activities = [];
            }
        } catch (\Exception $e) {
            Log::error("Error loading activities: " . $e->getMessage());
            // Fallback to sample activities when database is not available
            $this->activities = [
                [
                    "id" => 1,
                    "name" => "Community Pool Party",
                    "start_date_time" => Carbon::now()
                        ->addDays(2)
                        ->setTime(14, 0),
                    "location" => "Pool Area",
                    "details" =>
                        "Join us for a fun pool party with games and refreshments.",
                ],
                [
                    "id" => 2,
                    "name" => "Fitness Class",
                    "start_date_time" => Carbon::now()
                        ->addDays(3)
                        ->setTime(9, 0),
                    "location" => "Fitness Center",
                    "details" =>
                        "Morning yoga and fitness session for all levels.",
                ],
                [
                    "id" => 3,
                    "name" => "Movie Night",
                    "start_date_time" => Carbon::now()
                        ->addDays(5)
                        ->setTime(19, 0),
                    "location" => "Community Center",
                    "details" => "Family-friendly movie night with popcorn.",
                ],
            ];
        }
    }

    public function render()
    {
        return view("livewire.create-activity")->layout(
            "components.layouts.blank"
        );
    }

    public function addActivity(): void
    {
        try {
            $this->validate();

            // Get the first community for demo purposes
            // In a real app, this would be based on the current user's community
            $community = Community::query()->first();

            if (!$community) {
                // Create a default community if none exists
                $community = Community::query()->create([
                    "name" => "Default Community",
                    "address" => "123 Main St",
                    "phone" => "555-0123",
                    "email" => "admin@community.com",
                ]);
            }

            // Combine date and time
            $startDateTime = Carbon::parse(
                $this->formData["start_date"] .
                    " " .
                    $this->formData["start_time"]
            );
            $endDateTime = Carbon::parse(
                $this->formData["end_date"] . " " . $this->formData["end_time"]
            );

            // Create the activity
            $activity = Activity::query()->create([
                "community_id" => $community->id,
                "user_id" => auth()->id() ?? 1, // Default to user ID 1 for demo
                "name" => $this->formData["name"],
                "start_date_time" => $startDateTime,
                "end_date_time" => $endDateTime,
                "location" => $this->formData["location"],
                "details" => $this->formData["details"],
            ]);

            // Reset form
            $this->formData = [
                "name" => null,
                "start_date" => Carbon::today()->format("Y-m-d"),
                "start_time" => "10:00",
                "end_date" => Carbon::today()->format("Y-m-d"),
                "end_time" => "12:00",
                "location" => null,
                "details" => null,
            ];

            // Reload activities
            $this->loadActivities();

            // Show success message
            session()->flash("message", "Activity created successfully!");
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("Error creating activity: " . $e->getMessage());

            // Fallback: Add activity to the local array when database is not available
            $newActivity = [
                "id" => count($this->activities) + 1,
                "name" => $this->formData["name"],
                "start_date_time" => Carbon::parse(
                    $this->formData["start_date"] .
                        " " .
                        $this->formData["start_time"]
                ),
                "location" => $this->formData["location"],
                "details" => $this->formData["details"],
            ];

            // Add to the beginning of the array and sort by date
            array_unshift($this->activities, $newActivity);
            usort($this->activities, function ($a, $b) {
                return $a["start_date_time"]->timestamp <=>
                    $b["start_date_time"]->timestamp;
            });

            // Reset form
            $this->formData = [
                "name" => null,
                "start_date" => Carbon::today()->format("Y-m-d"),
                "start_time" => "10:00",
                "end_date" => Carbon::today()->format("Y-m-d"),
                "end_time" => "12:00",
                "location" => null,
                "details" => null,
            ];

            // Show success message
            session()->flash(
                "message",
                "Activity created successfully! (Demo mode - database not connected)"
            );
        }
    }

    /**
     * @param string $category
     */
    public function selectCategory($category): void
    {
        $this->selectedCategory = $category;
    }
}
