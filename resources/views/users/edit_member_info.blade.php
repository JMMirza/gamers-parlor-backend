@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Update Team Member</h4>
                </div>

                <div class="card-body">
                    @if (isset($user_info))
                        <form class="row  needs-validation" action="{{ route('teams-members.update', $user_info->id) }}"
                            method="POST" enctype="multipart/form-data" novalidate>
                        @else
                            <form class="row  needs-validation" action="{{ route('teams-members.update', $user->id) }}"
                                method="POST" enctype="multipart/form-data" novalidate>
                    @endif
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ isset($user_info) ? $user_info->user->id : $user->id }}">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <input type="text" class="form-control" id="memberRole" name="role"
                                placeholder="Please enter " value="{{ isset($user_info) ? $user_info->role : old('role') }}"
                                required>
                            <label for="memberRole" class="form-label">Role <span class="text-danger">*</span></label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('role'))
                                    {{ $errors->first('role') }}
                                @else
                                    Role is required!
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select mb-3" id="teamID" name="team_id" required>
                                <option value="" disabled selected>Please Select</option>
                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        @if (!isset($user_info->team_id)) @if (old('team_id') == $team->id) {{ 'selected' }} @endif
                                    @else @if ($user_info->team_id == $team->id) {{ 'selected' }} @endif @endif>
                                        {{ $team->name }}</option>
                                @endforeach
                            </select>
                            <label for="teamID" class="form-label fs-5 fs-lg-1">Teams List</label>
                            <div class="invalid-tooltip">Please select</div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12">
                        <div class="form-label-group in-border">
                            <select class="form-select form-control mb-3" name="status_id" required>
                                <option value="" disabled selected>Please select</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}"
                                        @if (!isset($user_info->team_id)) @if (old('status_id') == $status->id) {{ 'selected' }} @endif
                                    @else @if ($user_info->status_id == $status->id) {{ 'selected' }} @endif @endif
                                        >
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="status" class="form-label fs-5 fs-lg-1">Status</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('status_id'))
                                    {{ $errors->first('status_id') }}
                                @else
                                    Please select
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('teams-members.index') }}" type="button"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
