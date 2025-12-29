<x-app-layout>
    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Notifications</h1>
            
            @if($notifications->count() > 0)
            <div class="mb-4">
                <form action="{{ route('notifications.read-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm">
                        Mark All as Read
                    </button>
                </form>
            </div>

            <div class="space-y-4">
                @foreach($notifications as $notification)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 {{ $notification->is_read ? '' : 'border-l-4 border-indigo-600' }}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $notification->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-2">{{ $notification->message }}</p>
                            <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->is_read)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-blue-100 text-blue-700 rounded text-xs hover:bg-blue-200 transition">
                                Mark as Read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
            @else
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                <p class="text-gray-600 dark:text-gray-400">No notifications yet.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
