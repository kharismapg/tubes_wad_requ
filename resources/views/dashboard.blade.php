<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="font-bold text-3xl text-gray-800 leading-tight">
                    {{ __('Discover Events') }}
                </h2>
                <p class="text-gray-500 mt-2 text-lg">
                    Find the perfect event, organization, or committee for you.
                </p>
            </div>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('post.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Post
            </a>
            @endif
        </div>
    </x-slot>
            <!-- Success/Error Messages -->
            @if(session('success'))
            <div class="mb-8 rounded-lg bg-green-50 p-4 text-sm font-medium text-green-700 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800 shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-8 rounded-lg bg-red-50 p-4 text-sm font-medium text-red-700 border border-red-200 shadow-sm">
                {{ session('error') }}
            </div>
            @endif

            <!-- Filter & Search Section -->
            <x-card class="mb-12 shadow-sm border border-gray-200 bg-white">
                <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 md:grid-cols-12 gap-8 items-end pt-6">
                    <!-- Search -->
                    <div class="md:col-span-5 space-y-3">
                            <label class="text-sm font-medium text-gray-700">Search</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 111.06-1.06l4.35 4.35z"/>
                            </svg>
                            <x-text-input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="pl-9 w-full" />
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="md:col-span-3 space-y-3">
                        <label class="text-sm font-medium text-gray-700">Category</label>
                        <select name="kategori" class="flex h-10 w-full rounded-md border-gray-300 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="">All Categories</option>
                            @foreach(['Kepanitiaan', 'Organisasi', 'Laboratorium', 'Seminar', 'Lomba', 'Event Kampus'] as $cat)
                                <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="md:col-span-2 space-y-3">
                        <label class="text-sm font-medium text-gray-700">Sort By</label>
                        <select name="sort" class="flex h-10 w-full rounded-md border-gray-300 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="terdekat" {{ request('sort') == 'terdekat' ? 'selected' : '' }}>Nearest</option>
                            <option value="terjauh" {{ request('sort') == 'terjauh' ? 'selected' : '' }}>Farthest</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="md:col-span-2 flex gap-2">
                        <x-primary-button class="w-full h-10 justify-center">
                            Filter
                        </x-primary-button>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-3 h-10 w-12 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" title="Reset Filters">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </a>
                    </div>
                </form>
            </x-card>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                @foreach($posts as $post)
                <x-card class="group flex flex-col h-full overflow-hidden border border-gray-200 bg-white hover:shadow-xl transition-all duration-300 hover:-translate-y-2" :contentPadding="false">
                    <!-- Poster Image -->
                    <div class="relative aspect-[16/9] w-full overflow-hidden border-b border-gray-100">
                        @if($post->poster_path)
                        <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                        <!-- Default Placeholder Image -->
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&auto=format&fit=crop&q=60" alt="Event Placeholder" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 opacity-80">
                        @endif
                        
                        <!-- Gradients Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4 z-10">
                            <span class="inline-flex items-center rounded-full border border-white/20 px-2.5 py-0.5 text-xs font-semibold backdrop-blur-md bg-black/40 text-white shadow-sm">
                                {{ $post->kategori }}
                            </span>
                        </div>

                        <!-- Bookmark Button -->
                        @if(!Auth::user()->isAdmin())
                        <div class="absolute top-3 right-3 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <form action="{{ route('bookmark.toggle', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 bg-black/40 backdrop-blur-md rounded-full hover:bg-white hover:text-black transition-all duration-200 border border-white/20 text-white">
                                    @if($post->isBookmarkedBy(Auth::id()))
                                    <svg class="w-4 h-4 text-red-500 fill-current" viewBox="0 0 20 20">
                                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                    </svg>
                                    @else
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                                    </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>

                    <div class="flex flex-col flex-grow p-6">
                        <div class="mb-3">
                             <h3 class="font-bold text-xl leading-tight tracking-tight line-clamp-1 group-hover:text-indigo-600 transition-colors cursor-pointer" onclick="window.location='{{ route('post.show', $post->id) }}'">
                                {{ $post->judul }}
                             </h3>
                        </div>
                        
                        <p class="text-sm text-gray-500 line-clamp-3 mb-6 flex-grow">
                            {{ Str::limit($post->deskripsi, 120) }}
                        </p>

                        <!-- Meta Info Row -->
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                             <div class="flex items-center space-x-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full border border-gray-200">
                                <div>
                                    <p class="text-xs font-semibold text-gray-900 line-clamp-1 max-w-[100px]">{{ $post->user->name }}</p>
                                    @if($post->user->role === 'organizer')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Organisasi
                                        </span>
                                    @elseif($post->user->role === 'student')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                            Mahasiswa
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                            {{ ucfirst($post->user->role) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Deadline / Days Left -->
                            @php
                                $daysLeft = (int) ceil(now()->diffInDays($post->deadline, false));
                            @endphp
                            
                            <div class="flex items-center">
                                @if($daysLeft >= 0 && $daysLeft <= 7)
                                <span class="inline-flex items-center text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-md border border-red-100">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $daysLeft }}d left
                                </span>
                                @else
                                <span class="text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded-md">
                                    {{ $post->deadline->format('M d') }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </x-card>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
            @else
            <!-- Empty State -->
            <x-card class="text-center py-16 border-dashed">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <div class="rounded-full bg-muted/50 p-4 ring-1 ring-border">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-xl font-semibold text-foreground">No events found</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto">We couldn't find any events matching your criteria. Try adjusting your filters or create a new post.</p>
                    </div>
                    @if(!Auth::user()->isAdmin())
                    <div class="pt-4">
                        <a href="{{ route('post.create') }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 bg-indigo-600 text-white shadow hover:bg-indigo-700 h-9 px-4 py-2">
                             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Create New Post
                        </a>
                    </div>
                    @endif
                </div>
            </x-card>
            @endif
        </div>
    </div>
</x-app-layout>
