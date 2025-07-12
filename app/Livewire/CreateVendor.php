<?php

namespace App\Livewire;

use App\Actions\CreateVendor as CreateVendorAction;
use App\Models\Community;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVendor extends Component
{
    use WithFileUploads;

    public $formData = [
        "name" => null,
        "phone" => null,
        "email" => null,
        "website" => null,
        "contact_name" => null,
        "category" => null,
    ];

    public $logo;

    public $vendors = [];

    public $selectedCategory = null;

    public $showModal = false;

    public $modalPage = 1;

    public $perPage = 12;

    public $community = null;

    public $showVendorDetail = false;

    public $selectedVendor = null;

    protected $rules = [
        "formData.name" => "required|max:255",
        "formData.phone" => "required|max:20",
        "formData.email" => "nullable|email|max:255",
        "formData.website" => "nullable|url|max:255",
        "formData.contact_name" => "nullable|max:255",
        "formData.category" => "required|max:255",
        "logo" => "nullable|image|max:12288",
    ];

    protected $messages = [
        "formData.name.required" => "Vendor name is required",
        "formData.name.max" => "Vendor name must be less than 255 characters",
        "formData.phone.required" => "Phone number is required",
        "formData.phone.max" => "Phone number must be less than 20 characters",
        "formData.email.email" => "Please enter a valid email address",
        "formData.email.max" => "Email must be less than 255 characters",
        "formData.website.url" => "Please enter a valid website URL",
        "formData.website.max" => "Website must be less than 255 characters",
        "formData.contact_name.max" =>
            "Contact name must be less than 255 characters",
        "formData.category.required" => "Category is required",
        "formData.category.max" => "Category must be less than 255 characters",
        "logo.image" => "Logo must be an image",
        "logo.max" => "Logo must be less than 1MB",
    ];

    public function mount(request $request, Community $community): void
    {
        $this->community = $community;
        $this->loadVendors();
    }

    public function loadVendors(): void
    {
        $vendors = Vendor::where("community_id", $this->community->id)
            ->orderBy("name", "asc")
            ->get();

        $this->vendors = $vendors
            ->map(function ($vendor) {
                return [
                    "id" => $vendor->id,
                    "name" => $vendor->name,
                    "phone" => $vendor->phone,
                    "email" => $vendor->email,
                    "website" => $vendor->website,
                    "contact_name" => $vendor->contact_name,
                    "category" => $vendor->category,
                    "logo_path" => $vendor->logo_path,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view("livewire.create-vendor")->layout(
            "components.layouts.blank"
        );
    }

    public function addVendor(): void
    {
        $this->validate();

        try {
            // Handle logo upload
            $logoPath = null;
            if ($this->logo) {
                $logoPath = $this->logo->store("vendors/logos");
            }

            CreateVendorAction::run(
                community: $this->community,
                name: $this->formData["name"],
                phone: $this->formData["phone"],
                email: $this->formData["email"],
                website: $this->formData["website"],
                contactName: $this->formData["contact_name"],
                category: $this->formData["category"],
                logoPath: $logoPath
            );

            // Reset form after successful creation
            $this->formData = [
                "name" => null,
                "phone" => null,
                "email" => null,
                "website" => null,
                "contact_name" => null,
                "category" => null,
            ];
            $this->logo = null;

            // Reload vendors from database
            $this->loadVendors();

            // Show success message
            session()->flash("message", "Vendor created successfully!");
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error("Error creating vendor: " . $e->getMessage());

            // Show user-friendly error message
            $this->addError(
                "general",
                "Failed to create vendor. Please try again."
            );
        }
    }

    /**
     * @param  string  $category
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

    public function getModalVendors()
    {
        $offset = ($this->modalPage - 1) * $this->perPage;

        return array_slice($this->vendors, $offset, $this->perPage);
    }

    public function getTotalPages()
    {
        return ceil(count($this->vendors) / $this->perPage);
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

    public function showVendorDetails($vendorId): void
    {
        Log::info("showVendorDetails called", ["vendorId" => $vendorId]);
        $vendor = collect($this->vendors)->firstWhere("id", $vendorId);

        if ($vendor) {
            $this->selectedVendor = $vendor;
            $this->showVendorDetail = true;
        }
    }

    public function closeVendorDetail(): void
    {
        Log::info("closeVendorDetail called");
        $this->showVendorDetail = false;
        $this->selectedVendor = null;
    }

    public function testMethod(): void
    {
        Log::info("testMethod called - Livewire is working!");
        session()->flash("message", "Test method called successfully!");
    }
}
