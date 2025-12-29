<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">All Reports</h1>
            
            <div class="space-y-4">
                @forelse($reports as $report)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $report->post->judul }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Reported by: {{ $report->user->name }} on {{ $report->created_at->format('d M Y H:i') }}</p>
                            <div class="p-3 bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 rounded mb-2">
                                <p class="text-sm text-orange-700 dark:text-orange-400">{{ $report->reason }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $report->status == 'resolved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($report->status) }}
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('post.show', $report->post_id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                View Post
                            </a>
                            @if($report->status == 'pending')
                            <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                                    Resolve
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                    <p class="text-gray-600 dark:text-gray-400">No reports yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
