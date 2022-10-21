@extends('layouts.master')
@section('content')
    @include('components.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tournament Levels</h4>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-sm btn-primary show-modal" data-bs-toggle="modal"
                            value="{{ $tournamentID }}" id="shareholders" data-target="#shareholderModel">Create
                            Level</button>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    {{-- @if (isset($id_of_tournament)) --}}
                    <input type="hidden" value="{{ $tournamentID }}" id="tournament_id">
                    {{-- @endif --}}
                    <table id="tournament-levels-data-table" class="table table-bordered align-middle table-nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Tournament ID</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Number Of Request</th>
                                <th>Registration Fee</th>
                                <th>Status</th>
                                <th>Level</th>
                                <th>Created At</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-height">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tournament ID</th>
                                <th>Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Number Of Request</th>
                                <th>Registration Fee</th>
                                <th>Status</th>
                                <th>Level</th>
                                <th>Created At</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="shareholderModel" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Create Level</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form class="row" id="shareholderForm" action="{{ route('tournament-levels.store') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" id="tournament_id" name="tournament_id" value="{{ $tournamentID }}">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-label-group in-border">
                                <div class="input-group">
                                    <input type="date" class="form-control" data-provider="flatpickr"
                                        data-date-format="Y-m-d" data-altFormat="d M, Y"
                                        data-deafult-date="{{ date('Y-m-d') }}" value="{{ old('start_date') }}"
                                        name="start_date" id="startDate" required>
                                    <label for="startDate" class="form-label fs-5 fs-lg-1">Start Date</label>
                                    <div class="input-group-text bg-primary border-primary text-white">
                                        <i class="ri-calendar-2-line"></i>
                                    </div>
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('start_date'))
                                            {{ $errors->first('start_date') }}
                                        @else
                                            Start Date is required!
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group text-end">
                            <button class="btn btn-primary" type="submit">Save
                                Changes</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection


@push('header_scripts')
@endpush

@push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#startDate').flatpickr({
                minDate: "today",
            });
            $('#tournament-levels-data-table').DataTable({
                // retrieve: true,
                processing: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search..."
                },
                responsive: true,
                bLengthChange: false,
                pageLength: 10,
                scrollX: true,
                ajax: {
                    url: "{{ route('tournament-levels.index') }}",
                    data: function(d) {
                        d.tournament_id = $('#tournament_id').val()
                    }
                },
                columns: [{
                        data: 'tournament_id',
                        name: 'tournament_id',
                        width: "5%"
                    },
                    {
                        data: 'tournament.name',
                        name: 'tournament.name',
                        width: "25%"
                    },
                    {
                        data: 'tournament.start_date',
                        name: 'tournament.start_date',
                        width: "25%"
                    },
                    {
                        data: 'tournament.end_date',
                        name: 'tournament.end_date',
                        width: "25%"
                    },
                    {
                        data: 'tournament.number_of_request',
                        name: 'tournament.number_of_request',
                        width: "25%"
                    },
                    {
                        data: 'tournament.registration_fee',
                        name: 'tournament.registration_fee',
                        width: "25%"
                    },
                    {
                        data: 'status',
                        name: 'status',
                        width: "25%"
                    },
                    {
                        data: 'level',
                        name: 'level',
                        width: "25%"
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
                    {
                        data: 'more_actions',
                        name: 'more_actions',
                        orderable: false,
                        searchable: false,
                        width: "10%",
                        sClass: "text-center"
                    },
                ]
            });
        });
    </script>
@endpush
