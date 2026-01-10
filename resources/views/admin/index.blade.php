<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">Admin Panel - Verification</h1>
            </div>

            @if(session('success'))
                <div
                    class="mb-6 rounded-md bg-green-50 p-4 text-sm font-medium text-green-700 border border-green-200 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div x-data="{ tab: 'pending' }" class="space-y-6">
                <!-- Tab Navigation -->
                <div
                    class="inline-flex h-10 items-center justify-center rounded-lg bg-gray-100 p-1 text-gray-500 border border-gray-200">
                    <button @click="tab = 'pending'"
                        :class="tab === 'pending' ? 'bg-white text-gray-900 shadow-sm' : 'hover:bg-gray-200 hover:text-gray-900'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                        Pending ({{ $pendingPosts->count() }})
                    </button>
                    <button @click="tab = 'approved'"
                        :class="tab === 'approved' ? 'bg-white text-gray-900 shadow-sm' : 'hover:bg-gray-200 hover:text-gray-900'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                        Approved ({{ $approvedPosts->count() }})
                    </button>
                    <button @click="tab = 'rejected'"
                        :class="tab === 'rejected' ? 'bg-white text-gray-900 shadow-sm' : 'hover:bg-gray-200 hover:text-gray-900'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                        Rejected ({{ $rejectedPosts->count() }})
                    </button>
                    <button @click="tab = 'reports'"
                        :class="tab === 'reports' ? 'bg-white text-gray-900 shadow-sm' : 'hover:bg-gray-200 hover:text-gray-900'"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1.5 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500">
                        Reports ({{ $pendingReports->count() }})
                    </button>
                </div>

                <!-- Pending Posts Table -->
                <div x-show="tab === 'pending'" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Poster</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Author</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($pendingPosts as $post)
                                    <tr class="hover:bg-gray-50 transition-colors" x-data="{ showReject: false, showActions: false }">
                                        <td class="px-6 py-4">
                                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 flex-shrink-0">
                                                @if($post->poster_path)
                                                    <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="flex items-center justify-center h-full text-gray-400">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900 max-w-xs truncate">{{ $post->judul }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if($post->user->profile_picture)
                                                    <img src="{{ Storage::url($post->user->profile_picture) }}" alt="{{ $post->user->name }}" 
                                                        class="w-8 h-8 rounded-full object-cover">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <span class="text-sm text-gray-700 font-medium">{{ $post->user->name }}</span>
                                                    @if($post->user->role === 'organizer')
                                                        <span class="text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">Organisasi</span>
                                                    @elseif($post->user->role === 'student')
                                                        <span class="text-[10px] text-blue-600 font-semibold uppercase tracking-wider">Mahasiswa</span>
                                                    @else
                                                        <span class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">{{ ucfirst($post->user->role) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                {{ $post->kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- View Button -->
                                                <a href="{{ route('post.show', $post->id) }}" target="_blank"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </a>
                                                
                                                <!-- Approve Button -->
                                                <form action="{{ route('admin.approve', $post->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Approve
                                                    </button>
                                                </form>

                                                <!-- Reject Button with Dropdown -->
                                                <div class="relative">
                                                    <button @click="showReject = !showReject" @click.away="showReject = false"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Reject
                                                    </button>
                                                    
                                                    <!-- Reject Form Dropdown -->
                                                    <div x-show="showReject" x-cloak x-transition:enter="transition ease-out duration-100"
                                                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                                        x-transition:leave="transition ease-in duration-75"
                                                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                                        class="absolute right-0 mt-2 w-80 p-4 bg-white rounded-xl shadow-xl border border-gray-200 z-50">
                                                        <form action="{{ route('admin.reject', $post->id) }}" method="POST">
                                                            @csrf
                                                            <div class="flex items-center gap-2 mb-3">
                                                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                    </svg>
                                                                </div>
                                                                <p class="text-sm font-semibold text-gray-900">Reject Post</p>
                                                            </div>
                                                            <textarea name="pesan_admin" rows="3" required
                                                                class="w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2.5 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent focus:bg-white mb-3 resize-none"
                                                                placeholder="Enter reason for rejection..."></textarea>
                                                            <div class="flex gap-2">
                                                                <button type="button" @click="showReject = false"
                                                                    class="flex-1 inline-flex items-center justify-center rounded-lg text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 h-9 px-3 transition-colors">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit"
                                                                    class="flex-1 inline-flex items-center justify-center rounded-lg text-sm font-semibold bg-red-600 text-white hover:bg-red-700 h-9 px-3 shadow-sm transition-colors">
                                                                    Confirm Reject
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="font-medium">No pending posts found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Approved Posts Table -->
                <div x-show="tab === 'approved'" style="display: none;" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Author</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Approved</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($approvedPosts as $post)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900 max-w-xs truncate">{{ $post->judul }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if($post->user->profile_picture)
                                                    <img src="{{ Storage::url($post->user->profile_picture) }}" alt="{{ $post->user->name }}" 
                                                        class="w-8 h-8 rounded-full object-cover">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <span class="text-sm text-gray-700 font-medium">{{ $post->user->name }}</span>
                                                    @if($post->user->role === 'organizer')
                                                        <span class="text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">Organisasi</span>
                                                    @elseif($post->user->role === 'student')
                                                        <span class="text-[10px] text-blue-600 font-semibold uppercase tracking-wider">Mahasiswa</span>
                                                    @else
                                                        <span class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">{{ ucfirst($post->user->role) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                                Approved
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-500">{{ $post->updated_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- View Button -->
                                                <a href="{{ route('post.show', $post->id) }}" target="_blank"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="font-medium">Nothing approved yet</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Rejected Posts Table -->
                <div x-show="tab === 'rejected'" style="display: none;" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Author</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rejection Reason</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($rejectedPosts as $post)
                                    <tr class="hover:bg-gray-50 transition-colors border-l-4 border-l-red-400">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900 max-w-xs truncate">{{ $post->judul }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if($post->user->profile_picture)
                                                    <img src="{{ Storage::url($post->user->profile_picture) }}" alt="{{ $post->user->name }}" 
                                                        class="w-8 h-8 rounded-full object-cover">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <span class="text-sm text-gray-700 font-medium">{{ $post->user->name }}</span>
                                                    @if($post->user->role === 'organizer')
                                                        <span class="text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">Organisasi</span>
                                                    @elseif($post->user->role === 'student')
                                                        <span class="text-[10px] text-blue-600 font-semibold uppercase tracking-wider">Mahasiswa</span>
                                                    @else
                                                        <span class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">{{ ucfirst($post->user->role) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 max-w-md">
                                            <div class="p-3 bg-red-50 text-red-700 text-sm rounded-lg border border-red-100">
                                                {{ $post->pesan_admin }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end">
                                                <form action="{{ route('admin.approve', $post->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium bg-green-600 text-white hover:bg-green-700 shadow-sm transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                        Re-Approve
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="font-medium">No rejected posts</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Reports Table -->
                <div x-show="tab === 'reports'" style="display: none;" class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Target Post</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Reporter</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Reason</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Reported At</th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($pendingReports as $report)
                                    <tr class="hover:bg-orange-50/50 transition-colors border-l-4 border-l-orange-400">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600 flex-shrink-0">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                    </svg>
                                                </div>
                                                <div class="font-semibold text-gray-900 max-w-xs truncate">{{ $report->post->judul }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if($report->user && $report->user->profile_picture)
                                                    <img src="{{ Storage::url($report->user->profile_picture) }}" alt="{{ $report->user->name }}" 
                                                        class="w-8 h-8 rounded-full object-cover">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-semibold text-sm">
                                                        {{ strtoupper(substr($report->user->name ?? 'A', 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div class="flex flex-col">
                                                    <span class="text-sm text-gray-700 font-medium">{{ $report->user->name ?? 'Anonymous' }}</span>
                                                    @if($report->user)
                                                        @if($report->user->role === 'organizer')
                                                            <span class="text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">Organisasi</span>
                                                        @elseif($report->user->role === 'student')
                                                            <span class="text-[10px] text-blue-600 font-semibold uppercase tracking-wider">Mahasiswa</span>
                                                        @else
                                                            <span class="text-[10px] text-gray-500 font-semibold uppercase tracking-wider">{{ ucfirst($report->user->role) }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 max-w-md">
                                            <div class="text-sm text-gray-600 bg-orange-50 p-3 rounded-lg border border-orange-100 italic">
                                                "{{ $report->reason }}"
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm text-gray-500">{{ $report->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <!-- Review Post Button -->
                                                <a href="{{ route('post.show', $report->post_id) }}" target="_blank"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Review
                                                </a>

                                                <!-- Keep (Dismiss) Button -->
                                                <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Keep Post
                                                    </button>
                                                </form>

                                                <!-- Ban Post Button -->
                                                <form action="{{ route('admin.posts.delete', $report->post_id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to ban this post?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 border border-red-200 transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                        </svg>
                                                        Ban Post
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="font-medium">No pending reports</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>