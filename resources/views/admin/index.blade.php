<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-8">Admin Panel - Post Verification</h1>

            @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <div x-data="{ tab: 'pending' }">
                <!-- Tabs -->
                <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-1 flex space-x-2">
                    <button @click="tab = 'pending'" :class="tab === 'pending' ? 'bg-yellow-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition relative">
                        Pending ({{ $pendingPosts->count() }})
                        @if($pendingPosts->count() > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $pendingPosts->count() }}</span>
                        @endif
                    </button>
                    <button @click="tab = 'approved'" :class="tab === 'approved' ? 'bg-green-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition">
                        Approved ({{ $approvedPosts->count() }})
                    </button>
                    <button @click="tab = 'rejected'" :class="tab === 'rejected' ? 'bg-red-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition">
                        Rejected ({{ $rejectedPosts->count() }})
                    </button>
                    <button @click="tab = 'reports'" :class="tab === 'reports' ? 'bg-orange-500 text-white' : 'text-gray-600 dark:text-gray-400'" class="flex-1 px-4 py-2 rounded-md font-semibold transition relative">
                        Reports ({{ $pendingReports->count() }})
                        @if($pendingReports->count() > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $pendingReports->count() }}</span>
                        @endif
                    </button>
                </div>

                <!-- Pending Posts -->
                <div x-show="tab === 'pending'" class="space-y-4">
                    @forelse($pendingPosts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <div class="flex">
                            <div class="w-32 h-32 flex-shrink-0 mr-6">
                                @if($post->poster_path)
                                <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" class="w-full h-full object-cover rounded-lg">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->judul }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">By: <strong>{{ $post->user->name }}</strong> ({{ $post->user->email }})</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Category: <strong>{{ $post->kategori }}</strong> | Deadline: <strong>{{ $post->deadline->format('d M Y') }}</strong></p>
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">{{ Str::limit($post->deskripsi, 200) }}</p>
                                
                                <div class="flex space-x-2" x-data="{ showRejectForm: false }">
                                    <a href="{{ route('post.show', $post->id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                        View Full
                                    </a>
                                    <form action="{{ route('admin.approve', $post->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                                            ✓ Approve
                                        </button>
                                    </form>
                                    <button @click="showRejectForm = !showRejectForm" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                                        ✗ Reject
                                    </button>
                                    
                                    <div x-show="showRejectForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
                                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 max-w-md w-full mx-4">
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Reject Post</h3>
                                            <form action="{{ route('admin.reject', $post->id) }}" method="POST">
                                                @csrf
                                                <textarea name="pesan_admin" rows="4" required
                                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-red-500 dark:bg-gray-700 dark:text-white mb-4"
                                                    placeholder="Reason for rejection..."></textarea>
                                                <div class="flex space-x-2">
                                                    <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                                                        Confirm Reject
                                                    </button>
                                                    <button type="button" @click="showRejectForm = false" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 transition">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <p class="text-gray-600 dark:text-gray-400">No pending posts to review.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Approved Posts -->
                <div x-show="tab === 'approved'" class="space-y-4" style="display: none;">
                    @forelse($approvedPosts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->judul }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">By: {{ $post->user->name }} | {{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('post.show', $post->id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                    View
                                </a>
                                <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <p class="text-gray-600 dark:text-gray-400">No approved posts yet.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Rejected Posts -->
                <div x-show="tab === 'rejected'" class="space-y-4" style="display: none;">
                    @forelse($rejectedPosts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ $post->judul }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">By: {{ $post->user->name }}</p>
                        <div class="p-3 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded mb-3">
                            <p class="text-sm font-semibold text-red-800 dark:text-red-300">Rejection Reason:</p>
                            <p class="text-sm text-red-700 dark:text-red-400">{{ $post->pesan_admin }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('post.show', $post->id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                View
                            </a>
                            <form action="{{ route('admin.approve', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                                    Approve Now
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <p class="text-gray-600 dark:text-gray-400">No rejected posts.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Reports -->
                <div x-show="tab === 'reports'" class="space-y-4" style="display: none;">
                    @forelse($pendingReports as $report)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Report on: {{ $report->post->judul }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Reported by: <strong>{{ $report->user->name }}</strong> ({{ $report->user->email }})</p>
                        <div class="p-3 bg-orange-50 dark:bg-orange-900/20 border-l-4 border-orange-500 rounded mb-3">
                            <p class="text-sm font-semibold text-orange-800 dark:text-orange-300">Reason:</p>
                            <p class="text-sm text-orange-700 dark:text-orange-400">{{ $report->reason }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('post.show', $report->post_id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                                View Post
                            </a>
                            <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                                    Mark Resolved
                                </button>
                            </form>
                            <form action="{{ route('admin.posts.delete', $report->post_id) }}" method="POST" onsubmit="return confirm('Delete the reported post?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition">
                                    Delete Post
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                        <p class="text-gray-600 dark:text-gray-400">No pending reports.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
