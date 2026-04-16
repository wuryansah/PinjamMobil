<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">{{ $notifications->count() }} notification(s)</p>
                @if($notifications->where('is_read', false)->count() > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Mark all as read</button>
                </form>
                @endif
            </div>

            <div class="card">
                <div class="card-body p-0">
                    @forelse($notifications as $notification)
                    <div class="flex items-start gap-4 p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }}">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $notification->is_read ? 'bg-gray-100' : 'bg-blue-100' }}">
                                @if($notification->type === 'request_approved' || $notification->type === 'request_approved')
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                @elseif($notification->type === 'request_rejected' || $notification->type === 'request_rejected')
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                @else
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            @if($notification->request_id && in_array($notification->type, ['request_created', 'request_approved', 'request_rejected', 'vehicle_assigned', 'trip_started', 'trip_completed', 'trip_cancelled', 'trip_assigned']))
                            <a href="{{ route('notifications.click', $notification->id) }}" class="block hover:bg-gray-100 -m-4 p-4 rounded">
                                <p class="font-medium text-gray-900">{{ $notification->title }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                            </a>
                            @else
                            <a href="{{ route('notifications.click', $notification->id) }}" class="block hover:bg-gray-100 -m-4 p-4 rounded">
                                <p class="font-medium text-gray-900">{{ $notification->title }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                            </a>
                            @endif
                            <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                        @if(!$notification->is_read)
                        <div class="flex-shrink-0">
                            <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                @csrf
                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium px-2 py-1 rounded hover:bg-blue-50">Mark read</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <p class="text-gray-500">No notifications</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>