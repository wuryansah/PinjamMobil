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
            <?php echo e(__('Notifications')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600"><?php echo e($notifications->count()); ?> notification(s)</p>
                <?php if($notifications->where('is_read', false)->count() > 0): ?>
                <form method="POST" action="<?php echo e(route('notifications.read-all')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Mark all as read</button>
                </form>
                <?php endif; ?>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-start gap-4 p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors <?php echo e($notification->is_read ? 'bg-white' : 'bg-blue-50'); ?>">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center <?php echo e($notification->is_read ? 'bg-gray-100' : 'bg-blue-100'); ?>">
                                <?php if($notification->type === 'request_approved' || $notification->type === 'request_approved'): ?>
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <?php elseif($notification->type === 'request_rejected' || $notification->type === 'request_rejected'): ?>
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <?php else: ?>
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <?php if($notification->request_id && in_array($notification->type, ['request_created', 'request_approved', 'request_rejected', 'vehicle_assigned', 'trip_started', 'trip_completed', 'trip_cancelled', 'trip_assigned'])): ?>
                            <a href="<?php echo e(route('notifications.click', $notification->id)); ?>" class="block hover:bg-gray-100 -m-4 p-4 rounded">
                                <p class="font-medium text-gray-900"><?php echo e($notification->title); ?></p>
                                <p class="text-sm text-gray-600 mt-1"><?php echo e($notification->message); ?></p>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('notifications.click', $notification->id)); ?>" class="block hover:bg-gray-100 -m-4 p-4 rounded">
                                <p class="font-medium text-gray-900"><?php echo e($notification->title); ?></p>
                                <p class="text-sm text-gray-600 mt-1"><?php echo e($notification->message); ?></p>
                            </a>
                            <?php endif; ?>
                            <p class="text-xs text-gray-400 mt-2"><?php echo e($notification->created_at->diffForHumans()); ?></p>
                        </div>
                        <?php if(!$notification->is_read): ?>
                        <div class="flex-shrink-0">
                            <form method="POST" action="<?php echo e(route('notifications.read', $notification->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium px-2 py-1 rounded hover:bg-blue-50">Mark read</button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <p class="text-gray-500">No notifications</p>
                    </div>
                    <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\laragon\www\PinjamMobil\PinjamMobil - Copy\resources\views/notifications/index.blade.php ENDPATH**/ ?>