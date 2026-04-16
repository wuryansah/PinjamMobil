<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Fuel Record') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <form method="POST" action="/fuels-update/{{ $fuel->id }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle</label>
                            <select name="vehicle_id" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Vehicle</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $fuel->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->name }} ({{ $vehicle->plate_number }})</option>
                                @endforeach
                            </select>
                            @error('vehicle_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Refuel Date</label>
                            <input type="date" name="refuel_date" value="{{ old('refuel_date', $fuel && $fuel->refuel_date ? $fuel->refuel_date->format('Y-m-d') : '') }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('refuel_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kilometer</label>
                            <input type="number" name="kilometer" step="0.01" value="{{ old('kilometer', $fuel->kilometer) }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('kilometer') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fuel Amount (Liters)</label>
                            <input type="number" name="fuel_amount" step="0.01" value="{{ old('fuel_amount', $fuel->fuel_amount) }}" required class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('fuel_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fuel Type</label>
                            <select name="fuel_type" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Fuel Type</option>
                                <option value="Pertalite" {{ old('fuel_type', $fuel->fuel_type) == 'Pertalite' ? 'selected' : '' }}>Pertalite</option>
                                <option value="Pertamax" {{ old('fuel_type', $fuel->fuel_type) == 'Pertamax' ? 'selected' : '' }}>Pertamax</option>
                                <option value="Pertamax Turbo" {{ old('fuel_type', $fuel->fuel_type) == 'Pertamax Turbo' ? 'selected' : '' }}>Pertamax Turbo</option>
                                <option value="BioSolar" {{ old('fuel_type', $fuel->fuel_type) == 'BioSolar' ? 'selected' : '' }}>BioSolar</option>
                                <option value="PertaminaDex" {{ old('fuel_type', $fuel->fuel_type) == 'PertaminaDex' ? 'selected' : '' }}>PertaminaDex</option>
                            </select>
                            @error('fuel_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price per Liter (IDR)</label>
                            <input type="number" name="price_per_liter" value="{{ old('price_per_liter', $fuel->price_per_liter) }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('price_per_liter') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="location" value="{{ old('location', $fuel->location) }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <input type="text" name="notes" value="{{ old('notes', $fuel->notes) }}" class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            @error('notes') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Attachments (Photos/Receipts)</label>
                            @if($fuel->attachments->count() > 0)
                                <div class="mb-3 grid grid-cols-2 gap-2">
                                    @foreach($fuel->attachments as $attachment)
                                        <div class="relative border rounded p-2">
                                            @if(str_starts_with($attachment->file_type, 'image/'))
                                                <img src="{{ asset('storage/' . $attachment->file_path) }}" class="w-full h-20 object-cover rounded">
                                            @else
                                                <div class="flex items-center justify-center h-20 bg-gray-100 rounded">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                            @endif
                                            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="block text-xs text-orange-500 hover:text-orange-600 mt-1 truncate">{{ $attachment->file_name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="flex items-center gap-4">
                                <label for="file-upload-edit" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Add More Files
                                </label>
                                <input id="file-upload-edit" name="attachments[]" type="file" class="hidden" multiple accept="image/jpeg,image/png,image/gif,application/pdf">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('fuels.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg mr-3">Cancel</a>
                        <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>