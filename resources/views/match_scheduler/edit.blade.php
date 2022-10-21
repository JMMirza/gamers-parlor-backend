<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Update Match Scheduler</h4>
            </div>

            <div class="card-body">
                <form class="row  needs-validation" action="{{ route('match-scheduler.update', $matchScheduler->id) }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="col-md-12">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="tournament_id" required>
                                <option value="" @if ($matchScheduler->tournament_id == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                @foreach ($tournaments as $tournament)
                                    <option value="{{ $tournament->id }}"
                                        @if ($matchScheduler->tournament_id == $tournament->id) {{ 'selected' }} @endif>
                                        {{ $tournament->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="tournament_id" class="form-label">Tournaments</label>
                            <div class="invalid-tooltip">Select the Tournament!</div>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if ($errors->has('team_id')) is-invalid @endif select2"
                                id="teamId" name="team_id[]" multiple required>
                                <option value="" disabled>Please select</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        @if ($matchScheduler->team1_id == $team->id || $matchScheduler->team2_id == $team->id) {{ 'selected' }} @endif>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="teamId" class="form-label">Teams <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">Team is required!</div>
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="team1_id" required>
                                <option value="" @if ($matchScheduler->team1_id == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        @if ($matchScheduler->team1_id == $team->id) {{ 'selected' }} @endif>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="team1_id" class="form-label">Teams</label>
                            <div class="invalid-tooltip">Select the team!</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="team2_id" required>
                                <option value="" @if ($matchScheduler->team2_id == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        @if ($matchScheduler->team2_id == $team->id) {{ 'selected' }} @endif>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="team2_id" class="form-label">Teams</label>
                            <div class="invalid-tooltip">Select the team!</div>
                        </div>
                    </div> --}}

                    <div class="col-md-6 col-sm-12">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" class="form-control" data-provider="flatpickr"
                                    data-date-format="Y-m-d" data-altFormat="d M, Y"
                                    data-deafult-date="{{ date('Y-m-d') }}" value="{{ $matchScheduler->start_date }}"
                                    name="start_date" id="startDate" required>
                                <label for="startDate" class="form-label fs-5 fs-lg-1">Start Date</label>
                                <div class="input-group-text bg-primary border-primary text-white">
                                    <i class="ri-calendar-2-line"></i>
                                </div>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('start_date'))
                                        {{ $errors->first('start_date') }}
                                    @else
                                        Start Date is required!
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <div class="input-group">
                                <input type="text" class="form-control" data-provider="flatpickr"
                                    data-date-format="Y-m-d" data-altFormat="d M, Y"
                                    data-deafult-date="{{ date('Y-m-d') }}" value="{{ $matchScheduler->end_date }}"
                                    name="end_date" id="endDate" required>
                                <label for="endDate" class="form-label fs-5 fs-lg-1">End Date</label>
                                <div class="input-group-text bg-primary border-primary text-white">
                                    <i class="ri-calendar-2-line"></i>
                                </div>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('end_date'))
                                        {{ $errors->first('end_date') }}
                                    @else
                                        End Date is required!
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-6 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if ($errors->has('status_id')) is-invalid @endif"
                                id="statusId" name="status_id" aria-label="Please select" required>
                                <option value="">Please select</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $matchScheduler->status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}</option>
                                @endforeach
                            </select>
                            <label for="statusId" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('status_id'))
                                    {{ $errors->first('status_id') }}
                                @else
                                    Status is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('match-scheduler.index') }}" type="button"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
