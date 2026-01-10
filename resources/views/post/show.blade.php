<x-app-layout>
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-900 mb-8 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>

            <!-- Poster Card (Moved to Top) -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-200 mb-8">
                <div class="relative">
                    @if($post->poster_path)
                        <img src="{{ Storage::url($post->poster_path) }}" alt="{{ $post->judul }}" 
                            class="w-full h-auto max-h-[500px] object-cover object-top">
                    @else
                        <div class="aspect-video bg-gray-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Bookmark -->
                    @if(!Auth::user()->isAdmin() && $post->user_id !== Auth::id())
                        <form action="{{ route('bookmark.toggle', $post->id) }}" method="POST" class="absolute top-4 right-4">
                            @csrf
                            <button type="submit" class="w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:scale-105 transition-transform">
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
            </div>

            <!-- Title & Metadata Card (Full Width) -->
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-200 mb-8">
                <!-- Title & Meta Header -->
                <div class="border-b border-gray-100 pb-8 mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 leading-tight mb-4">{{ $post->judul }}</h1>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Posted {{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Metadata Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <!-- Deadline -->
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Deadline</p>
                            <p class="text-sm font-bold text-gray-900">{{ $post->deadline->format('d F Y') }}</p>
                        </div>
                    </div>

                    <!-- Days Left -->
                    @php $daysLeft = (int) ceil(now()->diffInDays($post->deadline, false)); @endphp
                    @if($daysLeft >= 0)
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-lg {{ $daysLeft <= 7 ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' }} flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Sisa Waktu</p>
                                <p class="text-sm font-bold {{ $daysLeft <= 7 ? 'text-red-600' : 'text-emerald-600' }}">
                                    {{ $daysLeft }} hari lagi
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Category -->
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">Kategori</p>
                            @php
                                $categoryColors = [
                                    'Kepanitiaan' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'Organisasi' => 'bg-purple-100 text-purple-700 border-purple-200',
                                    'Laboratorium' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'Seminar' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'Lomba' => 'bg-rose-100 text-rose-700 border-rose-200',
                                    'Event Kampus' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                ];
                                $colorClass = $categoryColors[$post->kategori] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                            @endphp
                            <div class="mt-0.5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $colorClass }}">
                                    {{ $post->kategori }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description & Requirements Card (Full Width) -->
            <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-200 mb-8">
                <!-- Description Text -->
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-3">Deskripsi Event
                    </h3>
                    <div class="prose prose-indigo max-w-none text-gray-600">
                        <p class="whitespace-pre-line leading-relaxed">{{ $post->deskripsi }}</p>
                    </div>
                </div>

                <!-- Requirements -->
                @if($post->requirements && count($post->requirements) > 0)
                    <div class="border-t border-gray-100 pt-8">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">Persyaratan</h3>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($post->requirements as $index => $requirement)
                                <li class="flex items-start gap-3 bg-gray-50 p-3 rounded-xl">
                                    <span
                                        class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 text-xs font-bold flex items-center justify-center mt-0.5">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="text-gray-700 text-sm font-medium pt-0.5">{{ $requirement }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Organizer Card (Full Width at Bottom) -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8">
                <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-4">Organizer</h2>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div class="flex-1 flex items-center gap-4">
                        @if($post->user->profile_picture)
                            <img src="{{ Storage::url($post->user->profile_picture) }}" alt="{{ $post->user->name }}"
                                class="w-16 h-16 rounded-full object-cover ring-4 ring-gray-100 flex-shrink-0">
                        @else
                            <div
                                class="w-16 h-16 rounded-full bg-indigo-50 flex items-center justify-center text-2xl font-bold text-indigo-600 ring-4 ring-gray-100 flex-shrink-0">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $post->user->name }}</h3>
                            <div class="flex items-center gap-1 text-sm text-gray-500 mt-1">
                                <svg class="w-4 h-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Verified Creator</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-3 sm:ml-auto">
                        @if($post->user_id === Auth::id() || Auth::user()->isAdmin())
                            <a href="{{ route('post.edit', $post->id) }}"
                                class="px-6 py-3 bg-white border-2 border-indigo-50 text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 hover:border-indigo-100 transition-all text-center">
                                Edit Post
                            </a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?')" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-red-50 text-red-600 font-bold rounded-xl hover:bg-red-100 transition-colors text-center">
                                    Hapus Post
                                </button>
                            </form>
                        @else
                            <a href="{{ route('report.create', $post->id) }}"
                                class="px-6 py-3 text-gray-400 text-sm font-medium hover:text-gray-600 transition-colors text-center flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Laporkan
                            </a>
                            <a href="{{ $post->link_pendaftaran }}" target="_blank"
                                class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-bold rounded-xl px-8 py-3 text-center shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transform hover:-translate-y-0.5 transition-all">
                                Daftar Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>