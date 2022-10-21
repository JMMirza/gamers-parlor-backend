@extends('layouts.master')
@section('content')
@include('components.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Platforms</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('platforms.create')}}" class="btn btn-success btn-label btn-sm">
                            <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New Platform
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="platforms-data-table" class="table table-bordered table-striped align-middle table-nowrap mb-0"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Logo</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('header_scripts')
@endpush
@push('footer_scripts')
<script type="text/javascript">

       $(document).ready(function() {
            $.extend($.fn.dataTableExt.oStdClasses, {
                "sFilterInput": "form-control",
                "sLengthSelect": "form-control"
            });

            $('#platforms-data-table').DataTable({
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
                ajax: "{{ route('platforms.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: "5%"
                    },
                    {
                        data: 'title',
                        name: 'title',
                        width: "20%"
                    },
                    

                    {
                        data: 'logo_url',
                        name: 'logo_url',
                        width: "10%",
                        render: function( data, type, full, meta ) {

                            var str1 = data;
                            var str2 = "pdf";
                            var path = data;
                            if(str1.indexOf(str2) != -1){
                                path = '/files/paltforms/doc.png';
                            }

                            return '<a href="javascript:void(0);" class="preview-img" data-url="'+ data +'"><img class="rounded avatar-xs header-profile-user mt-1" src="'+ path +'" alt="Header Avatar" /></a>';
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: "10%"
                    },
                    
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: "10%"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: "5%",
                        sClass: "text-center"
                    },
                ],
                "order": [[0, 'DESC']]

            });
        });
    </script>
@endpush
