<?php

namespace App\Livewire;

use App\Actions\CreateActivity as CreateActivityAction;
use App\Models\Activity;
use App\Models\Community;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
    public $showModal = false;
    public $modalPage = 1;
    public $perPage = 12;
    public $community = null;

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

    public function mount(request $request, Community $community): void
    {
        $this->community = $community;
        // Set default dates to today
        $this->formData["start_date"] = Carbon::today()->format("Y-m-d");
        $this->formData["end_date"] = Carbon::today()->format("Y-m-d");

        $this->loadCommunity();
        $this->loadActivities();
    }

    public function loadCommunity(): void
    {
        // Get the first community for demo purposes
        // In a real app, this would be based on the current user's community
        $this->community = Community::query()->first();
    }

    public function loadActivities(): void
    {
        $activities = Activity::where("community_id", 1)
            ->orderBy("start_date_time", "asc")
            ->get();

        $this->activities = $activities
            ->map(function ($activity) {
                return [
                    "id" => $activity->id,
                    "name" => $activity->name,
                    "start_date_time" => Carbon::parse(
                        $activity->start_date_time
                    ),
                    "end_date_time" => Carbon::parse($activity->end_date_time),
                    "location" => $activity->location,
                    "details" => $activity->details,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view("livewire.create-activity")->layout(
            "components.layouts.blank"
        );
    }

    public function addActivity(): void
    {
        $this->validate();

        try {
            CreateActivityAction::run(
                name: $this->formData["name"],
                start_date: $this->formData["start_date"],
                start_time: $this->formData["start_time"],
                end_date: $this->formData["end_date"],
                end_time: $this->formData["end_time"],
                location: $this->formData["location"],
                details: $this->formData["details"]
            );

            // Reset form after successful creation
            $this->formData = [
                "name" => null,
                "start_date" => Carbon::today()->format("Y-m-d"),
                "start_time" => "10:00",
                "end_date" => Carbon::today()->format("Y-m-d"),
                "end_time" => "12:00",
                "location" => null,
                "details" => null,
            ];

            // Reload activities from database
            $this->loadActivities();

            // Show success message
            session()->flash("message", "Activity created successfully!");
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("Error creating activity: " . $e->getMessage());

            // Show user-friendly error message
            $this->addError(
                "general",
                "Failed to create activity. Please try again."
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

    public function openModal(): void
    {
        $this->showModal = true;
        $this->modalPage = 1;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
    }

    public function getModalActivities()
    {
        $offset = ($this->modalPage - 1) * $this->perPage;
        return array_slice($this->activities, $offset, $this->perPage);
    }

    public function getTotalPages()
    {
        return ceil(count($this->activities) / $this->perPage);
    }

    public function previousPage(): void
    {
        if ($this->modalPage > 1) {
            $this->modalPage--;
        }
    }

    public function nextPage(): void
    {
        if ($this->modalPage < $this->getTotalPages()) {
            $this->modalPage++;
        }
    }
}
