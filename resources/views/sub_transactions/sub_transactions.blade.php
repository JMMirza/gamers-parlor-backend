@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Subscription Transactions</h4>

                </div>
                <div class="card-body">
                    <table id="transactions-data-table"
                        class="table table-bordered table-striped align-middle table-nowrap mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Transaction ID</th>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>Postal Code</th>
                                <th>Country Code</th>
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

            $('#transactions-data-table').DataTable({
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
                ajax: "{{ route('subscription-transactions') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: "5%"
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                        width: "20%"
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        width: "20%"
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id',
                        width: "20%"
                    },
                    {
                        data: 'full_name',
                        name: 'full_name',
                        width: "20%"
                    },
                    {
                        data: 'address_line_1',
                        name: 'address_line_1',
                        width: "20%"
                    },
                    {
                        data: 'postal_code',
                        name: 'postal_code',
                        width: "20%"
                    },
                    {
                        data: 'country_code',
                        name: 'country_code',
                        width: "20%"
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
                "order": [
                    [0, 'DESC']
                ]

            });
        });
    </script>
@endpush
