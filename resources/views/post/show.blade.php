<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            <!-- Post Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <!-- Poster Image -->
                <div class="relative h-96 bg-gradient-to-br from-indigo-50 to-purple-50">
                    @if($post->poster_path)
                    <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-contain">
                    @else
                    <div class="flex items-center justify-center h-full">
                        <svg class="w-32 h-32 text-white opacity-30" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                        </svg>
                    </div>
                    @endif
                    
                    <!-- Category Badge -->
                    <div class="absolute top-6 left-6">
                        @php
                            $categoryColors = [
                                'Kepanitiaan' => 'bg-blue-600',
                                'Organisasi' => 'bg-green-600',
                                'Laboratorium' => 'bg-purple-600',
                                'Seminar' => 'bg-orange-600',
                                'Lomba' => 'bg-red-600',
                                'Event Kampus' => 'bg-pink-600',
                            ];
                            $badgeColor = $categoryColors[$post->kategori] ?? 'bg-gray-600';
                        @endphp
                        <span class="px-4 py-2 rounded-full text-sm font-bold text-white {{ $badgeColor }} shadow-xl">
                            {{ $post->kategori }}
                        </span>
                    </div>

                    <!-- Bookmark Button -->
                    @if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id())
                    <form action="{{ route('bookmark.toggle', $post->id) }}" method="POST" class="absolute top-6 right-6">
                        @csrf
                        <button type="submit" class="p-3 bg-white/95 rounded-full hover:bg-white transition shadow-xl">
                            @if($post->isBookmarkedBy(Auth::id()))
                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                            </svg>
                            @else
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            @endif
                        </button>
                    </form>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-8">
                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $post->judul }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 mb-6 text-gray-600 dark:text-gray-400">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span class="font-semibold mr-2">{{ $post->user->name }}</span>
                            @if($post->user->role === 'organizer')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Organisasi
                                </span>
                            @elseif($post->user->role === 'student')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    Mahasiswa
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    {{ ucfirst($post->user->role) }}
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Deadline: <strong>{{ $post->deadline->format('d F Y') }}</strong></span>
                        </div>
                        @php
                            $daysLeft = (int) ceil(now()->diffInDays($post->deadline, false));
                        @endphp
                        @if($daysLeft >= 0 && $daysLeft <= 7)
                        <div class="px-4 py-2 bg-red-100 text-red-700 rounded-lg font-bold">
                            ⏰ {{ $daysLeft }} {{ $daysLeft == 1 ? 'day' : 'days' }} left!
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">About This Event</h2>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $post->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4">
                        @if($post->user_id === Auth::id() || Auth::user()->isAdmin())
                        <!-- Owner/Admin Actions -->
                        <a href="{{ route('post.edit', $post->id) }}" class="px-8 py-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg">
                            Edit Post
                        </a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-8 py-4 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition shadow-lg">
                                Delete Post
                            </button>
                        </form>
                        @else
                        <!-- Public Actions -->
                        <a href="{{ $post->link_pendaftaran }}" target="_blank" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg transform hover:scale-105">
                            Register Now →
                        </a>
                        <a href="{{ route('report.create', $post->id) }}" class="px-8 py-4 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow-lg">
                            Report Post
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
