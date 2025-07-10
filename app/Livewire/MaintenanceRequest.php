<?php

namespace App\Livewire;

use App\Actions\CreateMaintenanceRequest;
use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use App\Models\Community;
use App\Models\MaintenanceRequest as MaintenanceRequestModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class MaintenanceRequest extends Component
{
    use WithFileUploads;

    public $formData = [
        'title' => null,
        'description' => null,
        'priority' => null,
        'category' => null,
    ];

    public $photos = [];

    public $maintenanceRequests = [];

    public $selectedRequest = null;

    public $showModal = false;

    public $showDetailsModal = false;

    public $modalPage = 1;

    public $perPage = 12;

    public $community = null;

    protected $rules = [
        'formData.title' => 'required|max:255',
        'formData.description' => 'required|max:1000',
        'formData.priority' => 'required|in:low,medium,high,urgent',
        'formData.category' => 'required',
        'photos.*' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'formData.title.required' => 'Title is required',
        'formData.title.max' => 'Title must be less than 255 characters',
        'formData.description.required' => 'Description is required',
        'formData.description.max' => 'Description must be less than 1000 characters',
        'formData.priority.required' => 'Priority is required',
        'formData.priority.in' => 'Priority must be low, medium, high, or urgent',
        'formData.category.required' => 'Category is required',
        'photos.*.image' => 'All files must be images',
        'photos.*.max' => 'Each photo must be less than 2MB',
    ];

    public function mount(Request $request, Community $community): void
    {
        $this->community = $community;
        $this->loadMaintenanceRequests();
    }

    public function loadMaintenanceRequests(): void
    {
        $requests = MaintenanceRequestModel::where(
            'community_id',
            $this->community->id
        )
            ->orderBy('created_at', 'desc')
            ->get();

        $this->maintenanceRequests = $requests
            ->map(function ($request) {
                return [
                    'id' => $request->id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'priority' => $request->priority,
                    'category' => $request->category instanceof MaintenanceRequestCategory
                            ? $request->category->label()
                            : $request->category,
                    'status' => $request->status instanceof MaintenanceRequestStatus
                            ? $request->status->label()
                            : $request->status,
                    'photos' => $request->photos ?? [],
                    'created_at' => $request->created_at,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.maintenance-request')->layout(
            'components.layouts.blank'
        );
    }

    public function addMaintenanceRequest(): void
    {
        $this->validate();

        try {
            // Handle photo uploads
            $photoPaths = [];
            if ($this->photos) {
                foreach ($this->photos as $photo) {
                    $photoPaths[] = $photo->store('maintenance/photos');
                }
            }

            CreateMaintenanceRequest::run(
                community: $this->community,
                user: User::find(1),
                title: $this->formData['title'],
                description: $this->formData['description'],
                priority: $this->formData['priority'],
                category: MaintenanceRequestCategory::from(
                    $this->formData['category']
                ),
                photos: $photoPaths
            );

            // Reset form after successful creation
            $this->formData = [
                'title' => null,
                'description' => null,
                'priority' => null,
                'category' => null,
            ];
            $this->photos = [];

            // Reload maintenance requests from database
            $this->loadMaintenanceRequests();

            // Show success message
            session()->flash(
                'message',
                'Maintenance request created successfully!'
            );
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error(
                'Error creating maintenance request: '.$e->getMessage()
            );

            // Show user-friendly error message
            $this->addError(
                'general',
                'Failed to create maintenance request. Please try again.'
            );
        }
    }

    public function removePhoto($index): void
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            $this->photos = array_values($this->photos); // Re-index array
        }
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

    public function openDetailsModal($requestId): void
    {
        $this->selectedRequest = collect(
            $this->maintenanceRequests
        )->firstWhere('id', $requestId);
        $this->showDetailsModal = true;
    }

    public function closeDetailsModal(): void
    {
        $this->showDetailsModal = false;
        $this->selectedRequest = null;
    }

    public function getModalRequests()
    {
        $offset = ($this->modalPage - 1) * $this->perPage;

        return array_slice($this->maintenanceRequests, $offset, $this->perPage);
    }

    public function getTotalPages()
    {
        return ceil(count($this->maintenanceRequests) / $this->perPage);
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

    public function getPriorityColor($priority): string
    {
        return match ($priority) {
            'low' => 'bg-green-100 text-green-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'high' => 'bg-orange-100 text-orange-800',
            'urgent' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusColor($status): string
    {
        return match (strtolower($status)) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'in progress' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'on hold' => 'bg-orange-100 text-orange-800',
            'requires approval' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
