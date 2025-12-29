<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('post.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-800">← Back to Post</a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Report Post</h1>
                
                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Post:</strong> {{ $post->judul }}</p>
                </div>

                <form action="{{ route('report.store', $post->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="reason" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Reason for Report <span class="text-red-500">*</span>
                        </label>
                        <textarea id="reason" name="reason" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                            placeholder="Please describe why you're reporting this post (minimum 10 characters)...">{{ old('reason') }}</textarea>
                        @error('reason')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="flex-1 px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                            Submit Report
                        </button>
                        <a href="{{ route('post.show', $post->id) }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
