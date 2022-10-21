<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<script type="text/javascript">
    var ckClassicEditor = document.querySelectorAll(".ckeditor-description");
    $(document).on('click', '.preview-img', function(e) {
        e.preventDefault();
        let path = $(this).data('url');
        $(".img_path").attr("src", path);
        $('#domicile-modal').modal('show');
    });

    $(document).ready(function() {
        ckClassicEditor.forEach(function() {
            ClassicEditor.create(document.querySelector(".ckeditor-description")).then(function(e) {
                e.ui.view.editable.element.style.height = "200px"
            }).catch(function(e) {
                console.error(e)
            })
        });

        $('.select2').select2({
            maximumSelectionLength: 2,
            dropdownAutoWidth: true,
            width: '100%',
            placeholder: "Select please",
            allowClear: false
        });
    });



    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })


    $('#myselect').select2({
        width: '100%',
        placeholder: "Select an Option",
        allowClear: true
    });

    $(document).on('click', '.delete-record', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        var table = $(this).data('table');

        Swal.fire({
            html: '<div class="mt-3">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15 mx-5">' +
                '<h4>Are you sure?</h4>' +
                '<p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this Record ?</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary w-xs me-2 mb-1',
            confirmButtonText: 'Yes, Delete It!',
            cancelButtonClass: 'btn btn-danger w-xs mb-1',
            buttonsStyling: false,
            showCloseButton: true
        }).then(function(result) {

            if (result.isConfirmed) {

                $.ajax({

                    url: url,
                    type: "DELETE",
                    // data : filters,
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                    cache: false,
                    success: function(data) {
                        $('#' + table).DataTable().ajax.reload(null, false);
                    },
                    error: function() {

                    },
                    beforeSend: function() {

                    },
                    complete: function() {

                    }
                });
            }
        });
    });

    $(document).on('click', '.show-modal', function(e) {

        var target = $(this).data('target');
        var url = $(this).data('url');
        console.log('show modal', target, url);

        $.ajax({

            url: url,
            type: "GET",
            // dataType: 'html',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            cache: false,
            success: function(data) {
                $('#modal-div').html(data);
                $(target).modal('show');
            },
            error: function() {

            },
            beforeSend: function() {

            },
            complete: function() {

            }
        });
    });


    $(document).on('click', '.print-content', function(e) {
        var content = $(this).data('content');
        // printJS(content, 'html')
        printJS({
            printable: content,
            type: 'html',
            targetStyles: ['*']
        })
    });
</script>

@yield('script')
@yield('script-bottom')
