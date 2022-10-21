<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">{{ $tournamentPrize->title }}</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('prizes.update', $tournamentPrize->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif"
                                id="title" name="title" placeholder="Please enter"
                                value="{{ $tournamentPrize->title }}" required>
                            <label for="title" class="form-label fs-5 fs-lg-1">Title</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('title'))
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
                                    value="{{ $tournamentPrize->amount }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">USD</span>
                                </div>
                                <label for="amount" class="form-label">Prize</label>
                            </div>
                            <div class="invalid-tooltip">
                                @if ($errors->has('amount'))
                                    {{ $errors->first('amount') }}
                                @else
                                   Prize is required
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('tournament_id')) is-invalid @endif" id="tournamentId" name="tournament_id" aria-label="Please select" required >
                                <option value="">Please select</option>
                                @foreach($tournaments as $tournament)
                                <option value="{{$tournament->id}}" {{ $tournamentPrize->eventable_type == 'App\Models\Tournament' && $tournamentPrize->eventable_id == $tournament->id ? 'selected' : '' }}>{{$tournament->name}}</option>
                                @endforeach
                            </select>
                            <label for="tournamentId" class="form-label fs-5 fs-lg-1">Tournaments List</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('tournament_id'))
                                {{ $errors->first('tournament_id') }}
                                @else
                                Tournament is required!
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select @if($errors->has('status_id')) is-invalid @endif" id="statusId" name="status_id" aria-label="Please select" required >
                                <option value="">Please select</option>
                                @foreach($statuses as $status)
                                <option value="{{$status->id}}" {{ $tournamentPrize->status_id == $status->id ? 'selected' : '' }}>{{$status->name}}</option>
                                @endforeach
                            </select>
                            <label for="statusId" class="form-label fs-5 fs-lg-1">Tournaments List</label>
                            <div class="invalid-tooltip">
                                @if($errors->has('status_id'))
                                {{ $errors->first('status_id') }}
                                @else
                                Status is required!
                                @endif
                            </div>
                        </div>
                    </div>


                   

                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('prizes.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
