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
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Fuel Records')); ?>

            </h2>
            <a href="<?php echo e(route('fuels.create')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all hover:shadow-lg">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Add Fuel Record
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <?php if(session('success')): ?>
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700" role="alert">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span><?php echo e(session('success')); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mb-4 flex flex-wrap items-center gap-4">
                <form method="GET" action="<?php echo e(route('fuels.index')); ?>" class="flex items-center gap-2">
                    <select name="vehicle_id" onchange="this.form.submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">All Vehicles</option>
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle->id); ?>" <?php echo e($vehicleId == $vehicle->id ? 'selected' : ''); ?>><?php echo e($vehicle->name); ?> (<?php echo e($vehicle->plate_number); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
                <form method="GET" action="<?php echo e(route('fuels.index')); ?>" class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search location or vehicle..." class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </form>
                <form method="GET">
                    <select name="sort" onchange="this.closest('form').submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="latest" <?php echo e(request('sort') === 'latest' || !request('sort') ? 'selected' : ''); ?>>Latest First</option>
                        <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>Oldest First</option>
                    </select>
                </form>
                <a href="<?php echo e(route('fuels.index')); ?>" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Fuel Type</th>
                                <th class="px-6 py-3">End KM</th>
                                <th class="px-6 py-3">Fuel (L)</th>
                                <th class="px-6 py-3">Price/L</th>
                                <th class="px-6 py-3">Total Cost</th>
                                <th class="px-6 py-3">Distance / km/L</th>
                                <th class="px-6 py-3">Location</th>
                                <th class="px-6 py-3">Files</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $fuelRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4"><?php echo e($record->refuel_date->format('d M Y')); ?></td>
                                <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($record->vehicle->name); ?></td>
                                <td class="px-6 py-4"><?php echo e($record->fuel_type ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e(number_format($record->kilometer, 2)); ?> km</td>
                                <td class="px-6 py-4"><?php echo e(number_format($record->fuel_amount, 2)); ?></td>
                                <td class="px-6 py-4"><?php echo e($record->price_per_liter ? 'Rp ' . number_format($record->price_per_liter, 0, ',', '.') : '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($record->calculated_fuel_cost ? 'Rp ' . number_format($record->calculated_fuel_cost, 0, ',', '.') : '-'); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($record->distance_traveled || $record->fuel_consumption): ?>
                                        <div class="flex flex-col gap-1">
                                            <?php if($record->distance_traveled): ?>
                                                <span><?php echo e(number_format($record->distance_traveled, 2)); ?> km</span>
                                            <?php endif; ?>
                                            <?php if($record->fuel_consumption): ?>
                                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <?php echo e(number_format($record->fuel_consumption, 2)); ?> km/L
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-gray-600"><?php echo e($record->location ?? '-'); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($record->attachments->count() > 0): ?>
                                        <button type="button" onclick="document.getElementById('viewFiles<?php echo e($record->id); ?>').classList.remove('hidden')" class="text-xs bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded">
                                            <?php echo e($record->attachments->count()); ?> files
                                        </button>
                                        <div id="viewFiles<?php echo e($record->id); ?>" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h3 class="text-lg font-semibold">Attachments</h3>
                                                    <button onclick="document.getElementById('viewFiles<?php echo e($record->id); ?>').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">&times;</button>
                                                </div>
                                                <div class="space-y-2 max-h-64 overflow-y-auto">
                                                    <?php $__currentLoopData = $record->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="flex items-center gap-2 p-2 border rounded">
                                                            <?php if(str_starts_with($attachment->file_type, 'image/')): ?>
                                                                <img src="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" class="w-12 h-12 object-cover rounded">
                                                            <?php else: ?>
                                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(asset('storage/' . $attachment->file_path)); ?>" target="_blank" class="text-orange-500 hover:text-orange-600 text-sm truncate"><?php echo e($attachment->file_name); ?></a>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="<?php echo e(route('fuels.edit', $record->id)); ?>" class="text-orange-500 hover:text-orange-600 font-medium">Edit</a>
                                        <form method="POST" action="/fuels-destroy/<?php echo e($record->id); ?>" onsubmit="return confirm('Are you sure?')">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="text-red-500 hover:text-red-600 font-medium">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center text-gray-500">No fuel records found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($fuelRecords->appends(request()->query())->links()); ?>

                </div>
            </div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\PinjamMobil\PinjamMobil - Copy\resources\views/fuels/index.blade.php ENDPATH**/ ?>