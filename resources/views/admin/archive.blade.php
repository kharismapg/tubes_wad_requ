<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Archived Posts</h1>

            <div class="mb-8 bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <form method="GET" action="{{ route('admin.archive') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Year</label>
                        <select name="year"
                            class="w-full h-10 rounded-md border-gray-300 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="">All Years</option>
                            @for($y = date('Y'); $y >= 2020; $y--)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700">Month</label>
                        <select name="month"
                            class="w-full h-10 rounded-md border-gray-300 bg-white px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            <option value="">All Months</option>
                            @for($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex items-end">
                        <x-primary-button class="w-full h-10 justify-center">
                            Filter Archive
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($archivedPosts as $post)
                    <x-card class="border border-gray-200 bg-white card-hover">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $post->judul }}</h3>
                            <p class="text-sm text-gray-500 mb-4">By: {{ $post->user->name }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <p
                                    class="text-xs font-semibold text-red-600 bg-red-50 px-2 py-1 rounded border border-red-100">
                                    Expired: {{ $post->deadline->format('d M Y') }}</p>
                                <a href="{{ route('post.show', $post->id) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold hover:underline">View
                                    details</a>
                            </div>
                        </div>
                    </x-card>
                @empty
                    <div
                        class="col-span-full bg-white border border-dashed border-gray-300 rounded-xl p-12 text-center text-gray-500">
                        No archived posts found matching your criteria.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>