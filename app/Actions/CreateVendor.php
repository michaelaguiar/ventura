<?php

namespace App\Actions;

use App\Models\Community;
use App\Models\Vendor;

class CreateVendor
{
    /**
     * Create a new vendor
     */
    public static function run(
        Community $community,
        string $name,
        string $phone,
        string $category,
        ?string $logoPath = null
    ): Vendor {
        return Vendor::create([
            'community_id' => $community->id,
            'name' => $name,
            'phone' => $phone,
            'category' => $category,
            'logo_path' => $logoPath,
        ]);
    }
}
