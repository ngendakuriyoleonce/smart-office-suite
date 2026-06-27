<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register Visitor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('visitors.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="mb-4">
                                <x-input-label for="full_name" :value="__('Full Name')" />
                                <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name')" required />
                                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="company" :value="__('Company')" />
                                <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company')" />
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="host_employee_id" :value="__('Host')" />
                                <select id="host_employee_id" name="host_employee_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select Host</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" @selected(old('host_employee_id') == $employee->id)>{{ $employee->full_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('host_employee_id')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="purpose" :value="__('Purpose')" />
                                <x-text-input id="purpose" name="purpose" type="text" class="mt-1 block w-full" :value="old('purpose')" />
                                <x-input-error :messages="$errors->get('purpose')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="check_in" :value="__('Check In')" />
                                <x-text-input id="check_in" name="check_in" type="datetime-local" class="mt-1 block w-full" :value="old('check_in')" />
                                <x-input-error :messages="$errors->get('check_in')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="check_out" :value="__('Check Out')" />
                                <x-text-input id="check_out" name="check_out" type="datetime-local" class="mt-1 block w-full" :value="old('check_out')" />
                                <x-input-error :messages="$errors->get('check_out')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-2">
                            <x-primary-button>{{ __('Register') }}</x-primary-button>
                            <a href="{{ route('visitors.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
