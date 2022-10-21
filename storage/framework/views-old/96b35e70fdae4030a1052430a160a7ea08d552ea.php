<!-- <?php if(session()->has('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo e(session()->get('success')); ?>

    </div>
<?php endif; ?>


<?php if(true): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($error); ?><br/>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?> -->


<?php if($message = Session::get('success')): ?>
<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong>
    - <?php echo e($message); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($message = Session::get('image')): ?>
<div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-notification-off-line label-icon"></i><strong>Success</strong>
    - S3 bucket Path: <?php echo e($message); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($message = Session::get('error')): ?>
<div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>Error</strong>
    - <?php echo e($message); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($message = Session::get('warning')): ?>
<div class="alert alert-warning alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-alert-line label-icon"></i><strong>Warning</strong> -
    <?php echo e($message); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($message = Session::get('info')): ?>
<div class="alert alert-info alert-dismissible alert-label-icon label-arrow fade show" role="alert">
    <i class="ri-airplay-line label-icon"></i><strong>Info</strong> -
    <?php echo e($message); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    Check the following errors :(
</div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\tournament-setup\resources\views/components/flash_message.blade.php ENDPATH**/ ?>