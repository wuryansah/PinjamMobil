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
            <?php echo e(__('Request Details')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Request Information</h3>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Request ID</dt>
                                <dd class="font-medium">#<?php echo e($request->id); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Borrower</dt>
                                <dd class="font-medium"><?php echo e($request->borrower->name ?? '-'); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Department</dt>
                                <dd class="font-medium"><?php echo e($request->borrower->department ?? '-'); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Destination</dt>
                                <dd class="font-medium"><?php echo e($request->destination); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Purpose</dt>
                                <dd class="font-medium"><?php echo e($request->purpose); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Start Date/Time</dt>
                                <dd class="font-medium"><?php echo e($request->start_datetime->format('d M Y H:i')); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">End Date/Time</dt>
                                <dd class="font-medium"><?php echo e($request->end_datetime->format('d M Y H:i')); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Status</dt>
                                <dd>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php if($request->status === 'pending' || $request->status === 'driver_cancelled'): ?> bg-yellow-100 text-yellow-800
                                        <?php else: ?> bg-<?php echo e($request->status_badge); ?>-100 text-<?php echo e($request->status_badge); ?>-800
                                        <?php endif; ?>">
                                        <?php echo e(str_replace(['_', ' '], ' ', ucwords(str_replace('_', ' ', $request->status)))); ?>

                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Vehicle Assignment</h3>
                        <?php if($request->vehicle): ?>
                        <dl class="space-y-3">
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Vehicle</dt>
                                <dd class="font-medium"><?php echo e($request->vehicle->name); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Plate Number</dt>
                                <dd class="font-medium font-mono"><?php echo e($request->vehicle->plate_number); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Type</dt>
                                <dd class="font-medium capitalize"><?php echo e($request->vehicle->type); ?></dd>
                            </div>
                            <?php if($request->driver): ?>
                            <div class="flex justify-between">
                                <dt class="text-gray-500">Driver</dt>
                                <dd class="font-medium"><?php echo e($request->driver->name); ?></dd>
                            </div>
                            <?php endif; ?>
                        </dl>
                        <?php else: ?>
                        <p class="text-gray-500">No vehicle assigned yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if($request->manager_notes || $request->admin_notes): ?>
                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-700 mb-2">Notes</h4>
                    <?php if($request->manager_notes): ?>
                        <p class="text-sm text-gray-600"><span class="font-medium">Manager:</span> <?php echo e($request->manager_notes); ?></p>
                    <?php endif; ?>
                    <?php if($request->admin_notes): ?>
                    <div>
                        <span class="text-gray-500">Admin Notes:</span>
                        <p class="font-medium"><?php echo e($request->admin_notes); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if($request->usageRecord): ?>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Usage Record</h3>
                    <dl class="space-y-3">
                        <?php if($request->usageRecord->start_time): ?>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Start Time</dt>
                            <dd class="font-medium"><?php echo e(\Carbon\Carbon::parse($request->usageRecord->start_time)->format('d M Y H:i')); ?></dd>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Start Kilometer</dt>
                            <dd class="font-medium"><?php echo e($request->usageRecord->start_km ?? '-'); ?> km</dd>
                        </div>
                        <?php if($request->usageRecord->end_time): ?>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">End Time</dt>
                            <dd class="font-medium"><?php echo e(\Carbon\Carbon::parse($request->usageRecord->end_time)->format('d M Y H:i')); ?></dd>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">End Kilometer</dt>
                            <dd class="font-medium"><?php echo e($request->usageRecord->end_km ?? '-'); ?> km</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Total Mileage</dt>
                            <dd class="font-medium">
                                <?php if($request->usageRecord->end_km && $request->usageRecord->start_km): ?>
                                    <?php echo e($request->usageRecord->end_km - $request->usageRecord->start_km); ?> km
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Fuel Used</dt>
                            <dd class="font-medium"><?php echo e($request->usageRecord->fuel_used ?? '-'); ?> L</dd>
                        </div>
                        <?php if($request->usageRecord->notes): ?>
                        <div>
                            <dt class="text-gray-500">Notes</dt>
                            <dd class="font-medium"><?php echo e($request->usageRecord->notes); ?></dd>
                        </div>
                        <?php endif; ?>
                    </dl>
                </div>
            </div>
            <?php endif; ?>

            <div class="mt-8">
                <div class="flex flex-wrap gap-3">
                    <a href="<?php echo e(route('requests.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Back
                    </a>
                    
                    <?php if(Auth::user()->role === 'employee' && $request->status === 'pending' && $request->borrower_id === Auth::id()): ?>
                    <button onclick="document.getElementById('cancelModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Cancel Request
                    </button>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->role === 'manager' && $request->status === 'pending'): ?>
                    <button onclick="document.getElementById('managerModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-gray-900 font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Review Request
                    </button>
                    <?php endif; ?>
                    
                    <?php if(Auth::user()->role === 'admin' && $request->status === 'manager_approved'): ?>
                    <button onclick="document.getElementById('adminModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-gray-900 font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Assign Vehicle
                    </button>
                    <button onclick="document.getElementById('adminRejectModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reject Request
                    </button>
                    <?php endif; ?>

                    <?php if(Auth::user()->role === 'admin' && $request->status === 'admin_approved'): ?>
                    <button onclick="document.getElementById('adminStartTripModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-gray-900 font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Start Trip
                    </button>
                    <?php endif; ?>

                    <?php if(Auth::user()->role === 'admin' && $request->status === 'in_progress'): ?>
                    <button onclick="document.getElementById('adminEndTripModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-gray-900 font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        End Trip
                    </button>
                    <?php endif; ?>
                    
                    <?php if(Auth::check() && Auth::user()->role === 'driver' && Auth::id() == $request->driver_id): ?>
                        <?php if($request->usageRecord && $request->usageRecord->start_km && $request->status === 'in_progress'): ?>
                        <button type="button" onclick="document.getElementById('completeModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-gray-900 font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            End Trip
                        </button>
                        <?php elseif($request->status === 'admin_approved' && (!$request->usageRecord || !$request->usageRecord->start_km)): ?>
                        <button type="button" onclick="document.getElementById('startTripModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-gray-900 font-medium rounded-lg shadow-md transition-all hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Start Trip
                        </button>
                        <?php endif; ?>
                        
                        <?php if(in_array($request->status, ['admin_approved', 'in_progress'])): ?>
                        <button type="button" onclick="document.getElementById('cancelTripModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Cancel Trip
                        </button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if(Auth::user()->role === 'manager' && $request->status === 'pending'): ?>
    <div id="managerModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Manager Approval</h3>
            <form method="POST" action="<?php echo e(route('requests.manager-approve', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Notes (Optional)</label>
                    <textarea name="notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('managerModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">Cancel</button>
                    <button type="submit" name="action" value="reject" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Reject</button>
                    <button type="submit" name="action" value="approve" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Approve</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::user()->role === 'admin' && $request->status === 'manager_approved'): ?>
    <div id="adminRejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4 text-red-600">Reject Request</h3>
            <form method="POST" action="<?php echo e(route('requests.admin-assign', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="vehicle_id" value="1"> <!-- Dummy but required by validation -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Reason for Rejection</label>
                    <textarea name="notes" rows="3" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please provide a reason..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('adminRejectModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">Back</button>
                    <button type="submit" name="action" value="reject" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">Reject Request</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::user()->role === 'admin' && $request->status === 'manager_approved'): ?>
    <div id="adminModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Admin Assignment</h3>
            <form method="POST" action="<?php echo e(route('requests.admin-assign', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Select Vehicle</label>
                    <select name="vehicle_id" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select Vehicle</option>
                        <?php $__currentLoopData = \App\Models\Vehicle::where('availability', 'available')->where('condition', 'good')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->name); ?> (<?php echo e($vehicle->plate_number); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Assign Driver (Optional)</label>
                    <select name="driver_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">No Driver</option>
                        <?php $__currentLoopData = \App\Models\User::where('role', 'driver')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($driver->id); ?>"><?php echo e($driver->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Notes (Optional)</label>
                    <textarea name="notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('adminModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">Cancel</button>
                    <button type="submit" name="action" value="reject" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Reject</button>
                    <button type="submit" name="action" value="approve" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Approve & Assign</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::user()->role === 'admin' && $request->status === 'admin_approved'): ?>
    <div id="adminStartTripModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Admin Start Trip</h3>
            <form method="POST" action="<?php echo e(route('requests.admin-start-trip', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Start Kilometer</label>
                    <input type="number" name="start_km" step="0.01" value="<?php echo e($request->vehicle?->current_kilometer); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 15000.00">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Start Time</label>
                    <input type="datetime-local" name="start_time" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('adminStartTripModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors mr-3">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Start Trip</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::user()->role === 'admin' && $request->status === 'in_progress'): ?>
    <div id="adminEndTripModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Admin End Trip</h3>
            <form method="POST" action="<?php echo e(route('requests.admin-end-trip', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">End Kilometer</label>
                    <input type="number" name="end_km" step="0.01" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 15250.00">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">End Time</label>
                    <input type="datetime-local" name="end_time" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Fuel Used (Liters) - Optional</label>
                    <input type="number" name="fuel_used" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 25.50">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Notes - Optional</label>
                    <textarea name="notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Any issues or notes"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('adminEndTripModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors mr-3">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Complete Trip</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::check() && Auth::user()->role === 'driver' && Auth::id() == $request->driver_id && $request->status === 'admin_approved' && !$request->usageRecord): ?>
    <div id="startTripModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Start Trip - Record Start KM</h3>
            <form method="POST" action="<?php echo e(route('requests.update-start-km', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Current Kilometer Reading</label>
                    <input type="number" name="start_km" step="0.01" value="<?php echo e($request->vehicle?->current_kilometer); ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 15000.00">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Start Trip</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::check() && Auth::user()->role === 'driver' && Auth::id() == $request->driver_id && $request->status === 'in_progress'): ?>
    <div id="completeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4">Complete Trip - Record End KM</h3>
            <form method="POST" action="<?php echo e(route('requests.complete', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">End Kilometer Reading</label>
                    <input type="number" name="end_km" step="0.01" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 15250.00">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Fuel Used (Liters) - Optional</label>
                    <input type="number" name="fuel_used" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g., 25.50">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Notes / Issues</label>
                    <textarea name="notes" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Any issues or notes about the trip"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-gray-900 font-semibold rounded-lg shadow-md transition-all">Complete Trip</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <?php if(Auth::check() && Auth::user()->role === 'driver' && Auth::id() == $request->driver_id && in_array($request->status, ['admin_approved', 'in_progress'])): ?>
    <div id="cancelTripModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-semibold mb-4 text-red-600">Cancel Trip</h3>
            <form method="POST" action="<?php echo e(route('requests.cancel', $request->id)); ?>">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Reason for Cancellation</label>
                    <textarea name="cancel_reason" rows="3" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Please provide a reason..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('cancelTripModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">Back</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition-colors">Cancel Trip</button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\PinjamMobil\PinjamMobil - Copy\resources\views/requests/show.blade.php ENDPATH**/ ?>