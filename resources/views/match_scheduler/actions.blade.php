<a href="{{ route('match-scheduler.edit', $row->id) }}" class="btn btn-sm btn-success btn-icon waves-effect waves-light">
    <i class="mdi mdi-lead-pencil"></i>
</a>

<a href="{{ route('match-scheduler.destroy', $row->id) }}" data-rowid="{{ $row->id }}"
    data-table="match-scheduler-data-table" class="btn btn-sm btn-danger btn-icon waves-effect waves-light delete-record">
    <i class="ri-delete-bin-5-line"></i>
</a>
