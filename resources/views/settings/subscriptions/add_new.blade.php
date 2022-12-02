<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Create New Subscription</h4>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('subscriptions.store') }}"
                    method="post">
                    @csrf
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="number" step="0"
                                class="form-control @if ($errors->has('credit')) is-invalid @endif" id="credit"
                                name="credit" placeholder="Please enter" value="{{ old('credit') }}" required>
                            <label for="credit" class="form-label fs-5 fs-lg-1">Credit</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('credit'))
                                    {{ $errors->first('credit') }}
                                @else
                                    Credit is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="number" step="0.001"
                                class="form-control @if ($errors->has('no_of_months')) is-invalid @endif"
                                id="no_of_months" name="no_of_months" placeholder="Please enter"
                                value="{{ old('no_of_months') }}">
                            <label for="no_of_months" class="form-label fs-5 fs-lg-1">Months</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('no_of_months'))
                                    {{ $errors->first('no_of_months') }}
                                @else
                                    Months is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-label-group in-border">
                            <input type="number" step="0.001"
                                class="form-control @if ($errors->has('discount')) is-invalid @endif" id="discount"
                                name="discount" placeholder="Please enter" value="{{ old('discount') }}">
                            <label for="discount" class="form-label fs-5 fs-lg-1">Discount</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('discount'))
                                    {{ $errors->first('discount') }}
                                @else
                                    Discount is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('subscriptions.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
