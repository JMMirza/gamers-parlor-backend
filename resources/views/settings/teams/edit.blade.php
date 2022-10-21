<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit Status</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate enctype='multipart/form-data'
                    action="{{ route('teams.update', $team->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text"
                                class="form-control @if ($errors->has('name')) is-invalid @endif" id="statusName"
                                name="name" placeholder="Please enter" value="{{ $team->name }}" required>
                            <label for="statusName" class="form-label fs-5 fs-lg-1">Name</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('name'))
                                    {{ $errors->first('name') }}
                                @else
                                    Name is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="number"
                                class="form-control @if ($errors->has('number_of_members')) is-invalid @endif"
                                id="number_of_members" name="number_of_members" placeholder="Please enter"
                                value="{{ $team->number_of_members }}" required>
                            <label for="number_of_members" class="form-label fs-5 fs-lg-1">Number of Members</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('number_of_members'))
                                    {{ $errors->first('number_of_members') }}
                                @else
                                    Number of Members is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="status_id" required>
                                <option value="" @if ($team->stat_id == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        @if ($team->status_id == $status->id) {{ 'selected' }} @endif>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="status" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('status_id'))
                                    {{ $errors->first('status_id') }}
                                @else
                                    PLease select any Status!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group in-border">

                            <input type="file"
                                class="form-control @if ($errors->has('team_logo')) is-invalid @endif" id="team_logo"
                                name="team_logo" placeholder="" value="{{ $team->teamogo }}">
                            <label for="team_logo" class="form-label">Team Logo</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('team_logo'))
                                    {{ $errors->first('team_logo') }}
                                @else
                                    Team Logo is required!
                                @endif
                            </div>
                            <small class="text-muted form-text m-b-none text-right"><a data-bs-toggle="modal"
                                    data-bs-target="#domicile-modal" href="" title="Domicile" data-gallery=""><i
                                        class="ri-picture-in-picture-exit-fill"></i> Preview Team Logo</a></small>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('teams.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
