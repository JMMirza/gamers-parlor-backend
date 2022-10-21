<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Create New Gamer Tag</h4>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('gamer-tags.store') }}" method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text"
                                class="form-control @if ($errors->has('name')) is-invalid @endif"
                                id="gamerTagName" name="name" placeholder="Please enter" value="{{ old('name') }}"
                                required>
                            <label for="gamerTagName" class="form-label fs-5 fs-lg-1">Name</label>
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
                            <input type="text"
                                class="form-control @if ($errors->has('abbreviation')) is-invalid @endif"
                                id="abbreviation" name="abbreviation" placeholder="Please enter"
                                value="{{ old('abbreviation') }}">
                            <label for="abbreviation" class="form-label fs-5 fs-lg-1">Abbreviation</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('abbreviation'))
                                    {{ $errors->first('abbreviation') }}
                                @else
                                    Abbreviation is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="status_id" required>
                                <option value="" @if (old('status_id') == '') {{ 'selected' }} @endif
                                    selected disabled>
                                    Select One
                                </option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        @if (old('status_id') == $status->id) {{ 'selected' }} @endif>
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
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('gamer-tags.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
