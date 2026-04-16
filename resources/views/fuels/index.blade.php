<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Fuel Records') }}
            </h2>
            <a href="{{ route('fuels.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all hover:shadow-lg">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add Fuel Record
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

            <div class="mb-4 flex flex-wrap items-center gap-4">
                <form method="GET" action="{{ route('fuels.index') }}" class="flex items-center gap-2">
                    <select name="vehicle_id" onchange="this.form.submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">All Vehicles</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ $vehicleId == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }} ({{ $vehicle->plate_number }})</option>
                        @endforeach
                    </select>
                </form>
                <form method="GET" action="{{ route('fuels.index') }}" class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search location or vehicle..." class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </form>
                <form method="GET">
                    <select name="sort" onchange="this.closest('form').submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="latest" {{ request('sort') === 'latest' || !request('sort') ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </form>
                <a href="{{ route('fuels.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Fuel Type</th>
                                <th class="px-6 py-3">End KM</th>
                                <th class="px-6 py-3">Fuel (L)</th>
                                <th class="px-6 py-3">Price/L</th>
                                <th class="px-6 py-3">Total Cost</th>
                                <th class="px-6 py-3">Distance / km/L</th>
                                <th class="px-6 py-3">Location</th>
                                <th class="px-6 py-3">Files</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($fuelRecords as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $record->refuel_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $record->vehicle->name }}</td>
                                <td class="px-6 py-4">{{ $record->fuel_type ?? '-' }}</td>
                                <td class="px-6 py-4">{{ number_format($record->kilometer, 2) }} km</td>
                                <td class="px-6 py-4">{{ number_format($record->fuel_amount, 2) }}</td>
                                <td class="px-6 py-4">{{ $record->price_per_liter ? 'Rp ' . number_format($record->price_per_liter, 0, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4">{{ $record->calculated_fuel_cost ? 'Rp ' . number_format($record->calculated_fuel_cost, 0, ',', '.') : '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($record->distance_traveled || $record->fuel_consumption)
                                        <div class="flex flex-col gap-1">
                                            @if($record->distance_traveled)
                                                <span>{{ number_format($record->distance_traveled, 2) }} km</span>
                                            @endif
                                            @if($record->fuel_consumption)
                                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ number_format($record->fuel_consumption, 2) }} km/L
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $record->location ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($record->attachments->count() > 0)
                                        <button type="button" onclick="document.getElementById('viewFiles{{ $record->id }}').classList.remove('hidden')" class="text-xs bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded">
                                            {{ $record->attachments->count() }} files
                                        </button>
                                        <div id="viewFiles{{ $record->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h3 class="text-lg font-semibold">Attachments</h3>
                                                    <button onclick="document.getElementById('viewFiles{{ $record->id }}').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">&times;</button>
                                                </div>
                                                <div class="space-y-2 max-h-64 overflow-y-auto">
                                                    @foreach($record->attachments as $attachment)
                                                        <div class="flex items-center gap-2 p-2 border rounded">
                                                            @if(str_starts_with($attachment->file_type, 'image/'))
                                                                <img src="{{ asset('storage/' . $attachment->file_path) }}" class="w-12 h-12 object-cover rounded">
                                                            @else
                                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                            @endif
                                                            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="text-orange-500 hover:text-orange-600 text-sm truncate">{{ $attachment->file_name }}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('fuels.edit', $record->id) }}" class="text-orange-500 hover:text-orange-600 font-medium">Edit</a>
                                        <form method="POST" action="/fuels-destroy/{{ $record->id }}" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center text-gray-500">No fuel records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $fuelRecords->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>