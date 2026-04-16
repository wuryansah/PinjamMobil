<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Vehicle Request') }} #{{ $vehicleRequest->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('requests.update', $vehicleRequest->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Destination</label>
                            <input type="text" name="destination" value="{{ old('destination', $vehicleRequest->destination) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('destination') border-red-500 @enderror">
                            @error('destination')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Purpose of Use</label>
                            <textarea name="purpose" required rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('purpose') border-red-500 @enderror">{{ old('purpose', $vehicleRequest->purpose) }}</textarea>
                            @error('purpose')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">Start Date & Time</label>
                                <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime', $vehicleRequest->start_datetime->format('Y-m-d\TH:i')) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('start_datetime') border-red-500 @enderror">
                                @error('start_datetime')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">End Date & Time</label>
                                <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime', $vehicleRequest->end_datetime->format('Y-m-d\TH:i')) }}" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('end_datetime') border-red-500 @enderror">
                                @error('end_datetime')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <a href="{{ route('requests.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>