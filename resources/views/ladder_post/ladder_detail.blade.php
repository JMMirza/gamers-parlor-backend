@extends('layouts.master')

@push('header_scripts')
@endpush

@section('content')
    @include('components.flash_message')
    <div class="row">
        <div class="col-lg-6 mt-5">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ $ladder_post->team->team_logo_url }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">

                        </div>
                        <h5 class="fs-16 mb-1">{{ $ladder_post->team->name }}</h5>
                        <p class="text-muted mb-0">{{ $ladder_post->team->score }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if ($ladder_post->result_status == 'PENDING')
            <figure class="figure text-center">
                <img src="{{ $ladder_post->wining_proof_url }}" class="img-fluid" alt="Responsive image">
                <figcaption class="figure-caption text-end">Winning Proof</figcaption>
            </figure>
            <div class="col-lg-6 mt-5">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="{{ $ladder_post->challenger_team->team_logo_url }}"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                    alt="user-profile-image">
                            </div>
                            <h5 class="fs-16 mb-1">{{ $ladder_post->challenger_team->name }}</h5>
                            <p class="text-muted mb-0">{{ $ladder_post->challenger_team->score }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Accept Ladder Result</h4>
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <form class="row g-3 needs-validation" novalidate
                                action="{{ route('ladder-post-approve-result') }}" method="post">
                                @csrf
                                <input type="hidden" name="ladder_id" value="{{ $ladder_post->id }}">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-label-group in-border">
                                        <div class="input-group">

                                            <input type="number"
                                                class="form-control @if ($errors->has('score')) is-invalid @endif"
                                                id="score" name="score" placeholder="Please enter"
                                                value="{{ old('score') }}">
                                            <label for="score" class="form-label mr-2">Add Score to Winning Team</label>
                                        </div>
                                        <div class="invalid-tooltip">
                                            @if ($errors->has('score'))
                                                {{ $errors->first('score') }}
                                            @else
                                                Score is empty or incorrect!
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button class="btn btn-primary" type="submit">Approve</button>
                                    <a href="{{ route('ladder-post.index') }}"
                                        class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('footer_scripts')
    <script type="text/javascript"></script>
@endpush
