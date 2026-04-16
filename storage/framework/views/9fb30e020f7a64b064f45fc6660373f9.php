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
                <?php echo e(__('Vehicle Requests')); ?>

            </h2>
            <?php if(Auth::user()->role === 'employee' || Auth::user()->role === 'manager'): ?>
            <a href="<?php echo e(route('requests.create')); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-orange-500 hover:from-blue-600 hover:to-orange-600 text-gray-900 font-semibold rounded-lg shadow-md transition-all hover:shadow-lg">
                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                New Request
            </a>
            <?php endif; ?>
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

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <form method="GET" class="flex flex-wrap gap-4 items-center">
                        <div class="flex-1 min-w-[200px]">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search destination or borrower..." class="w-full rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        </div>
                        <select name="sort" onchange="this.form.submit()" class="rounded-lg border-gray-300 border px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <option value="latest" <?php echo e(request('sort') === 'latest' || !request('sort') ? 'selected' : ''); ?>>Latest First</option>
                            <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>Oldest First</option>
                        </select>
                        <a href="<?php echo e(route('requests.index')); ?>" class="px-4 py-2 text-gray-600 hover:text-gray-800">Reset</a>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 font-medium">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'manager'): ?>
                                <th class="px-6 py-3">Borrower</th>
                                <?php endif; ?>
                                <th class="px-6 py-3">Destination</th>
                                <th class="px-6 py-3">Start</th>
                                <th class="px-6 py-3">End</th>
                                <th class="px-6 py-3">Vehicle</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">#<?php echo e($req->id); ?></td>
                                <?php if(Auth::user()->role === 'admin' || Auth::user()->role === 'manager'): ?>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-orange-600"><?php echo e(substr($req->borrower->name ?? 'U', 0, 1)); ?></span>
                                        </div>
                                        <span><?php echo e($req->borrower->name ?? '-'); ?></span>
                                    </div>
                                </td>
                                <?php endif; ?>
                                <td class="px-6 py-4 max-w-xs truncate"><?php echo e($req->destination); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->start_datetime->format('d M Y H:i')); ?></td>
                                <td class="px-6 py-4"><?php echo e($req->end_datetime->format('d M Y H:i')); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($req->vehicle): ?>
                                        <span class="font-medium"><?php echo e($req->vehicle->name); ?></span>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                        <?php if($req->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                        <?php elseif($req->status === 'driver_cancelled' || $req->status === 'admin_rejected' || $req->status === 'manager_rejected'): ?> bg-red-100 text-red-800
                                        <?php elseif($req->status_badge === 'success'): ?> bg-green-100 text-green-800
                                        <?php elseif($req->status_badge === 'warning'): ?> bg-orange-100 text-orange-800
                                        <?php elseif($req->status_badge === 'info'): ?> bg-blue-100 text-blue-800
                                        <?php else: ?> bg-gray-100 text-gray-800
                                        <?php endif; ?>">
                                        <?php if(Auth::user()->role === 'driver' && $req->status === 'admin_approved'): ?>
                                            Ready to Start
                                        <?php else: ?>
                                            <?php echo e(str_replace(['_', ' '], ' ', ucwords(str_replace('_', ' ', $req->status)))); ?>

                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="<?php echo e(route('requests.show', $req->id)); ?>" class="p-1.5 text-green-500 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all" title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>

                                        <?php if(Auth::user()->role === 'admin' || (Auth::id() == $req->borrower_id && $req->status === 'pending')): ?>
                                        <a href="<?php echo e(route('requests.edit', $req->id)); ?>" class="p-1.5 text-yellow-500 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all" title="Edit Request">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>

                                        <form action="<?php echo e(route('requests.destroy', $req->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this request?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="p-1.5 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Delete Request">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                        <?php endif; ?>

                                        <?php if(Auth::user()->role === 'driver' && Auth::id() == $req->driver_id): ?>
                                            <?php if($req->status === 'admin_approved'): ?>
                                                <form action="<?php echo e(route('requests.start-trip-simple', $req->id)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="p-1.5 text-emerald-500 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Start Trip">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    </button>
                                                </form>
                                            <?php elseif($req->status === 'in_progress'): ?>
                                                <form action="<?php echo e(route('requests.end-trip-simple', $req->id)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="p-1.5 text-purple-500 hover:text-purple-600 hover:bg-purple-50 rounded-lg transition-all" title="End Trip">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p>No requests found.</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($requests->appends(request()->query())->links()); ?>

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
<?php endif; ?><?php /**PATH C:\laragon\www\PinjamMobil\PinjamMobil - Copy\resources\views/requests/index.blade.php ENDPATH**/ ?>