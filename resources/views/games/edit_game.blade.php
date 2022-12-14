@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{ isset($game->title) ? $game->title : 'Create New game' }}</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form class="row g-3 needs-validation" novalidate action="{{ route('games.update', $game->id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <input type="text"
                                        class="form-control @if ($errors->has('title')) is-invalid @endif"
                                        id="title" name="title" placeholder="Please enter title"
                                        value="{{ $game->title }}" required>
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
                                    <select class="form-select @if ($errors->has('status_id')) is-invalid @endif"
                                        id="status_id" name="status_id" aria-label="Please select" required>
                                        <option value="">Please select</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $game->status_id == $status->id ? 'selected' : '' }}>{{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="status_id" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <div class="invalid-tooltip">
                                        status is required!
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <input type="file" class="form-control image" id="logoImg" name="logo"
                                        placeholder="logo" value="{{ isset($game) ? trim($game->logo_url) : old('logo') }}"
                                        accept="image/*">
                                    <label for="logoImg" class="form-label">Logo</label>
                                </div>
                            </div>

                            <?php
                            $string = $game->logo_url;
                            $path = $string;
                            if (str_contains($string, 'pdf')) {
                                $path = '/files/platform/doc.png';
                            }
                            ?>
                            <div class="col-md-1 col-sm-12">
                                <a href="javascript:void(0);" class="preview-img" data-url="{{ $path }}"><img
                                        class="rounded avatar-xs header-profile-user mt-1" src="{{ trim($path) }}"
                                        alt="Header Avatar"></a>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-label-group in-border">
                                    <input type="file" class="form-control image" id="logoVipImg" name="vip_logo"
                                        placeholder="vip_logo"
                                        value="{{ isset($game) ? trim($game->vip_logo_url) : old('vip_logo') }}"
                                        accept="image/*">
                                    <label for="logoVipImg" class="form-label">Vip Logo</label>
                                </div>
                            </div>

                            <div class="col-md-1 col-sm-12">
                                <a href="javascript:void(0);" class="preview-img" data-url="{{ $game->vip_logo_url }}"><img
                                        class="rounded avatar-xs header-profile-user mt-1" src="{{ $game->vip_logo_url }}"
                                        alt="Header Avatar"></a>
                            </div>


                            <div class="col-md-12 col-sm-12">
                                <div>
                                    <textarea class="form-control ckeditor-description" id="description" placeholder="Please enter" name="description"
                                        maxlength="800">{{ isset($game->description) ? trim($game->description) : '' }} </textarea>
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
