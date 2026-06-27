<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $department->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $department->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Code</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $department->code }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $department->description ?? '—' }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('departments.edit', $department) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit
                        </a>
                        <a href="{{ route('departments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
