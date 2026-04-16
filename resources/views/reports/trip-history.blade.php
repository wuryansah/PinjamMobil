<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Usage Report') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex gap-4">
                    <a href="{{ route('reports.report') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        On Trip History PDF
                    </a>
                    <a href="{{ route('reports.fuel') }}" class="px-4 py-2 bg-blue-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        To Fuel Report PDF
                    </a>
                </div>
                <a href="{{ route('reports') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
            </div>

            <form method="GET" action="{{ route('reports.report') }}" class="mb-6 flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle</label>
                    <select name="vehicle_id" class="border rounded px-3 py-2">
                        <option value="">All Vehicles</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" {{ request('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                {{ $vehicle->name }} ({{ $vehicle->plate_number }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Filter</button>
                    <a href="{{ route('reports.report') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
                    <button type="submit" name="export" value="pdf" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Export PDF</button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Trips</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $requests->count() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Mileage</p>
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($totalMileage, 2) }} km</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Fuel</p>
                    <p class="text-3xl font-bold text-teal-600 mt-1">{{ number_format($totalFuel, 2) }} L</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Cost</p>
                    <p class="text-3xl font-bold text-purple-600 mt-1">Rp {{ number_format($totalCost, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Start Time</th>
                                <th class="px-6 py-3">End Time</th>
                                <th class="px-6 py-3">Employee</th>
                                <th class="px-6 py-3">Department</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Destination</th>
                                <th class="px-6 py-3">Start KM</th>
                                <th class="px-6 py-3">End KM</th>
                                <th class="px-6 py-3">Distance</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($requests as $req)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">#{{ $req->id }}</td>
                                <td class="px-6 py-4">{{ $req->start_datetime->format('d M Y') }}</td>
                                <td class="px-6 py-4">{{ $req->usageRecord && $req->usageRecord->start_time ? \Carbon\Carbon::parse($req->usageRecord->start_time)->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4">{{ $req->usageRecord && $req->usageRecord->end_time ? \Carbon\Carbon::parse($req->usageRecord->end_time)->format('H:i') : '-' }}</td>
                                <td class="px-6 py-4">{{ $req->borrower->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $req->borrower->department ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $req->vehicle->name ?? '-' }}</td>
                                <td class="px-6 py-4 max-w-xs truncate">{{ $req->destination }}</td>
                                <td class="px-6 py-4">{{ $req->usageRecord ? number_format($req->usageRecord->start_km, 2) : '-' }}</td>
                                <td class="px-6 py-4">{{ $req->usageRecord ? number_format($req->usageRecord->end_km, 2) : '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($req->usageRecord && $req->usageRecord->end_km && $req->usageRecord->start_km)
                                        {{ number_format($req->usageRecord->end_km - $req->usageRecord->start_km, 2) }} km
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-500">No completed trips found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>