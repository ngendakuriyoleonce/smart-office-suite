<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $meetingBooking->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Title</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingBooking->title }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Room</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingBooking->room->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Booked By</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingBooking->bookedBy->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @php
                                    $colors = ['pending' => 'bg-yellow-100 text-yellow-800', 'confirmed' => 'bg-green-100 text-green-800', 'cancelled' => 'bg-red-100 text-red-800'];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $colors[$meetingBooking->status] }}">{{ ucfirst($meetingBooking->status) }}</span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Start Time</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingBooking->start_time->format('F j, Y g:i A') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">End Time</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingBooking->end_time->format('F j, Y g:i A') }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingBooking->description ?? '—' }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('meeting-bookings.edit', $meetingBooking) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit
                        </a>
                        <a href="{{ route('meeting-bookings.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
