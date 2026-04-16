<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Fuel Record') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('fuels.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Vehicle</option>
                                @forelse($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ (old('vehicle_id') ?? request('vehicle_id')) == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }} ({{ $vehicle->plate_number }})</option>
                                @empty
                                    <option value="">No vehicles available</option>
                                @endforelse
                            </select>
                            @error('vehicle_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Refuel Date</label>
                            <input type="date" name="refuel_date" value="{{ old('refuel_date') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('refuel_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Start KM</label>
                            <input type="number" name="start_km" step="0.01" value="{{ old('start_km', $lastFuelRecord->kilometer ?? '') }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Auto-filled from last refuel">
                            @error('start_km') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">End KM</label>
                            <input type="number" name="kilometer" step="0.01" value="{{ old('kilometer') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Current kilometer">
                            @error('kilometer') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fuel Amount (Liters)</label>
                            <input type="number" name="fuel_amount" step="0.01" value="{{ old('fuel_amount') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="e.g., 25.50">
                            @error('fuel_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fuel Type</label>
                            <select name="fuel_type" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Fuel Type</option>
                                <option value="Pertalite" {{ old('fuel_type') == 'Pertalite' ? 'selected' : '' }}>Pertalite</option>
                                <option value="Pertamax" {{ old('fuel_type') == 'Pertamax' ? 'selected' : '' }}>Pertamax</option>
                                <option value="Pertamax Turbo" {{ old('fuel_type') == 'Pertamax Turbo' ? 'selected' : '' }}>Pertamax Turbo</option>
                                <option value="BioSolar" {{ old('fuel_type') == 'BioSolar' ? 'selected' : '' }}>BioSolar</option>
                                <option value="PertaminaDex" {{ old('fuel_type') == 'PertaminaDex' ? 'selected' : '' }}>PertaminaDex</option>
                            </select>
                            @error('fuel_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price per Liter (IDR)</label>
                            <input type="number" name="price_per_liter" value="{{ old('price_per_liter') }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="e.g., 10000">
                            @error('price_per_liter') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="e.g., Pertamax Mangga Dua">
                            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <input type="text" name="notes" value="{{ old('notes') }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Optional notes">
                            @error('notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Attachments (Photos/Receipts)</label>
                            <div class="flex items-center gap-4">
                                <label for="file-upload-create" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Choose Files
                                </label>
                                <input id="file-upload-create" name="attachments[]" type="file" class="hidden" multiple accept="image/jpeg,image/png,image/gif,application/pdf">
                                <span class="text-sm text-gray-500">or drag and drop (PNG, JPG, PDF, max 5MB)</span>
                            </div>
                            <div id="file-list-create" class="mt-2 space-y-1"></div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('fuels.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg mr-3">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.getElementById('file-upload-create').addEventListener('change', function(e) {
    const fileList = document.getElementById('file-list-create');
    fileList.innerHTML = '';
    for (let i = 0; i < this.files.length; i++) {
        const file = this.files[i];
        const div = document.createElement('div');
        div.className = 'flex items-center justify-between bg-gray-100 px-3 py-2 rounded text-sm';
        div.innerHTML = '<span>' + file.name + '</span><span class="text-gray-500">' + (file.size / 1024).toFixed(1) + ' KB</span>';
        fileList.appendChild(div);
    }
});

document.getElementById('vehicle_id').addEventListener('change', function() {
    window.location.href = '{{ route("fuels.create") }}?vehicle_id=' + this.value;
});
</script>