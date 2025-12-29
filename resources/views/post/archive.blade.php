<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Archived Posts</h1>
            
            @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $post->judul }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($post->deskripsi, 100) }}</p>
                    <p class="text-xs text-red-600 mb-3">Expired: {{ $post->deadline->format('d M Y') }}</p>
                    <a href="{{ route('post.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">View Details →</a>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                <p class="text-gray-600 dark:text-gray-400">No archived posts yet.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
