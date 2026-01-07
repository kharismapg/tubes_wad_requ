<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Reports Management</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($reports as $report)
                <x-card class="border border-orange-200 bg-white">
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <h3 class="font-bold text-lg text-gray-900">Report #{{ $report->id }}</h3>
                        </div>
                        
                        <div class="space-y-3 mb-6">
                            <div>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Reported Post</span>
                                <p class="text-sm font-medium text-gray-900">{{ $report->post->judul }}</p>
                            </div>
                            <div>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Reason</span>
                                <p class="text-sm text-gray-600 bg-gray-50 p-2 rounded border border-gray-100 italic">"{{ $report->reason }}"</p>
                            </div>
                            <div>
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $report->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($report->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                             <a href="{{ route('post.show', $report->post_id) }}" target="_blank"
                                class="w-full inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 h-9 px-3">Review Post</a>
                             
                             @if($report->status == 'pending')
                             <div class="flex gap-2">
                                <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button class="w-full inline-flex items-center justify-center rounded-md text-sm font-semibold transition-colors bg-green-600 text-white hover:bg-green-700 h-9 px-3 shadow-sm">Dismiss</button>
                                </form>
                                <form action="{{ route('admin.posts.delete', $report->post_id) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button class="w-full inline-flex items-center justify-center rounded-md text-sm font-semibold transition-colors bg-red-600 text-white hover:bg-red-700 h-9 px-3 shadow-sm">Ban Post</button>
                                </form>
                             </div>
                             @endif
                        </div>
                    </div>
                </x-card>
                @empty
                <div class="col-span-full bg-white border border-dashed border-gray-300 rounded-xl p-12 text-center text-gray-500">
                    No reports found.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
