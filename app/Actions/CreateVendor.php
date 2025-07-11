<?php

namespace App\Actions;

use App\Models\Community;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateVendor
{
    /**
     * Create a new vendor
     */
    public static function run(
        Community $community,
        string $name,
        string $phone,
        ?string $email,
        ?string $website,
        ?string $contactName,
        string $category,
        ?string $logoPath = null
    ): Vendor {
        // Validate input data
        $validator = Validator::make(
            [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'website' => $website,
                'contact_name' => $contactName,
                'category' => $category,
            ],
            [
                'name' => 'required|max:255',
                'phone' => 'required|max:20',
                'email' => 'nullable|email|max:255',
                'website' => 'nullable|url|max:255',
                'contact_name' => 'nullable|max:255',
                'category' => 'required|max:255',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return Vendor::create([
            'community_id' => $community->id,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'website' => $website,
            'contact_name' => $contactName,
            'category' => $category,
            'logo_path' => $logoPath,
        ]);
    }
}
