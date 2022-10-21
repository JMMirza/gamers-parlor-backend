<div id="shareholderModel" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Show Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body text-center p-5">
                @if ($result != null)
                    <form class="row" id="shareholderForm" action="{{ route('update-level-status') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" id="tournament_id" name="tournament_id"
                            value="{{ $result->tournament_id }}">
                        <input type="hidden" id="tournament_id" name="team_id" value="{{ $result->wining_team_id }}">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-label-group in-border">
                                <select class="form-select form-control mb-3" name="status" id="statusID" required>
                                    <option value="" disabled>Please select</option>
                                    <option value="APPROVED"
                                        @if (old('status') == 'APPROVED') {{ 'selected' }} @endif>
                                        APPROVE
                                    </option>
                                    <option value="REJECT" @if (old('status') == 'REJECT') {{ 'selected' }} @endif>
                                        REJECT
                                    </option>
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
                        <div class="col-md-12">
                            <figure class="figure mb-0">
                                <img src="{{ $result->winning_proof_url }}" class="figure-img img-fluid rounded"
                                    alt="...">
                                <figcaption class="figure-caption text-end">A caption for the above image.</figcaption>
                            </figure>
                        </div>
                        <div class="btn-group text-end">
                            <button class="btn btn-primary" type="submit">Save
                                Changes</button>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                @else
                    <lord-icon src="https://cdn.lordicon.com/hrqwmuhr.json" trigger="loop"
                        colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                    </lord-icon>
                    <div class="mt-4">
                        <h4 class="mb-3">No Result is uploaded yet.</h4>
                        <p class="text-muted mb-4"> Please wait while the result is being uploaded</p>
                        <div class="hstack gap-2 justify-content-center">
                            <a href="javascript:void(0);" class="btn btn-link link-success fw-medium"
                                data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                        </div>
                    </div>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
