@if (isset($row))
    <a href="{{ route('tournaments.edit', $row->id) }}" class="btn btn-sm btn-success btn-icon waves-effect waves-light">
        <i class="mdi mdi-lead-pencil"></i>
    </a>
    <a href="{{ route('tournaments.destroy', $row->id) }}" data-table="tournaments-data-table"
        class="btn btn-sm btn-danger btn-icon waves-effect waves-light delete-record">
        <i class="ri-delete-bin-5-line"></i>
    </a>
    <a href="{{ route('tournament-levels.index', ['tournament_id' => $row->id]) }}"
        class="btn btn-sm btn-primary btn-icon waves-effect waves-light">
        <i class="mdi mdi-microsoft-xbox-controller"></i>
    </a>
@endif
