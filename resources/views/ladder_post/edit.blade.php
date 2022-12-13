@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Edit Ladder Post</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <form class="row g-3 needs-validation" novalidate
                        action="{{ route('ladder-post.update', $ladderPost->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="host_id" value="{{ \Auth::user()->id }}">

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="game_id" required>
                                    <option value="" @if ($ladderPost->game_id == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($games as $game)
                                        <option value="{{ $game->id }}"
                                            @if ($ladderPost->game_id == $game->id) {{ 'selected' }} @endif>
                                            {{ $game->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="game_id" class="form-label fs-5 fs-lg-1">Game</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('game_id'))
                                        {{ $errors->first('game_id') }}
                                    @else
                                        Please select any Game!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="platform_id" required>
                                    <option value="" @if ($ladderPost->platform_id == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}"
                                            @if ($ladderPost->platform_id == $platform->id) {{ 'selected' }} @endif>
                                            {{ $platform->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="platform_id" class="form-label fs-5 fs-lg-1">Platform</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('platform_id'))
                                        {{ $errors->first('platform_id') }}
                                    @else
                                        Please select any Platform!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <div class="input-group">
                                    <input type="date" class="form-control" data-provider="flatpickr"
                                        data-date-format="Y-m-d" data-altFormat="d M, Y"
                                        data-deafult-date="{{ date('Y-m-d') }}" value="{{ $ladderPost->start_date }}"
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

                        <div class="col-md-6 col-sm-12">
                            <div class="form-label-group in-border">
                                <div class="input-group">

                                    <input type="number"
                                        class="form-control @if ($errors->has('fee')) is-invalid @endif"
                                        id="fee" name="fee" placeholder="Please enter"
                                        value="{{ $ladderPost->fee }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">USD</span>
                                    </div>
                                    <label for="fee" class="form-label mr-2">Registration Fee</label>
                                </div>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('fee'))
                                        {{ $errors->first('fee') }}
                                    @else
                                        Registration Fee is empty or incorrect!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="status" required>
                                    <option value="" @if ($ladderPost->status == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->name }}"
                                            @if ($ladderPost->status == $status->name) {{ 'selected' }} @endif>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="status" class="form-label fs-5 fs-lg-1">Status</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('status'))
                                        {{ $errors->first('status') }}
                                    @else
                                        PLease select any Status!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 mb-3">
                            <div>
                                <textarea class="form-control ckeditor-description" id="terms_and_condition" placeholder="Please enter"
                                    name="terms_and_condition">{{ $ladderPost->terms_and_condition }}</textarea>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <a href="{{ route('ladder-post.index') }}"
                                class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('header_scripts')
    <style type="text/css">
        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }
    </style>
@endpush

@push('footer_scripts')
    <script type="text/javascript"></script>
@endpush
