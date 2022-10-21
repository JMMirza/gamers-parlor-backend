@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">

        @if (isset($matchScheduler))
            @include('match_scheduler.edit')
        @else
            @include('match_scheduler.add_new')
        @endif
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Match Schedules</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <table id="match-scheduler-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tournament Title</th>
                                <th>Team 1 Name</th>
                                <th>Team 2 Name</th>
                                <th>Start Date</th>
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


            $('#match-scheduler-data-table').DataTable({
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
                ajax: "{{ route('match-scheduler.index') }}",
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
                        data: 'team1.name',
                        name: 'team1.name',
                        defaultContent: '<span>N/A</span>'
                    },
                    {
                        data: 'team2.name',
                        name: 'team2.name',
                        defaultContent: '<span>N/A</span>'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'status',
                        name: 'status',
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
