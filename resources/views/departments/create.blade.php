<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Department') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('departments.store') }}">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department Code</label>
                            <input type="text" name="code" value="{{ old('code') }}" required placeholder="e.g., HR, IT, FIN" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Manager (Department Head)</label>
                            <select name="manager_id" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Manager</option>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>{{ $manager->name }} ({{ ucfirst($manager->role) }})</option>
                                @endforeach
                            </select>
                            @error('manager_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('description') }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg mr-3">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Create Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>