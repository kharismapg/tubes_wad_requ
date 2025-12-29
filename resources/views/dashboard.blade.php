<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                    Discover Events & Opportunities
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Find the perfect event, organization, or committee for you
                </p>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm animate-fade-in">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm animate-fade-in">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
            @endif

            <!-- Create Post Button (for Students & Organizers) -->
            @if(!Auth::user()->isAdmin())
            <div class="mb-6">
                <a href="{{ route('post.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Post
                </a>
            </div>
            @endif

            <!-- Filter & Search Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
                <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                        <select name="kategori" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            <option value="">All Categories</option>
                            <option value="Kepanitiaan" {{ request('kategori') == 'Kepanitiaan' ? 'selected' : '' }}>Kepanitiaan</option>
                            <option value="Organisasi" {{ request('kategori') == 'Organisasi' ? 'selected' : '' }}>Organisasi</option>
                            <option value="Laboratorium" {{ request('kategori') == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                            <option value="Seminar" {{ request('kategori') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="Lomba" {{ request('kategori') == 'Lomba' ? 'selected' : '' }}>Lomba</option>
                            <option value="Event Kampus" {{ request('kategori') == 'Event Kampus' ? 'selected' : '' }}>Event Kampus</option>
                        </select>
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                        <select name="sort" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            <option value="terdekat" {{ request('sort') == 'terdekat' ? 'selected' : '' }}>Nearest Deadline</option>
                            <option value="terjauh" {{ request('sort') == 'terjauh' ? 'selected' : '' }}>Farthest Deadline</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-4 flex space-x-2">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Apply Filters
                        </button>
                        <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($posts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform hover:-translate-y-1 transition duration-300">
                    <!-- Poster Image -->
                    <div class="relative h-48 bg-gradient-to-br from-indigo-400 to-purple-500 overflow-hidden">
                        @if($post->poster_path)
                        <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover">
                        @else
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-20 h-20 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                            </svg>
                        </div>
                        @endif
                        
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            @php
                                $categoryColors = [
                                    'Kepanitiaan' => 'bg-blue-500',
                                    'Organisasi' => 'bg-green-500',
                                    'Laboratorium' => 'bg-purple-500',
                                    'Seminar' => 'bg-orange-500',
                                    'Lomba' => 'bg-red-500',
                                    'Event Kampus' => 'bg-pink-500',
                                ];
                                $badgeColor = $categoryColors[$post->kategori] ?? 'bg-gray-500';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold text-white {{ $badgeColor }} shadow-lg">
                                {{ $post->kategori }}
                            </span>
                        </div>

                        <!-- Bookmark Button -->
                        @if(!Auth::user()->isAdmin())
                        <form action="{{ route('bookmark.toggle', $post->id) }}" method="POST" class="absolute top-3 right-3">
                            @csrf
                            <button type="submit" class="p-2 bg-white/90 rounded-full hover:bg-white transition shadow-lg">
                                @if($post->isBookmarkedBy(Auth::id()))
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                </svg>
                                @else
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                @endif
                            </button>
                        </form>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                            {{ $post->judul }}
                        </h3>
                        
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                            {{ Str::limit($post->deskripsi, 100) }}
                        </p>

                        <!-- Meta Info -->
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-3 space-x-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                {{ $post->user->name }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $post->deadline->format('d M Y') }}
                            </div>
                        </div>

                        <!-- Deadline Warning -->
                        @php
                            $daysLeft = (int) ceil(now()->diffInDays($post->deadline, false));
                        @endphp
                        @if($daysLeft >= 0 && $daysLeft <= 7)
                        <div class="mb-3 px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-semibold">
                            ⏰ {{ $daysLeft }} {{ $daysLeft == 1 ? 'day' : 'days' }} left!
                        </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="{{ route('post.show', $post->id) }}" class="flex-1 px-4 py-2 bg-indigo-600 text-white text-center font-semibold rounded-lg hover:bg-indigo-700 transition text-sm">
                                View Details
                            </a>
                            @if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id())
                            <a href="{{ route('report.create', $post->id) }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition text-sm" title="Report">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No Events Found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Try adjusting your filters or create a new post!</p>
                @if(!Auth::user()->isAdmin())
                <a href="{{ route('post.create') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Post
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
