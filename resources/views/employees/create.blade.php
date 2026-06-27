<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="mb-4">
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name')" required />
                                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="last_name" :value="__('Last Name')" />
                                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')" required />
                                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="employee_id" :value="__('Employee ID')" />
                                <x-text-input id="employee_id" name="employee_id" type="text" class="mt-1 block w-full" :value="old('employee_id')" required />
                                <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="hire_date" :value="__('Hire Date')" />
                                <x-text-input id="hire_date" name="hire_date" type="date" class="mt-1 block w-full" :value="old('hire_date')" required />
                                <x-input-error :messages="$errors->get('hire_date')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="active" @selected(old('status') === 'active')>Active</option>
                                    <option value="inactive" @selected(old('status') === 'inactive')>Inactive</option>
                                    <option value="terminated" @selected(old('status') === 'terminated')>Terminated</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="department_id" :value="__('Department')" />
                                <select id="department_id" name="department_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="position_id" :value="__('Position')" />
                                <select id="position_id" name="position_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Position</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}" @selected(old('position_id') == $position->id)>{{ $position->title }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('position_id')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="salary" :value="__('Salary')" />
                                <x-text-input id="salary" name="salary" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('salary')" />
                                <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-2">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>
                            <a href="{{ route('employees.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
