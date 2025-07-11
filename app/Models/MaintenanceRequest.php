<?php

namespace App\Models;

use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MaintenanceRequest extends Model
{
    protected $fillable = [
        'community_id',
        'user_id',
        'title',
        'description',
        'priority',
        'category',
        'status',
        'photos',
    ];

    protected $casts = [
        'photos' => 'array',
        'status' => MaintenanceRequestStatus::class,
        'category' => MaintenanceRequestCategory::class,
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the photo URLs for display using local routes
     */
    public function getPhotoUrlsAttribute(): array
    {
        if (! $this->photos) {
            return [];
        }

        return collect($this->photos)
            ->map(function ($photo, $index) {
                return route('maintenance-photos.show', [
                    'maintenanceRequest' => $this->id,
                    'photoIndex' => $index,
                ]);
            })
            ->toArray();
    }

    /**
     * Get a single photo URL by index using local route
     */
    public function getPhotoUrl(int $index): ?string
    {
        if (! $this->photos || ! isset($this->photos[$index])) {
            return null;
        }

        return route('maintenance-photos.show', [
            'maintenanceRequest' => $this->id,
            'photoIndex' => $index,
        ]);
    }

    /**
     * Get public photo URLs (for admin interface)
     */
    public function getPublicPhotoUrls(): array
    {
        if (! $this->photos) {
            return [];
        }

        return collect($this->photos)
            ->map(function ($photo) {
                return Storage::disk('gcs')->url($photo);
            })
            ->toArray();
    }

    /**
     * Check if maintenance request has photos
     */
    public function hasPhotos(): bool
    {
        return ! empty($this->photos);
    }

    /**
     * Get photo count
     */
    public function getPhotoCount(): int
    {
        return count($this->photos ?? []);
    }

    /**
     * Get photo file information
     */
    public function getPhotoFileInfo(int $index): ?array
    {
        if (! $this->photos || ! isset($this->photos[$index])) {
            return null;
        }

        $photoPath = $this->photos[$index];

        try {
            $fileSize = Storage::disk('gcs')->size($photoPath);
            $mimeType = Storage::disk('gcs')->mimeType($photoPath);

            return [
                'name' => basename($photoPath),
                'size' => $fileSize,
                'size_formatted' => $fileSize
                    ? number_format($fileSize / 1024, 1).' KB'
                    : 'Unknown size',
                'mime_type' => $mimeType,
            ];
        } catch (\Exception $e) {
            return [
                'name' => basename($photoPath),
                'size' => 0,
                'size_formatted' => 'Unknown size',
                'mime_type' => 'image/jpeg',
            ];
        }
    }
}
