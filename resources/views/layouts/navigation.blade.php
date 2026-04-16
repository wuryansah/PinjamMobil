<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <img src="{{ asset ("build\assets\Pinjam_Mobil.png")}}" style="width: 50px; height: auto;" alt="Mangga 2 Square" class="w-full h-full rounded-lg"> <span class="font-bold text-xl text-gray-500">PinjamMobil</span>
                    </a>
                </div>

                <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Dashboard
                    </a>
                    
                    @php $userRole = Auth::user()?->role; @endphp
                    @if($userRole === 'admin')
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('vehicles.*') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Vehicles
                    </a>
                    @endif
                    
                    @if($userRole === 'admin' || $userRole === 'driver')
                    <a href="{{ route('fuels.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('fuels.*') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Fuel
                    </a>
                    @endif
                    
                    @if($userRole === 'admin')
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('users.*') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Users
                    </a>
                    <a href="{{ route('departments.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->routeIs('departments.*') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Departments
                    </a>
                    @endif
                    
                    <a href="{{ route('requests.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->is('kendaraan*') || request()->is('requests*') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Requests
                    </a>
                    
                    @if($userRole === 'admin')
                    <a href="{{ route('reports') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->is('reports*') ? 'text-orange-500 border-b-2 border-orange-500' : 'text-gray-500 hover:text-gray-700' }}">
                        Reports
                    </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center sm:gap-4">
                @php
                    $unreadCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                <a href="{{ route('notifications.index') }}" class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $unreadCount }}
                    </span>
                </a>
                @endif

                <div class="flex items-center gap-3 ml-4 pl-4 border-l border-gray-200">
                    <div class="text-right">
                        <div class="text-sm font-medium text-gray-900">{{ Auth::user()?->name }}</div>
                        <div class="text-xs text-gray-500">{{ ucfirst(Auth::user()?->role) }}</div>
                    </div>
                    <button class="bg-gray-100 rounded-full p-1 hover:bg-gray-200" data-dropdown-toggle="userMenu">
                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center">
                            <span class="text-sm font-medium text-orange-600">{{ substr(Auth::user()?->name ?? 'U', 0, 1) }}</span>
                        </div>
                    </button>
                </div>

                <div id="userMenu" class="hidden z-50 my-4 text-base list-none bg-white rounded-lg shadow-lg border border-gray-200">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="font-medium text-gray-900">{{ Auth::user()?->name }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()?->email }}</div>
                    </div>
                    <ul class="py-2">
                        <li>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100" data-dropdown-toggle="mobileMenu">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobileMenu" class="hidden sm:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                Dashboard
            </a>
            
            @if(Auth::user()?->role === 'admin')
            <a href="{{ route('vehicles.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('vehicles.*') ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                Vehicles
            </a>
            @endif
            
            <a href="{{ route('requests.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->is('kendaraan*') || request()->is('requests*') ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                Requests
            </a>
            
            @if(Auth::user()?->role === 'admin')
            <a href="{{ route('reports') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->is('reports*') ? 'border-orange-500 bg-orange-50 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50' }}">
                Reports
            </a>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-900">{{ Auth::user()?->name }}</div>
                <div class="text-sm text-gray-500">{{ Auth::user()?->role }}</div>
            </div>
        </div>
    </div>
</nav>