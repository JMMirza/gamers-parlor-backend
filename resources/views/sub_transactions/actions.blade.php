@if ($row->status == 'PENDING')
    <a href="{{ route('accept-sub-transaction', $row->id) }}"
        class="btn btn-sm btn-success btn-icon waves-effect waves-light">
        <i class="mdi mdi-account-plus"></i>
    </a>
    <a href="{{ route('reject-sub-transaction', $row->id) }}"
        class="btn btn-sm btn-danger btn-icon waves-effect waves-light">
        <i class="mdi mdi-account-minus"></i>
    </a>
@else
    N/A
@endif
