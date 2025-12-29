<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Archived Posts</h1>
            
            <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                <form method="GET" action="{{ route('admin.archive') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <select name="year" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="">All Years</option>
                        @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <select name="month" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white">
                        <option value="">All Months</option>
                        @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($archivedPosts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $post->judul }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">By: {{ $post->user->name }}</p>
                    <p class="text-xs text-red-600 mb-3">Expired: {{ $post->deadline->format('d M Y') }}</p>
                    <a href="{{ route('post.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">View →</a>
                </div>
                @empty
                <div class="col-span-3 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                    <p class="text-gray-600 dark:text-gray-400">No archived posts found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
