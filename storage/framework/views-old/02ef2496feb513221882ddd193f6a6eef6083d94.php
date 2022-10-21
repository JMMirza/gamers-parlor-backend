<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Create New Tournament</h4>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="<?php echo e(route('tournaments.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <input type="text"
                                class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?>" id="statusName"
                                name="name" placeholder="Please enter" value="<?php echo e(old('name')); ?>" required>
                            <label for="statusName" class="form-label fs-5 fs-lg-1">Name</label>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('name')): ?>
                                    <?php echo e($errors->first('name')); ?>

                                <?php else: ?>
                                    Name is required!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="published" required>
                                <option value="" <?php if(old('published') == ''): ?> <?php echo e('selected'); ?> <?php endif; ?>
                                    selected disabled>
                                    Select One
                                </option>
                                <option value="1" <?php if(old('published') == '1'): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                                    Yes
                                </option>
                                <option value="0" <?php if(old('published') == '0'): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                                    No
                                </option>
                            </select>
                            <label for="published" class="form-label fs-5 fs-lg-1">Published</label>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('published')): ?>
                                    <?php echo e($errors->first('published')); ?>

                                <?php else: ?>
                                    Published is required!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="date" name="start_date" value="<?php echo e(old('start_date')); ?>"
                                class="form-control mb-3 <?php if($errors->has('start_date')): ?> is-invalid <?php endif; ?>">
                            <label for="start_date" class="form-label">Start Date</label>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('start_date')): ?>
                                    <?php echo e($errors->first('start_date')); ?>

                                <?php else: ?>
                                    Start Date is required!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="date" name="end_date" value="<?php echo e(old('end_date')); ?>"
                                class="form-control mb-3 <?php if($errors->has('end_date')): ?> is-invalid <?php endif; ?>">
                            <label for="end_date" class="form-label">End Date</label>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('end_date')): ?>
                                    <?php echo e($errors->first('end_date')); ?>

                                <?php else: ?>
                                    End Date is required!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="number"
                                class="form-control <?php if($errors->has('number_of_request')): ?> is-invalid <?php endif; ?>"
                                id="number_of_request" name="number_of_request" placeholder="Please enter"
                                value="<?php echo e(old('number_of_request')); ?>" required>
                            <label for="number_of_request" class="form-label fs-5 fs-lg-1">Number of Request</label>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('number_of_request')): ?>
                                    <?php echo e($errors->first('number_of_request')); ?>

                                <?php else: ?>
                                    Number of Request is required!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <div class="input-group">

                                <input type="number"
                                    class="form-control <?php if($errors->has('registration_fee')): ?> is-invalid <?php endif; ?>"
                                    id="registration_fee" name="registration_fee" placeholder="Please enter"
                                    value="<?php echo e(old('registration_fee')); ?>">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">USD</span>
                                </div>
                                <label for="registration_fee" class="form-label mr-2">Registration Fee</label>
                            </div>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('registration_fee')): ?>
                                    <?php echo e($errors->first('registration_fee')); ?>

                                <?php else: ?>
                                    Registration Fee is empty or incorrect!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="status_id" required>
                                <option value="" <?php if(old('status_id') == ''): ?> <?php echo e('selected'); ?> <?php endif; ?>
                                    selected disabled>
                                    Select One
                                </option>
                                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($status->id); ?>"
                                        <?php if(old('status_id') == $status->id): ?> <?php echo e('selected'); ?> <?php endif; ?>>
                                        <?php echo e($status->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label for="status" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">
                                <?php if($errors->has('status_id')): ?>
                                    <?php echo e($errors->first('status_id')); ?>

                                <?php else: ?>
                                    PLease select any Status!
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                        <div id="snow-editor" style="height: 300px;"></div>
                        <input type="hidden" name="terms_and_condition" id="terms_and_condition">
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="<?php echo e(route('tournaments.index')); ?>"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\tournament-setup\resources\views/settings/tournaments/add_new.blade.php ENDPATH**/ ?>