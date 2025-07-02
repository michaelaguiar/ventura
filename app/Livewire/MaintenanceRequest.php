<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class MaintenanceRequest extends Component
{
    use WithFileUploads;

    public $formData = [
        "name" => null,
        "address" => null,
        "contactName" => null,
        "phone" => null,
        "contactEmail" => null,
    ];

    public $logo;

    protected $rules = [
        "formData.name" => "required|max:255",
        "formData.address" => "required|max:255",
        "formData.contactName" => "required|max:255",
        "formData.phone" => "required",
        "formData.contactEmail" => "required|email|max:255",
        "logo" => "nullable|image|max:1024",
    ];

    protected $messages = [
        "formData.name.required" => "Name is required",
        "formData.name.max" => "Name must be less than 255 characters",
        "formData.address.required" => "Address is required",
        "formData.address.max" => "Address must be less than 255 characters",
        "formData.contactName.required" => "Community Contact Name is required",
        "formData.contactName.max" =>
            "Community Contact Name must be less than 255 characters",
        "formData.phone.required" => "Phone Number is required",
        "formData.contactEmail.required" => "Email Address is required",
        "formData.contactEmail.email" => "Email Address must be valid",
        "formData.contactEmail.max" =>
            "Email Address must be less than 255 characters",
    ];

    public function render()
    {
        return view("livewire.maintenance-request")->layout(
            "components.layouts.blank"
        );
    }

    public function next()
    {
        $this->validate();

        // Store photo to cloud storage
        $photo = $this->logo->store("community/logos");

        // Update formdata with photo
        $this->formData["logo_path"] = $photo;

        dd($this->formData);

        CreateCommunity::create($this->formData);
    }
}
