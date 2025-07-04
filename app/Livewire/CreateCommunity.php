<?php

namespace App\Livewire;

use App\Actions\CreateCommunity as CreateCommunityAction;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCommunity extends Component
{
    use WithFileUploads;

    public $formData = [
        'name' => null,
        'address' => null,
        'contactName' => null,
        'phone' => null,
        'email' => null,
    ];

    public $logo;

    protected $rules = [
        'formData.name' => 'required|max:255',
        'formData.address' => 'required|max:255',
        'formData.contactName' => 'required|max:255',
        'formData.phone' => 'required',
        'formData.email' => 'required|email|max:255',
        'logo' => 'nullable|image|max:12288',
    ];

    protected $messages = [
        'formData.name.required' => 'Name is required',
        'formData.name.max' => 'Name must be less than 255 characters',
        'formData.address.required' => 'Address is required',
        'formData.address.max' => 'Address must be less than 255 characters',
        'formData.contactName.required' => 'Community Contact Name is required',
        'formData.contactName.max' => 'Community Contact Name must be less than 255 characters',
        'formData.phone.required' => 'Phone Number is required',
        'formData.email.required' => 'Email Address is required',
        'formData.email.email' => 'Email Address must be valid',
        'formData.email.max' => 'Email Address must be less than 255 characters',
    ];

    public function render()
    {
        return view('livewire.create-community')->layout(
            'components.layouts.blank'
        );
    }

    public function next()
    {
        $this->validate();

        // Store photo to cloud storage
        $photo = $this->logo->store('community/logos');

        $community = CreateCommunityAction::run(
            name: $this->formData['name'],
            address: $this->formData['address'],
            contactName: $this->formData['contactName'],
            phone: $this->formData['phone'],
            email: $this->formData['email'],
            logoPath: $photo
        );

        return redirect()->route('community.activities', $community);
    }
}
