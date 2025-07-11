<div class="space-y-4">
    @if($getRecord()->photos && count($getRecord()->photos) > 0)
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                Photos ({{ count($getRecord()->photos) }})
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 block mt-4">
                Click on any photo to view it in full size
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($getRecord()->photos as $index => $photo)
                <div class="relative group">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::disk('gcs')->url($photo) }}"
                        alt="Maintenance Photo {{ $index + 1 }}"
                        class="w-full h-48 sm:h-56 md:h-64 object-cover rounded-lg shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer transform hover:scale-105"
                        onclick="openPhotoModal({{ $index }})"
                        onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMTMuMDkgOC4yNkwyMSA5TDEzLjA5IDE1Ljc0TDEyIDIyTDEwLjkxIDE1Ljc0TDMgOUwxMC45MSA4LjI2TDEyIDJaIiBmaWxsPSIjOTMzNzQ4Ci8+Cjwvc3ZnPgo='; this.alt='Photo failed to load'"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-full p-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-2 left-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1 rounded">
                        {{ $index + 1 }} of {{ count($getRecord()->photos) }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced Photo Modal -->
        <div id="photoModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95 flex items-center justify-center p-4">
            <div class="relative w-full h-full max-w-6xl max-h-full flex items-center justify-center">
                <!-- Close Button -->
                <button
                    onclick="closePhotoModal()"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 z-20 bg-black bg-opacity-50 rounded-full p-2 transition-colors"
                    title="Close (Esc)"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Previous Button -->
                <button
                    id="prevBtn"
                    onclick="previousPhoto()"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-20 bg-black bg-opacity-50 rounded-full p-3 transition-colors"
                    title="Previous photo (←)"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Next Button -->
                <button
                    id="nextBtn"
                    onclick="nextPhoto()"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-20 bg-black bg-opacity-50 rounded-full p-3 transition-colors"
                    title="Next photo (→)"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Main Image -->
                <img
                    id="modalImage"
                    src=""
                    alt=""
                    class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                />

                <!-- Loading Indicator -->
                <div id="loadingIndicator" class="hidden absolute inset-0 flex items-center justify-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
                </div>

                <!-- Caption and Controls -->
                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                    <div id="modalCaption" class="bg-black bg-opacity-70 text-white px-4 py-2 rounded text-sm">
                    </div>
                    <div class="flex space-x-2">
                        <button
                            onclick="downloadPhoto()"
                            class="bg-black bg-opacity-70 text-white px-3 py-2 rounded hover:bg-opacity-90 transition-colors text-sm"
                            title="Download photo"
                        >
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let currentPhotoIndex = 0;
            const photos = @json($getRecord()->photos);
            const photoUrls = @json($getRecord()->getPublicPhotoUrls());
            const maintenanceRequestId = {{ $getRecord()->id }};

            function openPhotoModal(photoIndex) {
                currentPhotoIndex = photoIndex;
                const modal = document.getElementById('photoModal');
                const modalImage = document.getElementById('modalImage');
                const modalCaption = document.getElementById('modalCaption');
                const loadingIndicator = document.getElementById('loadingIndicator');
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');

                // Show loading indicator
                loadingIndicator.classList.remove('hidden');
                modalImage.style.opacity = '0';

                // Update navigation buttons
                prevBtn.style.display = currentPhotoIndex === 0 ? 'none' : 'block';
                nextBtn.style.display = currentPhotoIndex === photos.length - 1 ? 'none' : 'block';

                // Build image URL using direct GCS URL
                const imageUrl = photoUrls[currentPhotoIndex];

                modalImage.onload = function() {
                    loadingIndicator.classList.add('hidden');
                    modalImage.style.opacity = '1';
                };

                modalImage.src = imageUrl;
                modalImage.alt = `Maintenance Photo ${currentPhotoIndex + 1}`;
                modalCaption.textContent = `Photo ${currentPhotoIndex + 1} of ${photos.length}`;

                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closePhotoModal() {
                const modal = document.getElementById('photoModal');
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            function nextPhoto() {
                if (currentPhotoIndex < photos.length - 1) {
                    openPhotoModal(currentPhotoIndex + 1);
                }
            }

            function previousPhoto() {
                if (currentPhotoIndex > 0) {
                    openPhotoModal(currentPhotoIndex - 1);
                }
            }

            function downloadPhoto() {
                const imageUrl = photoUrls[currentPhotoIndex];
                const link = document.createElement('a');
                link.href = imageUrl;
                link.download = `maintenance-photo-${currentPhotoIndex + 1}.jpg`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

            // Close modal when clicking outside the image
            document.getElementById('photoModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closePhotoModal();
                }
            });

            // Enhanced keyboard navigation
            document.addEventListener('keydown', function(e) {
                const modal = document.getElementById('photoModal');
                if (!modal.classList.contains('hidden')) {
                    switch(e.key) {
                        case 'Escape':
                            closePhotoModal();
                            break;
                        case 'ArrowLeft':
                            e.preventDefault();
                            previousPhoto();
                            break;
                        case 'ArrowRight':
                            e.preventDefault();
                            nextPhoto();
                            break;
                        case 'd':
                        case 'D':
                            e.preventDefault();
                            downloadPhoto();
                            break;
                    }
                }
            });

            // Touch/swipe support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            document.getElementById('photoModal').addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
            });

            document.getElementById('photoModal').addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                const swipeDistance = touchStartX - touchEndX;

                if (Math.abs(swipeDistance) > 50) { // Minimum swipe distance
                    if (swipeDistance > 0) {
                        nextPhoto(); // Swipe left = next photo
                    } else {
                        previousPhoto(); // Swipe right = previous photo
                    }
                }
            });
        </script>
    @else
        <div class="text-center text-gray-500 dark:text-gray-400 py-12">
            <svg class="w-20 h-20 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-lg font-medium mb-2">No Photos Available</h3>
            <p class="text-sm">No photos have been attached to this maintenance request</p>
        </div>
    @endif
</div>
