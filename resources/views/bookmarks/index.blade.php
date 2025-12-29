<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">My Bookmarks</h1>
            
            @if($bookmarks->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($bookmarks as $post)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                    <div class="relative h-48 bg-gradient-to-br from-indigo-400 to-purple-500">
                        @if($post->poster_path)
                        <img src="{{ asset('storage/' . $post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->judul }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ Str::limit($post->deskripsi, 100) }}</p>
                        <div class="flex items-center text-xs text-gray-500 mb-3">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $post->deadline->format('d M Y') }}
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('post.show', $post->id) }}" class="flex-1 px-4 py-2 bg-indigo-600 text-white text-center font-semibold rounded-lg hover:bg-indigo-700 transition text-sm">
                                View
                            </a>
                            <form action="{{ route('bookmark.toggle', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Bookmarks Yet</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Start bookmarking posts you're interested in!</p>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                    Browse Events
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>