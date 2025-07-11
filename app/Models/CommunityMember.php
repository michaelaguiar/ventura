<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommunityMember extends Model
{
    protected $fillable = [
        "community_id",
        "user_id",
        "joined_at",
        "role",
        "is_active",
    ];

    protected $casts = [
        "joined_at" => "datetime",
        "is_active" => "boolean",
    ];

    /**
     * Get the community that owns the membership.
     *
     * @return BelongsTo<Community,CommunityMember>
     */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }

    /**
     * Get the user that owns the membership.
     *
     * @return BelongsTo<User,CommunityMember>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
