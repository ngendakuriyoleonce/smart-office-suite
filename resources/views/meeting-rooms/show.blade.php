<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $meetingRoom->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingRoom->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Capacity</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $meetingRoom->capacity }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if ($meetingRoom->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Amenities</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if ($meetingRoom->amenities)
                                    <ul class="list-disc list-inside">
                                        @foreach ($meetingRoom->amenities as $amenity)
                                            <li>{{ $amenity }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    —
                                @endif
                            </dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('meeting-rooms.edit', $meetingRoom) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit
                        </a>
                        <a href="{{ route('meeting-rooms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
