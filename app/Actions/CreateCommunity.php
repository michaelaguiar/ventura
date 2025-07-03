<?php

namespace App\Actions;

use App\Models\Community;

class CreateCommunity
{
    /**
     * Create a new community.
     *
     * @param string $name
     * @param string $address
     * @param string $contactName
     * @param string $phone
     * @param string $email
     * @param string $logoPath
     * @return Community
     */
    public static function run(
        string $name,
        string $address,
        string $contactName,
        string $phone,
        string $email,
        string $logoPath
    ): Community {
        return Community::create([
            "name" => $name,
            "address" => $address,
            "contact_name" => $contactName,
            "phone" => $phone,
            "email" => $email,
            "logo_path" => $logoPath,
        ]);
    }
}
