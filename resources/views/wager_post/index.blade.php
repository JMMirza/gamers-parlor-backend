@extends('layouts.master')
@section('content')
    @include('components.flash_message')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Wager List</h4>
                    <div class="flex-shrink-0">
                        <a href="{{ route('wager-post.create') }}" class="btn btn-success btn-label btn-sm">
                            <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i> Add New Post
                        </a>
                    </div>
                </div>


                <div class="card-body">
                    <table id="wager-post-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Game</th>
                                <th>Platform</th>
                                <th>Start Date</th>
                                <th>Fee</th>
                                {{-- <th>Status</th> --}}
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Game</th>
                                <th>Platform</th>
                                <th>Start Date</th>
                                <th>Fee</th>
                                {{-- <th>Status</th> --}}
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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

            $('#wager-post-data-table').DataTable({
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
                ajax: "{{ route('wager-post.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: "5%"
                    },
                    {
                        data: 'game.title',
                        name: 'game.title',
                        width: "25%"
                    },
                    {
                        data: 'platform.title',
                        name: 'platform.title',
                        width: "25%"
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        width: "20%"
                    },
                    {
                        data: 'fee',
                        name: 'fee',
                        width: "20%"
                    },
                    // {
                    //     data: 'status',
                    //     name: 'status',
                    //     width: "20%"
                    // },
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

        });
    </script>
@endpush
