<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Departments') }}
            </h2>
            <a href="{{ route('departments.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all hover:shadow-lg">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add Department
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700" role="alert">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <form method="GET" class="flex flex-wrap gap-4 items-center">
                        <div class="flex-1 min-w-[200px]">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search department name..." class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <select name="sort" onchange="this.form.submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="latest" {{ request('sort') === 'latest' || !request('sort') ? 'selected' : '' }}>Latest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                        <a href="{{ route('departments.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Code</th>
                                <th class="px-6 py-3">Manager</th>
                                <th class="px-6 py-3">Employees</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($departments as $dept)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $dept->name }}</td>
                                <td class="px-6 py-4"><span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $dept->code }}</span></td>
                                <td class="px-6 py-4 text-gray-600">{{ $dept->manager->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $dept->employees->count() }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('departments.edit', $dept->id) }}" class="text-orange-500 hover:text-orange-600 font-medium">Edit</a>
                                        <form method="POST" action="{{ route('departments.destroy', $dept->id) }}" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">No departments found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $departments->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>