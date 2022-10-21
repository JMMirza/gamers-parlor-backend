<div class="col-lg-12">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Edit Coin</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="live-preview">
                <form class="row g-3 needs-validation" novalidate action="{{ route('coins.update', $coin->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <input type="number" step="0"
                                class="form-control @if ($errors->has('credit')) is-invalid @endif" id="credit"
                                name="credit" placeholder="Please enter" value="{{ $coin->credit }}" required>
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
                    <div class="col-md-6">
                        <div class="form-label-group in-border">
                            <input type="number" step="0.001"
                                class="form-control @if ($errors->has('amount')) is-invalid @endif" id="amount"
                                name="amount" placeholder="Please enter" value="{{ $coin->amount }}">
                            <label for="amount" class="form-label fs-5 fs-lg-1">Amount</label>
                            <div class="invalid-tooltip">
                                @if ($errors->has('amount'))
                                    {{ $errors->first('amount') }}
                                @else
                                    Amount is required!
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                        <a href="{{ route('coins.index') }}"
                            class="btn btn-light bg-gradient waves-effect waves-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
