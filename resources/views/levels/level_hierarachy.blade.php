@extends('layouts.master')

@push('header_scripts')
@endpush

@section('content')
    @include('components.flash_message')
    <div class="tournament-table">
        <div class="row">
            <div class="col-12">
                <div class="tournament-bracket tournament-bracket--rounded">
                    @foreach ($tournaments as $level)
                        <div class="tournament-bracket__round tournament-bracket__round--quarterfinals">
                            <h3 class="tournament-bracket__round-title">Level {{ $level['tournament_level'] }}</h3>
                            <ul class="tournament-bracket__list">
                                @foreach ($level['tournament_level_matches'] as $tournament_level_matches)
                                    <li class="tournament-bracket__item">
                                        <div class="tournament-bracket__match">
                                            @foreach ($tournament_level_matches['teams'] as $team)
                                                <div
                                                    class="tournament-bracket__country align-items-center justify-content-between gap-3">
                                                    <span class="tournament-bracket__score">{{ $team['id'] }}</span>
                                                    <div class="tournament-name w-100" title="">{{ $team['name'] }}
                                                    </div>

                                                    <span class="tournament-bracket__number">4</span>
                                                </div>
                                            @endforeach

                                            <button type="button"
                                                class="btn btn-info text-capitalize font-large fw-bold show-modal"
                                                data-bs-toggle="modal" id="shareholders"
                                                data-url="{{ route('show-modal', ['match_id' => $tournament_level_matches['id']]) }}"
                                                data-target="#shareholderModel">
                                                results
                                            </button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@push('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function(e) {
            $(this).next('#shareholders').click(function(e) {
                var target = $(this).data("target");
                var url = $(this).data("url");
                $.ajax({
                    url: url,
                    headers: {
                        "X-CSRF-Token": "{{ csrf_token() }}",
                    },
                    type: "GET",
                    cache: false,
                    success: function(data) {
                        $("#modal-div").html(data);
                        $(target).modal("show");
                    },
                    error: function() {},
                });
            });
        });
    </script>
@endpush
