<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vehicle Requests') }}
            </h2>
            @if(Auth::user()->role === 'employee' || Auth::user()->role === 'manager')
            <a href="{{ route('requests.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all hover:shadow-lg">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                New Request
            </a>
            @endif
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
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search destination or borrower..." class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <select name="sort" onchange="this.form.submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="latest" {{ request('sort') === 'latest' || !request('sort') ? 'selected' : '' }}>Latest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        </select>
                        <a href="{{ route('requests.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                                <th class="px-6 py-3">Borrower</th>
                                @endif
                                <th class="px-6 py-3">Destination</th>
                                <th class="px-6 py-3">Start</th>
                                <th class="px-6 py-3">End</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($requests as $req)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">#{{ $req->id }}</td>
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'manager')
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-orange-600">{{ substr($req->borrower->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                        <span>{{ $req->borrower->name ?? '-' }}</span>
                                    </div>
                                </td>
                                @endif
                                <td class="px-6 py-4 max-w-xs truncate">{{ $req->destination }}</td>
                                <td class="px-6 py-4">{{ $req->start_datetime->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4">{{ $req->end_datetime->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    @if($req->vehicle)
                                        <span class="font-medium">{{ $req->vehicle->name }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                        @if($req->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($req->status === 'driver_cancelled' || $req->status === 'admin_rejected' || $req->status === 'manager_rejected') bg-red-100 text-red-800
                                        @elseif($req->status_badge === 'success') bg-green-100 text-green-800
                                        @elseif($req->status_badge === 'warning') bg-orange-100 text-orange-800
                                        @elseif($req->status_badge === 'info') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        @if(Auth::user()->role === 'driver' && $req->status === 'admin_approved')
                                            Ready to Start
                                        @else
                                            {{ str_replace(['_', ' '], ' ', ucwords(str_replace('_', ' ', $req->status))) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('requests.show', $req->id) }}" class="p-1.5 text-green-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all" title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>

                                        @if(Auth::user()->role === 'admin' || (Auth::id() == $req->borrower_id && $req->status === 'pending'))
                                        <a href="{{ route('requests.edit', $req->id) }}" class="p-1.5 text-yellow-500 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all" title="Edit Request">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>

                                        <form action="{{ route('requests.destroy', $req->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this request?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Request">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                        @endif

                                        @if(Auth::user()->role === 'driver' && Auth::id() == $req->driver_id)
                                            @if($req->status === 'admin_approved')
                                                <form action="{{ route('requests.start-trip-simple', $req->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-1.5 text-emerald-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Start Trip">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    </button>
                                                </form>
                                            @elseif($req->status === 'in_progress')
                                                <form action="{{ route('requests.end-trip-simple', $req->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-1.5 text-purple-500 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all" title="End Trip">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p>No requests found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $requests->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>