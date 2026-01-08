<nav x-data="{ open: false }" class="border-b border-gray-100 bg-white shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 11V7h4v4H8z" />
                        </svg>
                        <span class="text-xl font-bold text-gray-900">Req-U</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if(!Auth::user()->isAdmin())
                        <x-nav-link :href="route('post.my-posts')" :active="request()->routeIs('post.my-posts')">
                            My Posts
                        </x-nav-link>

                        <x-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks.index')">
                            Bookmarks
                        </x-nav-link>

                        <x-nav-link :href="route('post.archive')" :active="request()->routeIs('post.archive')">
                            Archive
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->isAdmin())
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')"
                            class="relative">
                            Verification
                            @php
                                $pendingPostsCount = \App\Models\Post::where('status', 'pending')->count();
                            @endphp
                            @if($pendingPostsCount > 0)
                                <span
                                    class="absolute -top-1 -right-3 bg-red-600 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center">{{ $pendingPostsCount }}</span>
                            @endif
                        </x-nav-link>

                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">
                            Users
                        </x-nav-link>

                        <x-nav-link :href="route('admin.reports')" :active="request()->routeIs('admin.reports')"
                            class="relative">
                            Reports
                            @php
                                $pendingReportsCount = \App\Models\Report::where('status', 'pending')->count();
                            @endphp
                            @if($pendingReportsCount > 0)
                                <span
                                    class="absolute -top-1 -right-3 bg-red-600 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center">{{ $pendingReportsCount }}</span>
                            @endif
                        </x-nav-link>

                        <x-nav-link :href="route('admin.archive')" :active="request()->routeIs('admin.archive')">
                            Archive
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <!-- Role Badge -->
                <div
                    class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ Auth::user()->isAdmin() ? 'bg-red-100 text-red-700' : (Auth::user()->isOrganizer() ? 'bg-green-100 text-green-700' : 'bg-indigo-100 text-indigo-700') }}">
                    {{ ucfirst(Auth::user()->role) }}
                </div>

                <!-- Notifications -->
                @if(!Auth::user()->isAdmin())
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="relative p-2 text-gray-500 hover:text-gray-900 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @php
                                $unreadCount = Auth::user()->notifications()->where('is_read', false)->count();
                            @endphp
                            @if($unreadCount > 0)
                                <span
                                    class="absolute top-0 right-0 bg-red-600 text-white text-[10px] rounded-full h-4 w-4 flex items-center justify-center">{{ $unreadCount }}</span>
                            @endif
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-80 bg-white border border-gray-100 rounded-md shadow-lg overflow-hidden z-50 p-1"
                            style="display: none;">
                            <div class="px-2 py-1.5 text-sm font-semibold text-gray-800">
                                Notifications
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                @forelse(Auth::user()->notifications()->take(5)->get() as $notification)
                                    <a href="{{ route('notifications.index') }}"
                                        class="block px-2 py-2 text-sm hover:bg-gray-50 rounded-sm {{ $notification->is_read ? 'opacity-70' : '' }}">
                                        <p class="font-medium text-gray-900 leading-none">{{ $notification->title }}</p>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $notification->message }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}</p>
                                    </a>
                                @empty
                                    <div class="p-4 text-center text-sm text-gray-500">
                                        No notifications
                                    </div>
                                @endforelse
                            </div>
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <a href="{{ route('notifications.index') }}"
                                    class="block w-full px-2 py-1.5 text-center text-sm text-indigo-600 hover:bg-gray-50 rounded-sm">
                                    View All
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(!Auth::user()->isAdmin())
                <x-responsive-nav-link :href="route('post.my-posts')" :active="request()->routeIs('post.my-posts')">
                    My Posts
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks.index')">
                    Bookmarks
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('post.archive')" :active="request()->routeIs('post.archive')">
                    Archive
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('notifications.index')"
                    :active="request()->routeIs('notifications.index')">
                    Notifications
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>