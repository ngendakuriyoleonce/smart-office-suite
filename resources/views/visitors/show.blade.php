<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $visitor->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->company ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->email ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->phone ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Host</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->host->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Purpose</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->purpose ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Check In</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->check_in ? \Carbon\Carbon::parse($visitor->check_in)->format('M d, Y g:i A') : '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Check Out</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $visitor->check_out ? \Carbon\Carbon::parse($visitor->check_out)->format('M d, Y g:i A') : '—' }}</dd>
                        </div>
                    </dl>

                    @if ($summary)
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <dt class="text-sm font-medium text-blue-700">AI Summary</dt>
                            <dd class="mt-1 text-sm text-blue-900">{{ $summary }}</dd>
                        </div>
                    @endif

                    @if ($visitor->badge_qr)
                        <div class="mt-6">
                            <dt class="text-sm font-medium text-gray-500 mb-2">Badge</dt>
                            <img src="{{ $visitor->badge_qr }}" alt="Visitor Badge" class="w-48 h-48 object-cover rounded border">
                        </div>
                    @endif

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('visitors.edit', $visitor) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit
                        </a>

                        @unless ($visitor->check_in)
                            <form action="{{ route('visitors.check-in', $visitor) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                                    Check In
                                </button>
                            </form>
                        @else
                            @unless ($visitor->check_out)
                                <form action="{{ route('visitors.check-out', $visitor) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500">
                                        Check Out
                                    </button>
                                </form>
                            @endunless
                        @endunless

                        <a href="{{ route('visitors.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
