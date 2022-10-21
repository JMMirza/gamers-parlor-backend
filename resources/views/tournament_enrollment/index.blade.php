@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">

        @if (isset($enrollment))
            @include('tournament_enrollment.edit')
        @else
            @include('tournament_enrollment.add_new')
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tournament Enrollment</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <table id="tournament-enrollments-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tournament Title</th>
                                <th>Team Name</th>
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


            $('#tournament-enrollments-data-table').DataTable({
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
                ajax: "{{ route('tournament-enrollments.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: "5%"
                    },
                    {
                        data: 'tournament.name',
                        name: 'tournament.name',
                        defaultContent: '<span>N/A</span>'
                    },
                    {
                        data: 'team.name',
                        name: 'team.name',
                        defaultContent: '<span>N/A</span>'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        width: "15%"
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

            });
        });
    </script>
@endpush
