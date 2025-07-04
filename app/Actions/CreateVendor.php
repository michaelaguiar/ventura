<?php

namespace App\Actions;

use App\Models\Vendor;
use App\Models\Community;

class CreateVendor
{
    /**
     * Create a new vendor
     *
     * @param Community $community
     * @param string $name
     * @param string $phone
     * @param string $category
     * @param string|null $logoPath
     * @return Vendor
     */
    public static function run(
        Community $community,
        string $name,
        string $phone,
        string $category,
        string $logoPath = null
    ): Vendor {
        return Vendor::create([
            "community_id" => $community->id,
            "name" => $name,
            "phone" => $phone,
            "category" => $category,
            "logo_path" => $logoPath,
        ]);
    }
}
