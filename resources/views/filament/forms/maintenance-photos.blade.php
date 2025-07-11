<div class="mb-4">
    @if($getRecord() && $getRecord()->photos && count($getRecord()->photos) > 0)
        <div class="mb-3">
            <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3">
                <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    Current Photos ({{ count($getRecord()->photos) }})
                </span>
            </label>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                Existing photos attached to this maintenance request
            </p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 mb-4">
            @foreach($getRecord()->photos as $index => $photo)
                <div class="relative group">
                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::disk('gcs')->url($photo) }}"
                        alt="Photo {{ $index + 1 }}"
                        class="w-full h-24 object-cover rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer"
                        onclick="openFormPhotoModal({{ $index }})"
                        loading="lazy"
                        onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMMTMuMDkgOC4yNkwyMSA5TDEzLjA5IDE1Ljc0TDEyIDIyTDEwLjkxIDE1Ljc0TDMgOUwxMC45MSA4LjI2TDEyIDJaIiBmaWxsPSIjOTMzNzQ4Ii8+Cjwvc3ZnPgo='; this.alt='Failed to load'"
                    />
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-1 right-1 bg-black bg-opacity-70 text-white text-xs px-1.5 py-0.5 rounded text-center">
                        {{ $index + 1 }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Photo Modal for Form -->
        <div id="formPhotoModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-95 flex items-center justify-center p-4">
            <div class="relative w-full h-full max-w-4xl max-h-full flex items-center justify-center">
                <!-- Close Button -->
                <button
                    onclick="closeFormPhotoModal()"
                    class="absolute top-4 right-4 text-white hover:text-gray-300 z-20 bg-black bg-opacity-50 rounded-full p-2 transition-colors"
                    title="Close (Esc)"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Navigation Buttons -->
                <button
                    id="formPrevBtn"
                    onclick="previousFormPhoto()"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-20 bg-black bg-opacity-50 rounded-full p-3 transition-colors"
                    title="Previous photo (←)"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button
                    id="formNextBtn"
                    onclick="nextFormPhoto()"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-gray-300 z-20 bg-black bg-opacity-50 rounded-full p-3 transition-colors"
                    title="Next photo (→)"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Main Image -->
                <img
                    id="formModalImage"
                    src=""
                    alt=""
                    class="max-w-full max-h-full object-contain rounded-lg shadow-2xl"
                />

                <!-- Caption -->
                <div class="absolute bottom-4 left-4 right-4 text-center">
                    <div id="formModalCaption" class="bg-black bg-opacity-70 text-white px-4 py-2 rounded text-sm inline-block">
                    </div>
                </div>
            </div>
        </div>

        <script>
            let currentFormPhotoIndex = 0;
            const formPhotos = @json($getRecord()->photos);
            const formPhotoUrls = @json($getRecord()->getPublicPhotoUrls());

            function openFormPhotoModal(photoIndex) {
                currentFormPhotoIndex = photoIndex;
                const modal = document.getElementById('formPhotoModal');
                const modalImage = document.getElementById('formModalImage');
                const modalCaption = document.getElementById('formModalCaption');
                const prevBtn = document.getElementById('formPrevBtn');
                const nextBtn = document.getElementById('formNextBtn');

                // Update navigation buttons
                prevBtn.style.display = currentFormPhotoIndex === 0 ? 'none' : 'block';
                nextBtn.style.display = currentFormPhotoIndex === formPhotos.length - 1 ? 'none' : 'block';

                // Set image
                modalImage.src = formPhotoUrls[currentFormPhotoIndex];
                modalImage.alt = `Photo ${currentFormPhotoIndex + 1}`;
                modalCaption.textContent = `Photo ${currentFormPhotoIndex + 1} of ${formPhotos.length}`;

                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeFormPhotoModal() {
                const modal = document.getElementById('formPhotoModal');
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            function nextFormPhoto() {
                if (currentFormPhotoIndex < formPhotos.length - 1) {
                    openFormPhotoModal(currentFormPhotoIndex + 1);
                }
            }

            function previousFormPhoto() {
                if (currentFormPhotoIndex > 0) {
                    openFormPhotoModal(currentFormPhotoIndex - 1);
                }
            }

            // Close modal when clicking outside the image
            document.getElementById('formPhotoModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeFormPhotoModal();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                const modal = document.getElementById('formPhotoModal');
                if (modal && !modal.classList.contains('hidden')) {
                    switch(e.key) {
                        case 'Escape':
                            closeFormPhotoModal();
                            break;
                        case 'ArrowLeft':
                            e.preventDefault();
                            previousFormPhoto();
                            break;
                        case 'ArrowRight':
                            e.preventDefault();
                            nextFormPhoto();
                            break;
                    }
                }
            });
        </script>
    @endif
</div>
