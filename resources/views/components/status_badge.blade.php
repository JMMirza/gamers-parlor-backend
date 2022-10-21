@if ($row->status->name == 'In-Active' || $row->status->name == null)
    <span class="badge bg-danger">In Active</span>
@else
    <span class="badge bg-info">Active</span>
@endif
