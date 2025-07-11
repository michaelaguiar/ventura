<?php

namespace App\Filament\Resources;

use App\Enums\MaintenanceRequestCategory;
use App\Enums\MaintenanceRequestStatus;
use App\Filament\Resources\MaintenanceRequestResource\Pages;
use App\Models\Community;
use App\Models\MaintenanceRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MaintenanceRequestResource extends Resource
{
    protected static ?string $model = MaintenanceRequest::class;

    protected static ?string $navigationIcon = "heroicon-o-wrench-screwdriver";

    protected static ?string $navigationGroup = "Community Management";

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make("Request Information")->schema([
                Forms\Components\Select::make("community_id")
                    ->label("Community")
                    ->options(Community::all()->pluck("name", "id"))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make("user_id")
                    ->label("User")
                    ->options(User::all()->pluck("name", "id"))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make("title")
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make("description")
                    ->required()
                    ->maxLength(1000)
                    ->rows(4),
            ]),
            Forms\Components\Section::make("Request Details")->schema([
                Forms\Components\Select::make("category")
                    ->options(
                        collect(MaintenanceRequestCategory::cases())
                            ->mapWithKeys(
                                fn($case) => [
                                    $case->value => $case->label(),
                                ]
                            )
                            ->toArray()
                    )
                    ->required(),
                Forms\Components\Select::make("priority")
                    ->options([
                        "low" => "Low",
                        "medium" => "Medium",
                        "high" => "High",
                        "urgent" => "Urgent",
                    ])
                    ->required()
                    ->default("medium"),
                Forms\Components\Select::make("status")
                    ->options(
                        collect(MaintenanceRequestStatus::cases())
                            ->mapWithKeys(
                                fn($case) => [
                                    $case->value => $case->label(),
                                ]
                            )
                            ->toArray()
                    )
                    ->required()
                    ->default("pending"),
            ]),
            Forms\Components\Section::make("Photos")
                ->visible(
                    fn($livewire) => !(
                        $livewire instanceof
                        \App\Filament\Resources\MaintenanceRequestResource\Pages\EditMaintenanceRequest
                    )
                )
                ->schema([
                    Forms\Components\Placeholder::make("existing_photos")
                        ->label("Current Photos")
                        ->content(function ($record) {
                            if (!$record || empty($record->photos)) {
                                return "";
                            }

                            $photosHtml = "<div>";

                            // Photo Grid
                            $photosHtml .=
                                '<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">';

                            foreach ($record->photos as $index => $photo) {
                                $photoUrl = route("maintenance-photos.show", [
                                    "maintenanceRequest" => $record->id,
                                    "photoIndex" => $index,
                                ]);
                                $fileInfo =
                                    $record->getPhotoFileInfo($index) ?? [];
                                $fileName = $fileInfo["name"] ?? "Unknown file";
                                $fileSizeFormatted =
                                    $fileInfo["size_formatted"] ??
                                    "Unknown size";

                                $photosHtml .=
                                    '<div class="photo-grid-item bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow cursor-pointer" onclick="openMaintenancePhotoModal(' .
                                    $index .
                                    ')">';
                                $photosHtml .= '<div class="relative group">';
                                $photosHtml .=
                                    '<img src="' .
                                    $photoUrl .
                                    '" alt="Photo ' .
                                    ($index + 1) .
                                    '" class="w-full h-32 object-cover rounded-t-lg hover:opacity-90 transition-opacity" loading="lazy" />';
                                $photosHtml .=
                                    '<div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-200 rounded-t-lg flex items-center justify-center">';
                                $photosHtml .=
                                    '<div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">';
                                $photosHtml .=
                                    '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                $photosHtml .=
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>';
                                $photosHtml .=
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
                                $photosHtml .= "</svg>";
                                $photosHtml .= "</div>";
                                $photosHtml .= "</div>";
                                $photosHtml .= "</div>";
                                $photosHtml .= '<div class="p-3">';
                                $photosHtml .=
                                    '<div class="flex items-center justify-between mb-2">';
                                $photosHtml .=
                                    '<span class="text-sm font-medium text-gray-900 dark:text-white truncate">Photo ' .
                                    ($index + 1) .
                                    "</span>";
                                $photosHtml .=
                                    '<button onclick="event.stopPropagation(); confirmDeletePhoto(' .
                                    $index .
                                    ')" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors" title="Delete photo">';
                                $photosHtml .=
                                    '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                                $photosHtml .=
                                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>';
                                $photosHtml .= "</svg>";
                                $photosHtml .= "</button>";
                                $photosHtml .= "</div>";
                                $photosHtml .=
                                    '<p class="text-xs text-gray-500 dark:text-gray-400 truncate" title="' .
                                    htmlspecialchars($fileName) .
                                    '">' .
                                    htmlspecialchars($fileName) .
                                    "</p>";
                                $photosHtml .=
                                    '<p class="text-xs text-gray-500 dark:text-gray-400">' .
                                    htmlspecialchars($fileSizeFormatted) .
                                    "</p>";
                                $photosHtml .= "</div>";
                                $photosHtml .= "</div>";
                            }

                            $photosHtml .= "</div>";
                            $photosHtml .=
                                '<p class="text-xs text-gray-500 dark:text-gray-400 mt-4">Click on any photo to view it in full size</p>';

                            // Photo Modal
                            $photosHtml .=
                                '<div id="maintenancePhotoModal" class="fixed inset-0 z-[100] hidden bg-black/50 backdrop-blur-sm" onclick="closeMaintenancePhotoModal()" role="dialog" aria-modal="true" aria-labelledby="modal-title">';
                            $photosHtml .=
                                '<div class="flex min-h-full items-center justify-center p-4">';
                            $photosHtml .=
                                '<div class="relative bg-white dark:bg-gray-900 rounded-xl shadow-2xl max-w-7xl w-full overflow-hidden" style="height: 700px;" onclick="event.stopPropagation()">';

                            // Header
                            $photosHtml .=
                                '<div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">';
                            $photosHtml .=
                                '<h3 id="modal-title" class="text-lg font-semibold text-gray-900 dark:text-white">Photo Viewer</h3>';
                            $photosHtml .=
                                '<button onclick="closeMaintenancePhotoModal()" class="rounded-lg p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:text-gray-300 dark:hover:bg-gray-800 transition-colors" title="Close modal">';
                            $photosHtml .=
                                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                            $photosHtml .=
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                            $photosHtml .= "</svg>";
                            $photosHtml .= "</button>";
                            $photosHtml .= "</div>";

                            // Image Container
                            $photosHtml .=
                                '<div class="relative bg-gray-50 dark:bg-gray-800 flex items-center justify-center" style="height: 550px;">';
                            $photosHtml .=
                                '<div id="maintenanceModalLoader" class="hidden absolute inset-0 flex items-center justify-center">';
                            $photosHtml .=
                                '<div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>';
                            $photosHtml .= "</div>";
                            $photosHtml .=
                                '<img id="maintenanceModalImage" src="" alt="" class="max-w-full object-contain rounded-lg transition-opacity duration-300" style="max-height: 520px;" onload="hideImageLoader()" onerror="hideImageLoader()" />';
                            $photosHtml .= "</div>";

                            // Footer
                            $photosHtml .=
                                '<div class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-between items-center">';
                            $photosHtml .=
                                '<div class="flex flex-col space-y-2">';
                            $photosHtml .=
                                '<span id="maintenanceModalCaption" class="text-sm font-medium text-gray-900 dark:text-white"></span>';
                            $photosHtml .=
                                '<div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400">';
                            $photosHtml .=
                                "<span>Use arrow keys to navigate</span>";
                            $photosHtml .= "<span>•</span>";
                            $photosHtml .=
                                '<span>Press \'D\' to download</span>';
                            $photosHtml .= "<span>•</span>";
                            $photosHtml .=
                                '<span>Press \'Esc\' to close</span>';
                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";
                            $photosHtml .=
                                '<button onclick="downloadMaintenancePhoto()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors space-x-2" title="Download photo">';
                            $photosHtml .=
                                '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                            $photosHtml .=
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>';
                            $photosHtml .= "</svg>";
                            $photosHtml .= "<span>Download</span>";
                            $photosHtml .= "</button>";
                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";

                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";

                            // Navigation Buttons Outside Modal Content with Fixed Positioning
                            $photosHtml .=
                                '<button id="maintenancePrevBtn" onclick="event.stopPropagation(); previousMaintenancePhoto()" style="position: fixed; left: 1rem; top: 50%; transform: translateY(-50%); z-index: 150; display: none;" class="rounded-full bg-black/50 p-3 text-white hover:bg-black/70 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" title="Previous photo">';
                            $photosHtml .=
                                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                            $photosHtml .=
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>';
                            $photosHtml .= "</svg>";
                            $photosHtml .= "</button>";
                            $photosHtml .=
                                '<button id="maintenanceNextBtn" onclick="event.stopPropagation(); nextMaintenancePhoto()" style="position: fixed; right: 1rem; top: 50%; transform: translateY(-50%); z-index: 150; display: none;" class="rounded-full bg-black/50 p-3 text-white hover:bg-black/70 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" title="Next photo">';
                            $photosHtml .=
                                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
                            $photosHtml .=
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>';
                            $photosHtml .= "</svg>";
                            $photosHtml .= "</button>";

                            // Delete Confirmation Modal
                            $photosHtml .=
                                '<div id="deletePhotoConfirmModal" class="fixed inset-0 z-[110] hidden bg-black/40 backdrop-blur-sm" onclick="closeDeleteConfirmModal()" role="dialog" aria-modal="true" aria-labelledby="delete-modal-title">';
                            $photosHtml .=
                                '<div class="flex min-h-full items-center justify-center p-4">';
                            $photosHtml .=
                                '<div class="relative bg-white dark:bg-gray-900 rounded-xl shadow-xl max-w-md w-full" onclick="event.stopPropagation()">';
                            $photosHtml .= '<div class="p-6 text-center">';
                            $photosHtml .=
                                '<div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-500/20 mb-4">';
                            $photosHtml .=
                                '<svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">';
                            $photosHtml .=
                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />';
                            $photosHtml .= "</svg>";
                            $photosHtml .= "</div>";
                            $photosHtml .=
                                '<h3 id="delete-modal-title" class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Delete Photo</h3>';
                            $photosHtml .=
                                '<p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this photo? This action cannot be undone.</p>';
                            $photosHtml .=
                                '<div class="flex gap-3 justify-center">';
                            $photosHtml .=
                                '<button onclick="closeDeleteConfirmModal()" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Cancel</button>';
                            $photosHtml .=
                                '<button onclick="executeDeletePhoto()" type="button" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">Delete Photo</button>';
                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";
                            $photosHtml .= "</div>";

                            // JavaScript
                            $photoUrls = json_encode($record->photo_urls);
                            $photosHtml .= "<script>";
                            $photosHtml .= "(function() {";
                            $photosHtml .=
                                "let currentMaintenancePhotoIndex = 0;";
                            $photosHtml .= "let photoToDelete = null;";
                            $photosHtml .=
                                "const maintenancePhotoUrls = " .
                                $photoUrls .
                                ";";
                            $photosHtml .=
                                "const maintenanceRequestId = " .
                                $record->id .
                                ";";

                            $photosHtml .=
                                "window.openMaintenancePhotoModal = function(photoIndex) {";
                            $photosHtml .=
                                "currentMaintenancePhotoIndex = photoIndex;";
                            $photosHtml .=
                                'const modal = document.getElementById("maintenancePhotoModal");';
                            $photosHtml .=
                                'const modalImage = document.getElementById("maintenanceModalImage");';
                            $photosHtml .=
                                'const modalCaption = document.getElementById("maintenanceModalCaption");';
                            $photosHtml .=
                                'const prevBtn = document.getElementById("maintenancePrevBtn");';
                            $photosHtml .=
                                'const nextBtn = document.getElementById("maintenanceNextBtn");';
                            $photosHtml .= "showImageLoader();";
                            $photosHtml .=
                                "prevBtn.disabled = currentMaintenancePhotoIndex === 0;";
                            $photosHtml .=
                                "nextBtn.disabled = currentMaintenancePhotoIndex === maintenancePhotoUrls.length - 1;";
                            $photosHtml .=
                                'prevBtn.style.display = currentMaintenancePhotoIndex === 0 ? "none" : "block";';
                            $photosHtml .=
                                'nextBtn.style.display = currentMaintenancePhotoIndex === maintenancePhotoUrls.length - 1 ? "none" : "block";';
                            $photosHtml .= 'modalImage.style.opacity = "0";';
                            $photosHtml .=
                                "modalImage.src = maintenancePhotoUrls[currentMaintenancePhotoIndex];";
                            $photosHtml .=
                                'modalImage.alt = `Photo ${currentMaintenancePhotoIndex + 1}`;';
                            $photosHtml .=
                                'modalCaption.textContent = `Photo ${currentMaintenancePhotoIndex + 1} of ${maintenancePhotoUrls.length}`;';
                            $photosHtml .= 'modal.classList.remove("hidden");';
                            $photosHtml .=
                                "if (maintenancePhotoUrls.length > 1) { ";
                            $photosHtml .=
                                "const isMobile = window.innerWidth <= 640; ";
                            $photosHtml .=
                                'prevBtn.style.left = isMobile ? "0.5rem" : "1rem"; ';
                            $photosHtml .=
                                'nextBtn.style.right = isMobile ? "0.5rem" : "1rem"; ';
                            $photosHtml .=
                                'prevBtn.style.display = currentMaintenancePhotoIndex === 0 ? "none" : "block"; ';
                            $photosHtml .=
                                'nextBtn.style.display = currentMaintenancePhotoIndex === maintenancePhotoUrls.length - 1 ? "none" : "block"; ';
                            $photosHtml .= "} ";
                            $photosHtml .=
                                'document.body.style.overflow = "hidden";';
                            $photosHtml .= "modal.focus();";
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.closeMaintenancePhotoModal = function() {";
                            $photosHtml .=
                                'const modal = document.getElementById("maintenancePhotoModal");';
                            $photosHtml .=
                                'const modalImage = document.getElementById("maintenanceModalImage");';
                            $photosHtml .=
                                'const prevBtn = document.getElementById("maintenancePrevBtn");';
                            $photosHtml .=
                                'const nextBtn = document.getElementById("maintenanceNextBtn");';
                            $photosHtml .= 'modal.style.opacity = "0";';
                            $photosHtml .= "setTimeout(() => {";
                            $photosHtml .= 'modal.classList.add("hidden");';
                            $photosHtml .= 'modal.style.opacity = "";';
                            $photosHtml .= 'modalImage.style.opacity = "0";';
                            $photosHtml .= 'prevBtn.style.display = "none";';
                            $photosHtml .= 'nextBtn.style.display = "none";';
                            $photosHtml .= 'document.body.style.overflow = "";';
                            $photosHtml .= "hideImageLoader();";
                            $photosHtml .= "}, 200);";
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.nextMaintenancePhoto = function() {";
                            $photosHtml .=
                                "if (currentMaintenancePhotoIndex < maintenancePhotoUrls.length - 1) {";
                            $photosHtml .=
                                "window.openMaintenancePhotoModal(currentMaintenancePhotoIndex + 1);";
                            $photosHtml .= "}";
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.previousMaintenancePhoto = function() {";
                            $photosHtml .=
                                "if (currentMaintenancePhotoIndex > 0) {";
                            $photosHtml .=
                                "window.openMaintenancePhotoModal(currentMaintenancePhotoIndex - 1);";
                            $photosHtml .= "}";
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.downloadMaintenancePhoto = function() {";
                            $photosHtml .=
                                "const imageUrl = maintenancePhotoUrls[currentMaintenancePhotoIndex];";
                            $photosHtml .=
                                'const link = document.createElement("a");';
                            $photosHtml .= "link.href = imageUrl;";
                            $photosHtml .=
                                'link.download = `maintenance-photo-${currentMaintenancePhotoIndex + 1}.jpg`;';
                            $photosHtml .= "document.body.appendChild(link);";
                            $photosHtml .= "link.click();";
                            $photosHtml .= "document.body.removeChild(link);";
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.confirmDeletePhoto = function(photoIndex) {";
                            $photosHtml .= "photoToDelete = photoIndex;";
                            $photosHtml .=
                                'const modal = document.getElementById("deletePhotoConfirmModal");';
                            $photosHtml .= 'modal.classList.remove("hidden");';
                            $photosHtml .=
                                'document.body.style.overflow = "hidden";';
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.closeDeleteConfirmModal = function() {";
                            $photosHtml .=
                                'const modal = document.getElementById("deletePhotoConfirmModal");';
                            $photosHtml .= 'modal.classList.add("hidden");';
                            $photosHtml .= 'document.body.style.overflow = "";';
                            $photosHtml .= "photoToDelete = null;";
                            $photosHtml .= "};";

                            $photosHtml .=
                                "window.executeDeletePhoto = function() {";
                            $photosHtml .= "if (photoToDelete !== null) {";
                            $photosHtml .=
                                'fetch(`/maintenance/${maintenanceRequestId}/photos/${photoToDelete}/delete`, {';
                            $photosHtml .= 'method: "DELETE",';
                            $photosHtml .= "headers: {";
                            $photosHtml .=
                                '"X-Requested-With": "XMLHttpRequest",';
                            $photosHtml .=
                                '"Content-Type": "application/json",';
                            $photosHtml .=
                                '"X-CSRF-TOKEN": document.querySelector("meta[name=\"csrf-token\"]")?.content || ""';
                            $photosHtml .= "}";
                            $photosHtml .= "}).then(response => {";
                            $photosHtml .= "if (response.ok) {";
                            $photosHtml .= "window.location.reload();";
                            $photosHtml .= "} else {";
                            $photosHtml .=
                                'throw new Error("Failed to delete photo");';
                            $photosHtml .= "}";
                            $photosHtml .= "}).catch(error => {";
                            $photosHtml .= 'console.error("Error:", error);';
                            $photosHtml .=
                                'alert("Error deleting photo. Please try again.");';
                            $photosHtml .= "});";
                            $photosHtml .= "window.closeDeleteConfirmModal();";
                            $photosHtml .= "}";
                            $photosHtml .= "};";

                            $photosHtml .=
                                'document.addEventListener("keydown", function(e) {';
                            $photosHtml .=
                                'const modal = document.getElementById("maintenancePhotoModal");';
                            $photosHtml .=
                                'const deleteModal = document.getElementById("deletePhotoConfirmModal");';
                            $photosHtml .=
                                'if (modal && !modal.classList.contains("hidden")) {';
                            $photosHtml .= "switch(e.key) {";
                            $photosHtml .=
                                'case "Escape": e.preventDefault(); window.closeMaintenancePhotoModal(); break;';
                            $photosHtml .=
                                'case "ArrowLeft": e.preventDefault(); window.previousMaintenancePhoto(); break;';
                            $photosHtml .=
                                'case "ArrowRight": e.preventDefault(); window.nextMaintenancePhoto(); break;';
                            $photosHtml .=
                                'case "d": case "D": e.preventDefault(); window.downloadMaintenancePhoto(); break;';
                            $photosHtml .= "}";
                            $photosHtml .=
                                '} else if (deleteModal && !deleteModal.classList.contains("hidden")) {';
                            $photosHtml .=
                                'if (e.key === "Escape") { e.preventDefault(); window.closeDeleteConfirmModal(); }';
                            $photosHtml .= "}";
                            $photosHtml .= "});";

                            $photosHtml .= "function showImageLoader() {";
                            $photosHtml .=
                                'const loader = document.getElementById("maintenanceModalLoader");';
                            $photosHtml .=
                                'const image = document.getElementById("maintenanceModalImage");';
                            $photosHtml .=
                                'if (loader) { loader.classList.remove("hidden"); image.style.opacity = "0"; }';
                            $photosHtml .= "}";

                            $photosHtml .=
                                "window.hideImageLoader = function() {";
                            $photosHtml .=
                                'const loader = document.getElementById("maintenanceModalLoader");';
                            $photosHtml .=
                                'const image = document.getElementById("maintenanceModalImage");';
                            $photosHtml .=
                                'if (loader) { loader.classList.add("hidden"); image.style.opacity = "1"; }';
                            $photosHtml .= "};";

                            $photosHtml .= "})();";
                            $photosHtml .= "</script>";

                            $photosHtml .= "</div>";

                            return new \Illuminate\Support\HtmlString(
                                $photosHtml
                            );
                        })
                        ->visible(
                            fn($record) => $record && !empty($record->photos)
                        ),
                    Forms\Components\FileUpload::make("photos")
                        ->label("Add New Photos")
                        ->image()
                        ->multiple()
                        ->directory("maintenance-photos")
                        ->disk("gcs")
                        ->visibility("public")
                        ->maxFiles(5)
                        ->acceptedFileTypes([
                            "image/jpeg",
                            "image/png",
                            "image/webp",
                        ])
                        ->helperText(
                            "Upload up to 5 photos. Accepted formats: JPEG, PNG, WebP"
                        )
                        ->imagePreviewHeight(0)
                        ->uploadingMessage("Uploading photos...")
                        ->hiddenLabel(false)
                        ->previewable(false)
                        ->downloadable(false)
                        ->openable(false)
                        ->reorderable(false)
                        ->deletable(false)
                        ->panelLayout("compact")
                        ->removeUploadedFileButtonPosition("right")
                        ->uploadButtonPosition("center")
                        ->appendFiles()
                        ->storeFiles(false)
                        ->acceptedFileTypes(["image/*"])
                        ->maxSize(10240)
                        ->extraAttributes([
                            "x-data" => "{ uploading: false }",
                            "x-on:livewire-upload-start" => "uploading = true",
                            "x-on:livewire-upload-finish" =>
                                "uploading = false; setTimeout(() => window.location.reload(), 1000)",
                        ])
                        ->afterStateUpdated(fn() => redirect()->refresh()),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("title")
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make("community.name")
                    ->label("Community")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("user.name")
                    ->label("User")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make("category")
                    ->badge()
                    ->formatStateUsing(
                        fn(
                            MaintenanceRequestCategory $state
                        ): string => $state->label()
                    ),
                Tables\Columns\TextColumn::make("priority")->badge()->color(
                    fn(string $state): string => match ($state) {
                        "low" => "success",
                        "medium" => "warning",
                        "high" => "danger",
                        "urgent" => "danger",
                        default => "gray",
                    }
                ),
                Tables\Columns\TextColumn::make("status")
                    ->badge()
                    ->formatStateUsing(
                        fn(
                            MaintenanceRequestStatus $state
                        ): string => $state->label()
                    )
                    ->color(
                        fn(MaintenanceRequestStatus $state): string => match (
                            $state
                        ) {
                            MaintenanceRequestStatus::PENDING => "warning",
                            MaintenanceRequestStatus::IN_PROGRESS => "info",
                            MaintenanceRequestStatus::COMPLETED => "success",
                            MaintenanceRequestStatus::CANCELLED => "danger",
                            MaintenanceRequestStatus::ON_HOLD => "gray",
                            MaintenanceRequestStatus::REQUIRES_APPROVAL
                                => "warning",
                            default => "gray",
                        }
                    ),
                Tables\Columns\TextColumn::make("description")
                    ->limit(50)
                    ->toggleable(),
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make("updated_at")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make("community_id")
                    ->label("Community")
                    ->options(Community::all()->pluck("name", "id"))
                    ->searchable(),
                Tables\Filters\SelectFilter::make("status")->options(
                    collect(MaintenanceRequestStatus::cases())
                        ->mapWithKeys(
                            fn($case) => [$case->value => $case->label()]
                        )
                        ->toArray()
                ),
                Tables\Filters\SelectFilter::make("priority")->options([
                    "low" => "Low",
                    "medium" => "Medium",
                    "high" => "High",
                    "urgent" => "Urgent",
                ]),
                Tables\Filters\SelectFilter::make("category")->options(
                    collect(MaintenanceRequestCategory::cases())
                        ->mapWithKeys(
                            fn($case) => [$case->value => $case->label()]
                        )
                        ->toArray()
                ),
                Tables\Filters\Filter::make("urgent")
                    ->query(
                        fn(Builder $query): Builder => $query->where(
                            "priority",
                            "urgent"
                        )
                    )
                    ->label("Urgent Requests"),
                Tables\Filters\Filter::make("has_photos")
                    ->query(
                        fn(Builder $query): Builder => $query->whereNotNull(
                            "photos"
                        )
                    )
                    ->label("With Photos"),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort("created_at", "desc");
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            "index" => Pages\ListMaintenanceRequests::route("/"),
            "create" => Pages\CreateMaintenanceRequest::route("/create"),
            "edit" => Pages\EditMaintenanceRequest::route("/{record}/edit"),
            "view" => Pages\ViewMaintenanceRequest::route("/{record}"),
        ];
    }

    public static function getInfolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make("Request Details")->schema([
                Infolists\Components\TextEntry::make("title")
                    ->size(Infolists\Components\TextEntry\TextEntrySize::Large)
                    ->weight("bold"),
                Infolists\Components\TextEntry::make("description")
                    ->prose()
                    ->markdown(),
                Infolists\Components\Grid::make(3)->schema([
                    Infolists\Components\TextEntry::make("category")
                        ->badge()
                        ->formatStateUsing(
                            fn(
                                MaintenanceRequestCategory $state
                            ): string => $state->label()
                        ),
                    Infolists\Components\TextEntry::make("priority")
                        ->badge()
                        ->color(
                            fn(string $state): string => match ($state) {
                                "low" => "success",
                                "medium" => "warning",
                                "high" => "danger",
                                "urgent" => "danger",
                                default => "gray",
                            }
                        ),
                    Infolists\Components\TextEntry::make("status")
                        ->badge()
                        ->formatStateUsing(
                            fn(
                                MaintenanceRequestStatus $state
                            ): string => $state->label()
                        )
                        ->color(
                            fn(
                                MaintenanceRequestStatus $state
                            ): string => match ($state) {
                                MaintenanceRequestStatus::PENDING => "warning",
                                MaintenanceRequestStatus::IN_PROGRESS => "info",
                                MaintenanceRequestStatus::COMPLETED
                                    => "success",
                                MaintenanceRequestStatus::CANCELLED => "danger",
                                MaintenanceRequestStatus::ON_HOLD => "gray",
                                MaintenanceRequestStatus::REQUIRES_APPROVAL
                                    => "warning",
                                default => "gray",
                            }
                        ),
                ]),
            ]),
            Infolists\Components\Section::make("Community & User")
                ->schema([
                    Infolists\Components\TextEntry::make(
                        "community.name"
                    )->label("Community"),
                    Infolists\Components\TextEntry::make("user.name")->label(
                        "Requested By"
                    ),
                    Infolists\Components\TextEntry::make("created_at")
                        ->label("Created")
                        ->dateTime(),
                    Infolists\Components\TextEntry::make("updated_at")
                        ->label("Last Updated")
                        ->dateTime(),
                ])
                ->columns(2),
            Infolists\Components\Section::make("Photos")
                ->schema([
                    Infolists\Components\ImageEntry::make("photos")
                        ->hiddenLabel()
                        ->disk("gcs")
                        ->size(200)
                        ->square()
                        ->extraImgAttributes(["loading" => "lazy"])
                        ->visible(fn($record) => !empty($record->photos)),
                ])
                ->visible(fn($record) => !empty($record->photos)),
        ]);
    }
}
