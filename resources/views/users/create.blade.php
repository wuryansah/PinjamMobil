<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add User') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" name="password" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input type="password" name="password_confirmation" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                            <select name="role" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Role</option>
                                <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="driver" {{ old('role') === 'driver' ? 'selected' : '' }}>Driver</option>
                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                            <select name="department" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->code }}" {{ old('department') === $dept->code ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('department') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Manager (for approval)</label>
                            <select name="manager_id" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Manager</option>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ old('manager_id') == $manager->id ? 'selected' : '' }}>{{ $manager->name }} ({{ ucfirst($manager->role) }})</option>
                                @endforeach
                            </select>
                            @error('manager_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg mr-3">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>