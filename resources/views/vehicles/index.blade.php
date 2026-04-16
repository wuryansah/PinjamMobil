<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicle Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Vehicles</h3>
                        <button onclick="document.getElementById('addVehicleModal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Add Vehicle
                        </button>
                    </div>
                    
                    <div class="mb-4 flex flex-wrap gap-4 items-center">
                        <form method="GET" class="flex-1 min-w-[200px]">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, plate, type..." class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </form>
                        <form method="GET">
                            <select name="sort" onchange="this.closest('form').submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="latest" {{ request('sort') === 'latest' || !request('sort') ? 'selected' : '' }}>Latest First</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            </select>
                        </form>
                        <a href="{{ route('vehicles.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Plate Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Condition</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Availability</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Current KM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Driver</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($vehicles as $vehicle)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-mono">{{ $vehicle->plate_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $vehicle->type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($vehicle->condition === 'good')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Good</span>
                                        @elseif($vehicle->condition === 'needs_maintenance')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Needs Maintenance</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Unavailable</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($vehicle->availability === 'available')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                                        @elseif($vehicle->availability === 'in_use')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">In Use</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Maintenance</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($vehicle->current_kilometer)
                                            {{ number_format($vehicle->current_kilometer, 2) }} km
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $vehicle->driver->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="editVehicle({{ $vehicle->id }}, '{{ $vehicle->name }}', '{{ $vehicle->plate_number }}', '{{ $vehicle->type }}', '{{ $vehicle->condition }}', '{{ $vehicle->driver_id }}', '{{ $vehicle->current_kilometer }}')" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No vehicles found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $vehicles->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addVehicleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Add Vehicle</h3>
            <form action="{{ route('vehicles.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Plate Number</label>
                    <input type="text" name="plate_number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select name="type" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="car">Car</option>
                        <option value="van">Van</option>
                        <option value="truck">Truck</option>
                        <option value="motorcycle">Motorcycle</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Condition</label>
                    <select name="condition" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="good">Good</option>
                        <option value="needs_maintenance">Needs Maintenance</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Assign Driver (Optional)</label>
                    <select name="driver_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">None</option>
                        @foreach(\App\Models\User::where('role', 'driver')->get() as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Current Kilometer</label>
                    <input type="number" name="current_kilometer" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="0.00">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('addVehicleModal').classList.add('hidden')" class="mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editVehicleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Edit Vehicle</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" id="editName" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Plate Number</label>
                    <input type="text" name="plate_number" id="editPlate" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select name="type" id="editType" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="car">Car</option>
                        <option value="van">Van</option>
                        <option value="truck">Truck</option>
                        <option value="motorcycle">Motorcycle</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Condition</label>
                    <select name="condition" id="editCondition" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="good">Good</option>
                        <option value="needs_maintenance">Needs Maintenance</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Assign Driver (Optional)</label>
                    <select name="driver_id" id="editDriver" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">None</option>
                        @foreach(\App\Models\User::where('role', 'driver')->get() as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Current Kilometer</label>
                    <input type="number" name="current_kilometer" id="editKm" step="0.01" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('editVehicleModal').classList.add('hidden')" class="mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editVehicle(id, name, plate, type, condition, driverId, currentKm) {
            document.getElementById('editForm').action = '/vehicles/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editPlate').value = plate;
            document.getElementById('editType').value = type;
            document.getElementById('editCondition').value = condition;
            document.getElementById('editDriver').value = driverId || '';
            document.getElementById('editKm').value = currentKm || '';
            document.getElementById('editVehicleModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>