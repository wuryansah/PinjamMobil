<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Usage Report') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4 mb-6">
                <a href="{{ route('reports.report') }}" class="px-4 py-2 bg-blue-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                    To Trip History PDF
                </a>
                <a href="{{ route('reports.fuel') }}" class="px-4 py-2 bg-blue-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                    To Fuel Report PDF
                </a>
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