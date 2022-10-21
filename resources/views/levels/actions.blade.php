@if (isset($row))
    <a href="{{ route('tournament-levels.create', ['tournament_id' => $row->tournament_id]) }}"
        class="btn btn-sm btn-success btn-icon waves-effect waves-light">
        <i class="mdi mdi-account-eye"></i>
    </a>
@endif
