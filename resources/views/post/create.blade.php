<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                    Create New Post
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Share your event or opportunity with the community
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-6">
                        <label for="judul" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Event Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                            placeholder="e.g., Open Recruitment Himpunan 2025">
                        @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-6">
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori" name="kategori" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            <option value="">-- Select Category --</option>
                            <option value="Kepanitiaan" {{ old('kategori') == 'Kepanitiaan' ? 'selected' : '' }}>Kepanitiaan</option>
                            <option value="Organisasi" {{ old('kategori') == 'Organisasi' ? 'selected' : '' }}>Organisasi</option>
                            <option value="Laboratorium" {{ old('kategori') == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                            <option value="Seminar" {{ old('kategori') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="Lomba" {{ old('kategori') == 'Lomba' ? 'selected' : '' }}>Lomba</option>
                            <option value="Event Kampus" {{ old('kategori') == 'Event Kampus' ? 'selected' : '' }}>Event Kampus</option>
                        </select>
                        @error('kategori')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Describe your event, requirements, benefits, etc.">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div class="mb-6">
                        <label for="deadline" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Registration Deadline <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}" required
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                        @error('deadline')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Link Pendaftaran -->
                    <div class="mb-6">
                        <label for="link_pendaftaran" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Registration Link <span class="text-red-500">*</span>
                        </label>
                        <input type="url" id="link_pendaftaran" name="link_pendaftaran" value="{{ old('link_pendaftaran') }}" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                            placeholder="https://forms.google.com/...">
                        @error('link_pendaftaran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poster Upload -->
                    <div class="mb-6">
                        <label for="poster" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Event Poster <span class="text-red-500">*</span>
                        </label>
                        <div id="drop-zone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-indigo-500 transition cursor-pointer">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                    <label for="poster" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                        <span>Upload a file</span>
                                        <input id="poster" name="poster" type="file" class="sr-only" accept="image/*" required onchange="handleFiles(this.files)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        <div id="imagePreview" class="mt-4 hidden">
                            <img id="preview" src="" alt="Preview" class="max-w-full h-64 mx-auto rounded-lg shadow-lg">
                        </div>
                        @error('poster')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-4 rounded">
                        <div class="flex">
                            <svg class="h-5 w-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                Your post will be reviewed by admin before being published. You'll receive a notification once it's approved or if changes are needed.
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition duration-200">
                            Submit for Review
                        </button>
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('poster');

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/10');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/10');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900/10');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFiles(files);
            }
        });

        // Click to open file dialog
        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        function handleFiles(files) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const file = files[0];
            
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
