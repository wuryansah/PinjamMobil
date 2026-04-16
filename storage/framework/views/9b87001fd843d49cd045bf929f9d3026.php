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
            <?php echo e(__('Vehicle Usage Report')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex gap-4">
                    <a href="<?php echo e(route('reports.report')); ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        On Trip History PDF
                    </a>
                    <a href="<?php echo e(route('reports.fuel')); ?>" class="px-4 py-2 bg-blue-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        To Fuel Report PDF
                    </a>
                </div>
                <a href="<?php echo e(route('reports')); ?>" class="px-4 py-2 text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Back
                </a>
            </div>

            <form method="GET" action="<?php echo e(route('reports.report')); ?>" class="mb-6 flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vehicle</label>
                    <select name="vehicle_id" class="border rounded px-3 py-2">
                        <option value="">All Vehicles</option>
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle->id); ?>" <?php echo e(request('vehicle_id') == $vehicle->id ? 'selected' : ''); ?>>
                                <?php echo e($vehicle->name); ?> (<?php echo e($vehicle->plate_number); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Filter</button>
                    <a href="<?php echo e(route('reports.report')); ?>" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
                    <button type="submit" name="export" value="pdf" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Export PDF</button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Trips</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($requests->count()); ?></p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Mileage</p>
                    <p class="text-3xl font-bold text-blue-600 mt-1"><?php echo e(number_format($totalMileage, 2)); ?> km</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Fuel</p>
                    <p class="text-3xl font-bold text-teal-600 mt-1"><?php echo e(number_format($totalFuel, 2)); ?> L</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Cost</p>
                    <p class="text-3xl font-bold text-purple-600 mt-1">Rp <?php echo e(number_format($totalCost, 0, ',', '.')); ?></p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Date</th>
                                <th class="px-6 py-3">Start Time</th>
                                <th class="px-6 py-3">End Time</th>
                                <th class="px-6 py-3">Employee</th>
                                <th class="px-6 py-3">Department</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Destination</th>
                                <th class="px-6 py-3">Start KM</th>
                                <th class="px-6 py-3">End KM</th>
                                <th class="px-6 py-3">Distance</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">#<?php echo e($req->id); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->start_datetime->format('d M Y')); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->usageRecord && $req->usageRecord->start_time ? \Carbon\Carbon::parse($req->usageRecord->start_time)->format('H:i') : '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->usageRecord && $req->usageRecord->end_time ? \Carbon\Carbon::parse($req->usageRecord->end_time)->format('H:i') : '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->borrower->name ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->borrower->department ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->vehicle->name ?? '-'); ?></td>
                                <td class="px-6 py-4 max-w-xs truncate"><?php echo e($req->destination); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->usageRecord ? number_format($req->usageRecord->start_km, 2) : '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->usageRecord ? number_format($req->usageRecord->end_km, 2) : '-'); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($req->usageRecord && $req->usageRecord->end_km && $req->usageRecord->start_km): ?>
                                        <?php echo e(number_format($req->usageRecord->end_km - $req->usageRecord->start_km, 2)); ?> km
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-500">No completed trips found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?><?php /**PATH C:\laragon\www\PinjamMobil\PinjamMobil - Copy\resources\views/reports/trip-history.blade.php ENDPATH**/ ?>