<form class="row g-3 needs-validation" id="memberDetailsForm" novalidate method="POST"
    action="{{ route('teams-members.store') }}" autocomplete="off" enctype='multipart/form-data'>

    @csrf

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <input type="text" class="form-control" id="investorName" name="name" placeholder="Please enter "
                value="{{ isset($user_info) || isset($user) ? $user_info->user->name : old('name') }}" required>
            <label for="investorName" class="form-label">Name <span class="text-danger">*</span></label>
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
            <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif "
                id="investorEmail" name="email" placeholder="Please enter "
                value="{{ isset($user_info) ? $user_info->user->email : old('email') }}" required>
            <label for="investorEmail" class="form-label">Email <span class="text-danger">*</span></label>
            <div class="invalid-tooltip">
                @if ($errors->has('email'))
                    {{ $errors->first('email') }}
                @else
                    Email is required!
                @endif
            </div>
        </div>
    </div>


    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <input type="text" class="form-control" id="memberRole" name="role" placeholder="Please enter "
                value="{{ isset($user_info) ? $user_info->role : old('role') }}" required>
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

    <div class="col-md-6 col-sm-12">
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


    <div class="col-md-6 col-sm-12">
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
    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <input type="password" class="form-control @if ($errors->has('password')) is-invalid @endif"
                id="investorPassword" name="password" placeholder="Please enter "
                value="{{ isset($user_info) ? $user_info->user->password : old('password') }}"
                autocomplete="new-password" required>
            <label for="investorPassword" class="form-label">Password <span class="text-danger">*</span></label>
            <div class="invalid-tooltip">
                @if ($errors->has('password'))
                    {{ $errors->first('password') }}
                @else
                    Password is required!
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 {{ request()->query('tab') == 'personaldetails_edit' }}">
        <div class="form-label-group in-border">
            <input type="password" class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                id="investorConfirmPassword" name="password_confirmation" placeholder="Please enter "
                value="{{ old('password_confirmation') }}" autocomplete="new-password" required>
            <label for="investorConfirmPassword" class="form-label">Confirm Password <span
                    class="text-danger">*</span></label>
            <div class="invalid-tooltip">
                @if ($errors->has('password_confirmation'))
                    {{ $errors->first('password_confirmation') }}
                @else
                    Confirm Password is required!
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-label-group in-border">
            <input type="file" class="form-control @if ($errors->has('avatar')) is-invalid @endif"
                id="avatar" name="avatar" placeholder="" value="{{ old('avatar') }}" required>
            <label for="avatar" class="form-label">Avatar</label>
            <div class="invalid-tooltip">
                @if ($errors->has('avatar'))
                    {{ $errors->first('avatar') }}
                @else
                    Avatar is required!
                @endif
            </div>
        </div>
    </div>



    <div class="col-12 text-end">
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('teams-members.index') }}"
            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
    </div>
</form>
@push('header_scripts')
@endpush
@push('footer_scripts')
    <script type="text/javascript">
        $(document).on('blur', '#investorConfirmPassword', function(e) {
            var u_p = $('#investorPassword').val();
            var u_c_p = $('#investorConfirmPassword').val();

            if (u_p != u_c_p) {
                alert('Password Miss Match');
                $('#investorConfirmPassword').val('');
                return false;
            }
        });
    </script>
@endpush
