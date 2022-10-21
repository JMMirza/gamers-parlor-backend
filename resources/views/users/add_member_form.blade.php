@extends('layouts.master')
@section('content')
    @include('components.flash_message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 text-primary">Create New Member
                    </h4>
                </div>
                <div class="card-body">
                    @include('users.personal_details')
                </div>
            </div>
        </div>
    </div>
@endsection
