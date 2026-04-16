<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php
                $unreadNotifications = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
                $pendingRequests = $stats['pending_requests'] ?? 0;
            ?>

            <?php if(Auth::user()->role === 'manager' || Auth::user()->role === 'admin'): ?>
            <div class="mb-6 p-4 rounded-lg bg-gray-50 border border-gray-200" role="alert">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        <span class="font-medium text-gray-700">
                            <?php if($unreadNotifications > 0): ?>
                                You have <?php echo e($unreadNotifications); ?> unread notification<?php echo e($unreadNotifications > 1 ? 's' : ''); ?>

                            <?php else: ?>
                                No new notifications
                            <?php endif; ?>
                        </span>
                    </div>
                    <a href="<?php echo e(route('notifications.index')); ?>" class="text-sm font-medium text-orange-500 hover:text-orange-600">View all notifications →</a>
                </div>
            </div>
            <?php elseif($unreadNotifications > 0): ?>
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700" role="alert">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span class="font-medium">You have <?php echo e($unreadNotifications); ?> unread notification<?php echo e($unreadNotifications > 1 ? 's' : ''); ?></span>
                    <a href="<?php echo e(route('notifications.index')); ?>" class="ml-auto text-sm font-medium text-red-600 hover:text-red-800">View all →</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700" role="alert">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span><?php echo e(session('success')); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <?php if(Auth::user()->role === 'admin'): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Vehicles</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($stats['total_vehicles']); ?></p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cars Available</p>
                            <p class="text-3xl font-bold text-green-600 mt-1"><?php echo e($stats['available_vehicles']); ?></p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Cars In Use</p>
                            <p class="text-3xl font-bold text-blue-600 mt-1"><?php echo e($stats['vehicles_in_use']); ?></p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Avg Fuel Consumption</p>
                            <p class="text-3xl font-bold text-teal-600 mt-1"><?php echo e($stats['avg_fuel_consumption']); ?> <span class="text-lg">km/L</span></p>
                        </div>
                        <div class="p-3 bg-teal-100 rounded-lg">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Refuel (Rp)</p>
                            <p class="text-3xl font-bold text-purple-600 mt-1">Rp <?php echo e(number_format($stats['total_fuel_cost'] ?? 0, 0, ',', '.')); ?></p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Requests</p>
                            <p class="text-3xl font-bold text-orange-600 mt-1"><?php echo e($stats['pending_requests']); ?></p>
                        </div>
                        <div class="p-3 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Today's Trips</p>
                            <p class="text-3xl font-bold text-blue-600 mt-1"><?php echo e($stats['today_trips']); ?></p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Completed Trips</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($stats['completed_trips']); ?></p>
                        </div>
                        <div class="p-3 bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(Auth::user()->role === 'employee'): ?>
            <div class="mb-6">
                <a href="<?php echo e(route('requests.create')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all hover:shadow-lg">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Request Vehicle
                </a>
            </div>
            <?php endif; ?>

            <?php if(Auth::user()->role === 'admin' && count($vehicles) > 0): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Vehicle Status</h3>
                    <a href="<?php echo e(route('vehicles.index')); ?>" class="text-sm text-orange-500 hover:text-orange-600 font-medium">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Plate</th>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($vehicle->name); ?></td>
                                <td class="px-6 py-4"><span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded"><?php echo e($vehicle->plate_number); ?></span></td>
                                <td class="px-6 py-4 capitalize"><?php echo e($vehicle->type); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($vehicle->availability === 'available'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Available</span>
                                    <?php elseif($vehicle->availability === 'in_use'): ?>
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">In Use</span>
                                    <?php else: ?>
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-800">Maintenance</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Requests</h3>
                    <a href="<?php echo e(route('requests.index')); ?>" class="text-sm text-orange-500 hover:text-orange-600 font-medium">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Borrower</th>
                                <th class="px-6 py-3">Destination</th>
                                <th class="px-6 py-3">Start</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">#<?php echo e($req->id); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->borrower->name ?? '-'); ?></td>
                                <td class="px-6 py-4 max-w-xs truncate"><?php echo e($req->destination); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->start_datetime->format('d M Y H:i')); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                        <?php if($req->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                        <?php elseif($req->status === 'driver_cancelled' || $req->status === 'admin_rejected' || $req->status === 'manager_rejected'): ?> bg-red-100 text-red-800
                                        <?php elseif($req->status === 'completed'): ?> bg-green-100 text-green-800
                                        <?php elseif($req->status === 'in_progress'): ?> bg-blue-100 text-blue-800
                                        <?php elseif($req->status === 'manager_approved' || $req->status === 'admin_approved'): ?> bg-orange-100 text-orange-800
                                        <?php else: ?> bg-gray-100 text-gray-800
                                        <?php endif; ?>">
                                        <?php echo e(str_replace(['_', ' '], ' ', ucwords(str_replace('_', ' ', $req->status)))); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('requests.show', $req->id)); ?>" class="text-orange-500 hover:text-orange-600 font-medium">View</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No requests found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if(Auth::user()->role === 'manager' && isset($deptTrips)): ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mt-6">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Department Trip History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Employee</th>
                                <th class="px-6 py-3">Department</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Destination</th>
                                <th class="px-6 py-3">Start</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $deptTrips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">#<?php echo e($trip->id); ?></td>
                                <td class="px-6 py-4"><?php echo e($trip->borrower->name ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($trip->borrower->department ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($trip->vehicle->name ?? '-'); ?> (<?php echo e($trip->vehicle->plate_number ?? '-'); ?>)</td>
                                <td class="px-6 py-4 max-w-xs truncate"><?php echo e($trip->destination); ?></td>
                                <td class="px-6 py-4"><?php echo e($trip->start_datetime->format('d M Y H:i')); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                        <?php if($trip->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                        <?php elseif($trip->status === 'driver_cancelled'): ?> bg-red-100 text-red-800
                                        <?php elseif($trip->status === 'completed'): ?> bg-green-100 text-green-800
                                        <?php elseif($trip->status === 'in_progress' || $trip->status === 'manager_approved'): ?> bg-blue-100 text-blue-800
                                        <?php elseif($trip->status === 'admin_approved'): ?> bg-orange-100 text-orange-800
                                        <?php else: ?> bg-gray-100 text-gray-800
                                        <?php endif; ?>">
                                        <?php echo e(str_replace(['_', ' '], ' ', ucwords(str_replace('_', ' ', $trip->status)))); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('requests.show', $trip->id)); ?>" class="text-orange-500 hover:text-orange-600 font-medium">View</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">No trips found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\PinjamMobil\PinjamMobil - Copy\resources\views/dashboard.blade.php ENDPATH**/ ?>