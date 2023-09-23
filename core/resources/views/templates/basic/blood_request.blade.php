@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 d-xl-block d-none">
                    @php
                        echo advertisements('220x474');
                    @endphp
                    @php
                        echo advertisements('220x474');
                    @endphp
                    @php
                        echo advertisements('220x474');
                    @endphp
                </div>
                <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="row gy-4 justify-content-center" id="posts-container">

                        @include('templates.basic.blood_request_load')

                    </div>
                </div>
                <div class="col-xl-2 d-xl-block d-none">
                    @php
                        echo advertisements('220x474');
                    @endphp
                    @php
                        echo advertisements('220x474');
                    @endphp
                    @php
                        echo advertisements('220x474');
                    @endphp
                </div>
            </div>
        </div>
    </section>

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            let nextPageUrl = '{{ $bloodRequests->nextPageUrl() }}';
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1500) {
                    if (nextPageUrl) {
                        loadMoreRequests();
                    }
                }
            });

            function loadMoreRequests() {
                $.ajax({
                    url: nextPageUrl,
                    type: 'get',
                    beforeSend: function() {
                        nextPageUrl = '';
                    },
                    success: function(data) {
                        nextPageUrl = data.nextPageUrl;
                        $('#posts-container').append(data.view);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading more posts:", error);
                    }
                });
            }
        });
    </script>
@endpush
