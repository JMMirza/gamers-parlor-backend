@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ isset($game->title) ? $game->title : 'Create New game' }}</h4>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <form class="row g-3 needs-validation" novalidate action="{{ route('games.store') }}" method="post"
                            enctype="multipart/form-data" id="blogForm">
                            @csrf
                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <input type="text"
                                        class="form-control @if ($errors->has('title')) is-invalid @endif"
                                        id="title" placeholder="Title" name="title" value="{{ old('title') }}"
                                        required>
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('title'))
                                            {{ $errors->first('title') }}
                                        @else
                                            Title is required!
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <select class="form-select form-control mb-3" name="platform_id" id="statusID"
                                        required>
                                        <option value="" disabled>Please select</option>
                                        @foreach ($platforms as $platform)
                                            <option value="{{ $platform->id }}"
                                                @if (old('platform_id') == $platform->id) {{ 'selected' }} @endif>
                                                {{ $platform->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="statusID" class="form-label fs-5 fs-lg-1">Platforms</label>
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('platform_id'))
                                            {{ $errors->first('platform_id') }}
                                        @else
                                            Please select platforms.
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <select class="form-select form-control mb-3" name="status_id" id="statusID" required>
                                        <option value="" disabled>Please select</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                @if (old('status_id') == $status->id) {{ 'selected' }} @endif>
                                                {{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="statusID" class="form-label fs-5 fs-lg-1">Status</label>
                                    <div class="invalid-tooltip">
                                        @if ($errors->has('status_id'))
                                            {{ $errors->first('status_id') }}
                                        @else
                                            Please select status.
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <input type="file" class="form-control image" id="log" name="logo"
                                        placeholder="logo" value="{{ old('logo') }}">
                                    <label for="log" class="form-label">Logo</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <input type="file" class="form-control vip_image" id="vip_log" name="vip_logo"
                                        placeholder="vip_logo" value="{{ old('vip_logo') }}">
                                    <label for="vip_log" class="form-label">Vip Logo</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <textarea class="form-control ckeditor-description" id="description" placeholder="Please enter" name="description"></textarea>
                                </div>
                            </div>


                            <div class="col-12 text-end">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                <a href="{{ route('games.index') }}"
                                    class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
@endpush

@push('footer_scripts')
@endpush
