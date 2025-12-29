<nav x-data="{ open: false }" class="bg-gradient-to-r from-indigo-600 to-purple-600 border-b border-indigo-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 11V7h4v4H8z"/>
                        </svg>
                        <span class="text-2xl font-bold text-white">Req-U</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    @if(!Auth::user()->isAdmin())
                    <a href="{{ route('post.my-posts') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('post.my-posts') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        My Posts
                    </a>

                    <a href="{{ route('bookmarks.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('bookmarks.index') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                        </svg>
                        Bookmarks
                    </a>

                    <a href="{{ route('post.archive') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('post.archive') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Archive
                    </a>
                    @endif

                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.index') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition relative">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Verification
                        @php
                            $pendingPostsCount = \App\Models\Post::where('status', 'pending')->count();
                        @endphp
                        @if($pendingPostsCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $pendingPostsCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.users') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Users
                    </a>

                    <a href="{{ route('admin.reports') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.reports') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition relative">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Reports
                        @php
                            $pendingReportsCount = \App\Models\Report::where('status', 'pending')->count();
                        @endphp
                        @if($pendingReportsCount > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $pendingReportsCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.archive') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.archive') ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' }} transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Archive
                    </a>
                    @endif
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Role Badge -->
                <div class="px-3 py-1 rounded-full text-xs font-semibold {{ Auth::user()->isAdmin() ? 'bg-red-500' : (Auth::user()->isOrganizer() ? 'bg-green-500' : 'bg-blue-500') }} text-white">
                    {{ ucfirst(Auth::user()->role) }}
                </div>

                <!-- Notifications -->
                @if(!Auth::user()->isAdmin())
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="relative p-2 text-white hover:bg-white/10 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @php
                            $unreadCount = Auth::user()->notifications()->where('is_read', false)->count();
                        @endphp
                        @if($unreadCount > 0)
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-50" style="display: none;">
                        <div class="p-4 bg-gray-50 border-b">
                            <h3 class="font-semibold text-gray-900">Notifications</h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            @forelse(Auth::user()->notifications()->take(5)->get() as $notification)
                            <a href="{{ route('notifications.index') }}" class="block p-4 hover:bg-gray-50 border-b {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }}">
                                <p class="font-semibold text-sm text-gray-900">{{ $notification->title }}</p>
                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($notification->message, 60) }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </a>
                            @empty
                            <div class="p-4 text-center text-gray-500">
                                No notifications
                            </div>
                            @endforelse
                        </div>
                        <a href="{{ route('notifications.index') }}" class="block p-3 text-center text-sm text-indigo-600 hover:bg-gray-50 font-semibold">
                            View All
                        </a>
                    </div>
                </div>
                @endif

                <!-- User Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 text-white hover:bg-white/10 rounded-md transition">
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl overflow-hidden z-50" style="display: none;">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white/10 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Dashboard</a>
            @if(!Auth::user()->isAdmin())
            <a href="{{ route('post.my-posts') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">My Posts</a>
            <a href="{{ route('bookmarks.index') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Bookmarks</a>
            <a href="{{ route('post.archive') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Archive</a>
            <a href="{{ route('notifications.index') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Notifications</a>
            @else
            <a href="{{ route('admin.index') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Verifikasi</a>
            <a href="{{ route('admin.users') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Users</a>
            <a href="{{ route('admin.reports') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Reports</a>
            <a href="{{ route('admin.archive') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Archive</a>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-white/20">
            <div class="px-4">
                <div class="font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm text-white/70">{{ Auth::user()->email }}</div>
                <div class="mt-1">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ Auth::user()->isAdmin() ? 'bg-red-500' : (Auth::user()->isOrganizer() ? 'bg-green-500' : 'bg-blue-500') }} text-white">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-white hover:bg-white/10">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 text-white hover:bg-white/10">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
