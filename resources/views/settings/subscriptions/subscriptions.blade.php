@extends('layouts.master')
@section('content')
    @include('components.flash_message')

    <div class="row">
        @if (isset($subscriptionPrice))
            @include('settings.subscriptions.edit')
        @else
            @include('settings.subscriptions.add_new')
        @endif

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Subscriptions List</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="subscriptions-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Credit</th>
                                <th>Number of Months</th>
                                <th>Discount</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Credit</th>
                                <th>Number of Months</th>
                                <th>Discount</th>
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

            $('#subscriptions-data-table').DataTable({
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
                ajax: "{{ route('subscriptions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: "5%"
                    },
                    {
                        data: 'credit',
                        name: 'credit',
                        width: "25%"
                    },
                    {
                        data: 'no_of_months',
                        name: 'no_of_months',
                        width: "25%"
                    },
                    {
                        data: 'discount',
                        name: 'discount',
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
                ]
            });
        });
    </script>
@endpush
