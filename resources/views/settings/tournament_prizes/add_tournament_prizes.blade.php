
<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Create New Prize</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('prizes.store') }}" method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" placeholder="Title" name="title" value="{{ old('title') }}" required>
                            <label for="title" class="form-label fs-5 fs-lg-1">Title</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('title'))
                                {{ $errors->first('title') }}
                                @else
                                Title is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <div class="input-group">

                                <input type="number"
                                    class="form-control @if ($errors->has('amount')) is-invalid @endif"
                                    id="amount" name="amount" placeholder="Please enter"
                                    value="{{ old('amount') }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">USD</span>
                                </div>
                                <label for="amount" class="form-label mr-2">Prize</label>
                            </div>
                            <div class="invalid-tooltip">
                                @if ($errors->has('amount'))
                                    {{ $errors->first('amount') }}
                                @else
                                    Prize is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="tournamentID" name="tournament_id" required>
                                <option value="" disabled selected>Please Select</option>
                                @foreach($tournaments as $tournament)
                                <option value="{{$tournament->id}}" @if (old('tournament_id')==$tournament->id) {{ 'selected' }} @endif>{{$tournament->name}}</option>
                                @endforeach
                            </select>
                            <label for="tournamentID" class="form-label fs-5 fs-lg-1">Tournaments List</label>
                            <div class="invalid-tooltip">Kindly select the 2</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="status_id" required>
                                <option value="" disabled selected>Please select</option>
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
                        <button type="button" class="btn btn-light bg-gradient waves-effect waves-light">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>