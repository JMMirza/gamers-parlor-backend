@if (isset($row))
    <a href="{{ route('ladder-post.edit', $row->id) }}" class="btn btn-sm btn-success btn-icon waves-effect waves-light">
        <i class="mdi mdi-lead-pencil"></i>
    </a>
    <a href="{{ route('ladder-post.destroy', $row->id) }}" data-table="ladder-post-data-table"
        class="btn btn-sm btn-danger btn-icon waves-effect waves-light delete-record">
        <i class="ri-delete-bin-5-line"></i>
    </a>
    @if ($row->status == 'COMPLETED')
        <a href="{{ route('ladder-details', $row->id) }}"
            class="btn btn-sm btn-primary btn-icon waves-effect waves-light">
            <i class="bx bx-detail"></i>
        </a>
    @endif
@endif
