
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('components.flash_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <?php if(isset($tournament)): ?>
            <?php echo $__env->make('settings.tournaments.edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__env->make('settings.tournaments.add_new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tournament List</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="tournaments-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Published</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Number Of Request</th>
                                <th>Registration Fee</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Published</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Number Of Request</th>
                                <th>Registration Fee</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('header_scripts'); ?>
    <link href="<?php echo e(asset('assets/libs/quill/quill.core.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/libs/quill/quill.snow.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>

<?php $__env->startPush('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/libs/quill/quill.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#tournaments-data-table').DataTable({
                retrieve: true,
                processing: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search..."
                },
                responsive: true,
                bLengthChange: false,
                pageLength: 10,
                scrollX: true,
                ajax: "<?php echo e(route('tournaments.index')); ?>",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: "5%"
                    },
                    {
                        data: 'name',
                        name: 'name',
                        width: "25%"
                    },
                    {
                        data: 'published',
                        name: 'published',
                        width: "20%"
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        width: "20%"
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                        width: "20%"
                    },
                    {
                        data: 'number_of_request',
                        name: 'number_of_request',
                        width: "20%"
                    },
                    {
                        data: 'registration_fee',
                        name: 'registration_fee',
                        width: "20%"
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: "20%"
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: "20%"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: "10%",
                        sClass: "text-center"
                    },
                ]
            });
            var quill_snow;
            quill_snow = new Quill("#snow-editor", {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, 4, 5, 6, false]
                        }],
                        ["bold", "italic", "underline", "strike"],
                        ["code-block"],
                        ["link"],
                        [{
                            script: "sub"
                        }, {
                            script: "super"
                        }],
                        [{
                            list: "ordered"
                        }, {
                            list: "bullet"
                        }],
                        ["clean"],
                    ],
                },
                theme: "snow",
            });
            quill_snow.on("text-change", function(delta, oldDelta, source) {
                $("#terms_and_condition").val(quill_snow.root.innerHTML);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\tournament-setup\resources\views/settings/tournaments/tournaments.blade.php ENDPATH**/ ?>