{{-- <div class="row"> --}}
<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Add Enrollment</h4>
        </div>

        <div class="card-body">
            <form class="row g-3 needs-validation" action="{{ route('tournament-enrollments.store') }}" method="POST"
                novalidate>
                @csrf
                <div class="col-md-6">
                    <div class="form-label-group in-border">

                        <select class="form-select form-control mb-3" name="tournament_id" required>
                            <option value="" @if (old('tournament_id') == '') {{ 'selected' }} @endif selected
                                disabled>
                                Select One
                            </option>
                            @foreach ($tournaments as $tournament)
                                <option value="{{ $tournament->id }}"
                                    @if (old('tournament_id') == $tournament->id) {{ 'selected' }} @endif>
                                    {{ $tournament->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="tournament_id" class="form-label">Tournaments</label>
                        <div class="invalid-tooltip">Select the Tournament!</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-label-group in-border">

                        <select class="form-select form-control mb-3" name="team_id" required>
                            <option value="" @if (old('team_id') == '') {{ 'selected' }} @endif selected
                                disabled>
                                Select One
                            </option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}"
                                    @if (old('team_id') == $team->id) {{ 'selected' }} @endif>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="team_id" class="form-label">Teams</label>
                        <div class="invalid-tooltip">Select the team!</div>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                    <a href="{{ route('tournament-enrollments.index') }}" type="button"
                        class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}
