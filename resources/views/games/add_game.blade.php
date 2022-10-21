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
    {{-- <script type="text/javascript">
        var $modal = $('#investorModal');
        var vip_image = document.getElementById('image');
        var platformCropperVip;

        $("body").on("change", ".vip_image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                vip_image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            platformCropperVip = new Cropper(vip_image, {
                aspectRatio: 180 / 180,
                viewMode: 1,
                dragMode: crop,
                preview: '.preview',
                cropBoxResizable: true,
                cropBoxMovable: true,
                cropstart: function(e) {
                    console.log(e.type, e.detail);
                }
            });
        }).on('hidden.bs.modal', function() {
            platformCropperVip.destroy();
            platformCropperVip = null;
        });


        $("#crop").click(function() {
            $modal.modal('hide');
            canvas = platformCropperVip.getCroppedCanvas({});
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#vip_logo_game').val(base64data);
                }
            });
            platformCropper.destroy();
            platformCropper = null;
        });

        var image = document.getElementById('image');
        var platformCropper;

        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function() {
            platformCropper = new Cropper(image, {
                aspectRatio: 120 / 90,
                viewMode: 1,
                dragMode: crop,
                preview: '.preview',
                cropBoxResizable: true,
                cropBoxMovable: true,
                cropstart: function(e) {
                    console.log(e.type, e.detail);
                }
            });
        }).on('hidden.bs.modal', function() {
            platformCropper.destroy();
            platformCropper = null;
        });


        $("#crop").click(function() {
            $modal.modal('hide');
            canvas = platformCropper.getCroppedCanvas({});
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#logo_game').val(base64data);
                }
            });
        });
    </script> --}}
@endpush
