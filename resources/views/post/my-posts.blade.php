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
                <div class="mb-8 bg-gray-100 dark:bg-gray-900/50 p-1 rounded-xl flex space-x-1">
                    <button @click="tab = 'all'" 
                        :class="tab === 'all' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                        All
                    </button>
                    <button @click="tab = 'approved'" 
                        :class="tab === 'approved' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                        Approved
                    </button>
                    <button @click="tab = 'pending'" 
                        :class="tab === 'pending' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                        Pending
                    </button>
                    <button @click="tab = 'rejected'" 
                        :class="tab === 'rejected' ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                        class="flex-1 px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                        Rejected
                    </button>
                </div>

                <!-- Posts List -->
                <div class="space-y-1.5">
                    @forelse($posts as $post)
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:border-gray-300 transition-all duration-200" 
                         x-show="tab === 'all' || tab === '{{ $post->status }}'"
                         x-transition>
                        <div class="flex flex-col sm:flex-row">
                            <!-- Poster Image -->
                            <div class="sm:w-48 h-40 sm:h-auto flex-shrink-0 bg-gray-100 relative">
                                @if($post->poster_path)
                                <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                @endif
                                
                                <!-- Status Badge on Image -->
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold shadow-sm
                                        {{ $post->status == 'approved' ? 'bg-green-500 text-white' : ($post->status == 'pending' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 p-5 flex flex-col">
                                <!-- Header -->
                                <div class="mb-3">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1">{{ $post->judul }}</h3>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                                    {{ $post->kategori }}
                                                </span>
                                                @if($post->user->role === 'organizer')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                        Organisasi
                                                    </span>
                                                @elseif($post->user->role === 'student')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                        Mahasiswa
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Meta Info -->
                                <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Deadline: <strong>{{ $post->deadline->format('d M Y') }}</strong></span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                @if($post->status == 'rejected' && $post->pesan_admin)
                                <div class="mb-4 p-3 bg-red-50 border border-red-100 rounded-lg">
                                    <p class="text-sm text-red-700">
                                        <span class="font-semibold">Alasan ditolak:</span> {{ $post->pesan_admin }}
                                    </p>
                                </div>
                                @endif

                                <!-- Action Buttons - Clear Labels -->
                                <div class="mt-auto pt-4 border-t border-gray-100 flex flex-wrap gap-2">
                                    <a href="{{ route('post.show', $post->id) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('post.edit', $post->id) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus post ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-red-600 text-sm font-medium rounded-lg hover:bg-red-50 hover:border-red-200 transition-colors">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
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
