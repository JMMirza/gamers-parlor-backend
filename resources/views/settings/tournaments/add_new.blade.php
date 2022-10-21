@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Create New Tournament</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <form class="row g-3 needs-validation" novalidate action="{{ route('tournaments.store') }}" method="post">
                        @csrf

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <input type="text"
                                    class="form-control @if ($errors->has('name')) is-invalid @endif" id="name"
                                    name="name" placeholder="Please enter" value="{{ old('name') }}" required>
                                <label for="name" class="form-label fs-5 fs-lg-1">Name</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('name'))
                                        {{ $errors->first('name') }}
                                    @else
                                        Name is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="game_id" required>
                                    <option value="" @if (old('game_id') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($games as $game)
                                        <option value="{{ $game->id }}"
                                            @if (old('game_id') == $game->id) {{ 'selected' }} @endif>
                                            {{ $game->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="game_id" class="form-label fs-5 fs-lg-1">Game</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('game_id'))
                                        {{ $errors->first('game_id') }}
                                    @else
                                        PLease select any Status!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="platform_id" required>
                                    <option value="" @if (old('platform_id') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    @foreach ($platforms as $platform)
                                        <option value="{{ $platform->id }}"
                                            @if (old('platform_id') == $platform->id) {{ 'selected' }} @endif>
                                            {{ $platform->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="platform_id" class="form-label fs-5 fs-lg-1">Platfrom</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('platform_id'))
                                        {{ $errors->first('platform_id') }}
                                    @else
                                        PLease select any Status!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-label-group in-border">
                                <div class="input-group">
                                    <input type="date" class="form-control" data-provider="flatpickr"
                                        data-date-format="Y-m-d" data-altFormat="d M, Y"
                                        data-deafult-date="{{ date('Y-m-d') }}" value="{{ old('start_date') }}"
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
                                    <input type="date" class="form-control" data-provider="flatpickr"
                                        data-date-format="Y-m-d" data-altFormat="d M, Y"
                                        data-deafult-date="{{ date('Y-m-d') }}" value="{{ old('end_date') }}"
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
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <input type="number"
                                    class="form-control @if ($errors->has('number_of_request')) is-invalid @endif"
                                    id="number_of_request" name="number_of_request" placeholder="Please enter"
                                    value="{{ old('number_of_request') }}" required>
                                <label for="number_of_request" class="form-label fs-5 fs-lg-1">Number of Teams</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('number_of_request'))
                                        {{ $errors->first('number_of_request') }}
                                    @else
                                        Number of Teams is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <div class="input-group">

                                    <input type="number"
                                        class="form-control @if ($errors->has('registration_fee')) is-invalid @endif"
                                        id="registration_fee" name="registration_fee" placeholder="Please enter"
                                        value="{{ old('registration_fee') }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">USD</span>
                                    </div>
                                    <label for="registration_fee" class="form-label mr-2">Registration Fee</label>
                                </div>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('registration_fee'))
                                        {{ $errors->first('registration_fee') }}
                                    @else
                                        Registration Fee is empty or incorrect!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="published" required>
                                    <option value="" @if (old('published') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    <option value="1" @if (old('published') == '1') {{ 'selected' }} @endif>
                                        Yes
                                    </option>
                                    <option value="0" @if (old('published') == '0') {{ 'selected' }} @endif>
                                        No
                                    </option>
                                </select>
                                <label for="published" class="form-label fs-5 fs-lg-1">Published</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('published'))
                                        {{ $errors->first('published') }}
                                    @else
                                        Published is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="is_vip" required>
                                    <option value="" @if (old('is_vip') == '') {{ 'selected' }} @endif
                                        selected disabled>
                                        Select One
                                    </option>
                                    <option value="1" @if (old('is_vip') == '1') {{ 'selected' }} @endif>
                                        Yes
                                    </option>
                                    <option value="0" @if (old('is_vip') == '0') {{ 'selected' }} @endif>
                                        No
                                    </option>
                                </select>
                                <label for="is_vip" class="form-label fs-5 fs-lg-1">VIP</label>
                                <div class="invalid-tooltip">
                                    @if ($errors->has('is_vip'))
                                        {{ $errors->first('is_vip') }}
                                    @else
                                        Published is required!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
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

                        <div class="col-md-12 col-sm-12 mb-3">
                            <div>
                                <textarea class="form-control ckeditor-description" id="terms_and_condition" placeholder="Please enter"
                                    name="terms_and_condition"></textarea>
                            </div>
                        </div>

                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                            <a href="{{ route('tournaments.index') }}"
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
