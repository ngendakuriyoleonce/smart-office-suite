<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $employee->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">First Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->first_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->last_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Employee ID</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->employee_id }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Hire Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->hire_date }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($employee->status === 'active') bg-green-100 text-green-800
                                    @elseif ($employee->status === 'inactive') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Department</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->department?->name ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Position</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->position?->title ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Salary</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->salary ? number_format($employee->salary, 2) : '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $employee->phone ?? '—' }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center gap-4">
                        <a href="{{ route('employees.edit', $employee) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit
                        </a>
                        <a href="{{ route('employees.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Back to list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
