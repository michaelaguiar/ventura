<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MaintenancePhotoController extends Controller
{
    /**
     * Display the specified photo.
     */
    public function show(
        MaintenanceRequest $maintenanceRequest,
        int $photoIndex
    ): Response|StreamedResponse {
        // Check if the photo exists
        if (
            !$maintenanceRequest->photos ||
            !isset($maintenanceRequest->photos[$photoIndex])
        ) {
            abort(404, "Photo not found");
        }

        $photoPath = $maintenanceRequest->photos[$photoIndex];

        // Check if file exists in storage
        if (!Storage::disk("gcs")->exists($photoPath)) {
            abort(404, "Photo file not found");
        }

        // Get the file content
        $file = Storage::disk("gcs")->get($photoPath);
        $mimeType = Storage::disk("gcs")->mimeType($photoPath);

        // Return the file with proper headers
        return response($file, 200, [
            "Content-Type" => $mimeType,
            "Content-Disposition" => "inline",
            "Cache-Control" => "public, max-age=86400",
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, HEAD, OPTIONS",
            "Access-Control-Allow-Headers" => "Content-Type, Authorization",
        ]);
    }

    /**
     * Stream the specified photo.
     */
    public function stream(
        MaintenanceRequest $maintenanceRequest,
        int $photoIndex
    ): StreamedResponse {
        // Check if the photo exists
        if (
            !$maintenanceRequest->photos ||
            !isset($maintenanceRequest->photos[$photoIndex])
        ) {
            abort(404, "Photo not found");
        }

        $photoPath = $maintenanceRequest->photos[$photoIndex];

        // Check if file exists in storage
        if (!Storage::disk("gcs")->exists($photoPath)) {
            abort(404, "Photo file not found");
        }

        $mimeType = Storage::disk("gcs")->mimeType($photoPath);
        $size = Storage::disk("gcs")->size($photoPath);

        return Storage::disk("gcs")->response($photoPath, null, [
            "Content-Type" => $mimeType,
            "Content-Length" => $size,
            "Cache-Control" => "public, max-age=86400",
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, HEAD, OPTIONS",
            "Access-Control-Allow-Headers" => "Content-Type, Authorization",
        ]);
    }

    /**
     * Get photo metadata.
     */
    public function metadata(
        MaintenanceRequest $maintenanceRequest,
        int $photoIndex
    ): Response {
        // Check if the photo exists
        if (
            !$maintenanceRequest->photos ||
            !isset($maintenanceRequest->photos[$photoIndex])
        ) {
            abort(404, "Photo not found");
        }

        $photoPath = $maintenanceRequest->photos[$photoIndex];

        // Check if file exists in storage
        if (!Storage::disk("gcs")->exists($photoPath)) {
            abort(404, "Photo file not found");
        }

        $metadata = [
            "path" => $photoPath,
            "size" => Storage::disk("gcs")->size($photoPath),
            "mime_type" => Storage::disk("gcs")->mimeType($photoPath),
            "last_modified" => Storage::disk("gcs")->lastModified($photoPath),
            "url" => route("maintenance-photos.show", [
                "maintenanceRequest" => $maintenanceRequest->id,
                "photoIndex" => $photoIndex,
            ]),
        ];

        return response()->json($metadata, 200, [
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, HEAD, OPTIONS",
            "Access-Control-Allow-Headers" => "Content-Type, Authorization",
        ]);
    }

    /**
     * Handle preflight requests.
     */
    public function options(): Response
    {
        return response("", 200, [
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "GET, HEAD, OPTIONS",
            "Access-Control-Allow-Headers" => "Content-Type, Authorization",
            "Access-Control-Max-Age" => "86400",
        ]);
    }

    /**
     * Delete the specified photo.
     */
    public function destroy(
        Request $request,
        MaintenanceRequest $maintenanceRequest,
        int $photoIndex
    ): Response {
        // Check if the photo exists
        if (
            !$maintenanceRequest->photos ||
            !isset($maintenanceRequest->photos[$photoIndex])
        ) {
            if ($request->wantsJson()) {
                return response()->json(["error" => "Photo not found"], 404);
            }
            abort(404, "Photo not found");
        }

        $photoPath = $maintenanceRequest->photos[$photoIndex];
        $photos = $maintenanceRequest->photos;

        // Delete the file from storage
        if (Storage::disk("gcs")->exists($photoPath)) {
            Storage::disk("gcs")->delete($photoPath);
        }

        // Remove the photo from the array
        unset($photos[$photoIndex]);
        // Reindex the array to maintain sequential indices
        $photos = array_values($photos);

        // Update the maintenance request
        $maintenanceRequest->update(["photos" => $photos]);

        // Return appropriate response based on request type
        if ($request->wantsJson()) {
            return response()->json([
                "success" => true,
                "message" => "Photo deleted successfully.",
            ]);
        }

        // Redirect back to the edit page with success message
        return redirect()
            ->route(
                "filament.admin.resources.maintenance-requests.edit",
                $maintenanceRequest
            )
            ->with("success", "Photo deleted successfully.");
    }
}
