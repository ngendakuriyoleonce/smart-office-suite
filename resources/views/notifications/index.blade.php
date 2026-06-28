<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($notifications as $notification)
                        <div class="p-4 {{ $notification->read_at ? 'bg-white' : 'bg-blue-50 border-l-4 border-blue-500' }} rounded mb-2">
                            <div class="flex justify-between items-start">
                                <div class="flex items-start gap-3">
                                    <svg class="h-6 w-6 mt-0.5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <a href="{{ $notification->data['action_url'] ?? '#' }}" class="text-sm text-gray-900 hover:text-blue-600 {{ $notification->read_at ? '' : 'font-semibold' }}">
                                        {{ $notification->data['message'] }}
                                    </a>
                                    <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @unless ($notification->read_at)
                                    <form action="{{ route('notifications.read', $notification) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs text-gray-600 hover:text-gray-800">Mark as read</button>
                                    </form>
                                @endunless
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-8">No notifications.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
