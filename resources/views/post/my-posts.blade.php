<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Posts</h1>
                    <p class="text-gray-600 dark:text-gray-400">Manage all your event posts</p>
                </div>
                <a href="{{ route('post.create') }}" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Post
                </a>
            </div>

            @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <!-- Tab System -->
            <div x-data="{ tab: 'all' }">
                <!-- Tab Buttons -->
                <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-1 flex space-x-2">
                    <button @click="tab = 'all'" :class="tab === 'all' ? 'bg-indigo-600 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition">
                        All Posts
                    </button>
                    <button @click="tab = 'pending'" :class="tab === 'pending' ? 'bg-yellow-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition">
                        Pending
                    </button>
                    <button @click="tab = 'approved'" :class="tab === 'approved' ? 'bg-green-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition">
                        Approved
                    </button>
                    <button @click="tab = 'rejected'" :class="tab === 'rejected' ? 'bg-red-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition">
                        Rejected
                    </button>
                </div>

                <!-- Posts List -->
                <div class="space-y-4">
                    @forelse($posts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition" 
                         x-show="tab === 'all' || tab === '{{ $post->status }}'"
                         x-transition>
                        <div class="flex">
                            <!-- Poster Thumbnail -->
                            <div class="w-32 h-32 flex-shrink-0 mr-6">
                                @if($post->poster_path)
                                <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-400 to-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                                    </svg>
                                </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $post->judul }}</h3>
                                        <div class="flex items-center space-x-3 mt-1">
                                            @php
                                                $categoryColors = [
                                                    'Kepanitiaan' => 'bg-blue-100 text-blue-800',
                                                    'Organisasi' => 'bg-green-100 text-green-800',
                                                    'Laboratorium' => 'bg-purple-100 text-purple-800',
                                                    'Seminar' => 'bg-orange-100 text-orange-800',
                                                    'Lomba' => 'bg-red-100 text-red-800',
                                                    'Event Kampus' => 'bg-pink-100 text-pink-800',
                                                ];
                                                $catColor = $categoryColors[$post->kategori] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $catColor }}">
                                                {{ $post->kategori }}
                                            </span>
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $post->status == 'approved' ? 'bg-green-100 text-green-800' : ($post->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 line-clamp-2">
                                    {{ Str::limit($post->deskripsi, 150) }}
                                </p>

                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-4 mb-3">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Deadline: {{ $post->deadline->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Created: {{ $post->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                @if($post->status == 'rejected' && $post->pesan_admin)
                                <div class="mb-3 p-3 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded">
                                    <p class="text-sm font-semibold text-red-800 dark:text-red-300">Admin Message:</p>
                                    <p class="text-sm text-red-700 dark:text-red-400">{{ $post->pesan_admin }}</p>
                                </div>
                                @endif

                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('post.show', $post->id) }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                        View
                                    </a>
                                    <a href="{{ route('post.edit', $post->id) }}" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Posts Yet</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Create your first post to get started!</p>
                        <a href="{{ route('post.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Create Post
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
