@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="blog-details-section pt-50 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog-details-wrapper" style="background-color: white; border-radius: 10px;">
                        @php
                            $timestamp = $bloodRequest->created_at;
                            $timeAgo = Carbon\Carbon::parse($timestamp)->ago();
                        @endphp
                        <div class="image-content">
                            <div class="container">
                                <a class="link-dark"
                                    href="{{ route('donor.details', [slug($bloodRequest->donor->name), $bloodRequest->donor->id]) }}">
                                    <div class="row">
                                        <div style="text-align: right; width: 65px"><img
                                                src="{{ getImage('assets/images/donor/' . $bloodRequest->donor->image, imagePath()['donor']['size']) }}"
                                                alt="@lang('image')" class="img-fluid"
                                                style="border-radius: 50px; height: 40px; width: 40px"></div>
                                        <div style="padding-left: 0px; line-height: 20px; width: 50%">
                                            {{ __($bloodRequest->donor->name) }}<br>{{ __($timeAgo) }}</div>
                                    </div>
                                </a>
                                {{-- <span style="float: right"><i class="fa-solid fa-eye"></i> {{ __($bloodRequest->click) }}</span> --}}
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h4 class="blog-details__title text-danger text-center">জরুরী প্রয়োজনে রক্তের সন্ধানে</h4>
                            <ul class="caption-list-two mt-4"
                                style="background-color: #FFDADC; margin-left: 10px; margin-right: 10px; margin-bottom: 20px;">
                                <li>
                                    <span class="caption">বিভাগ</span>
                                    <span class="value">{{ __($bloodRequest->division->name) }}</span>
                                </li>
                                <li>
                                    <span class="caption">জেলা</span>
                                    <span class="value">{{ __($bloodRequest->city->name) }}</span>
                                </li>
                                <li>
                                    <span class="caption">উপজেলা</span>
                                    <span class="value">{{ __($bloodRequest->location->name) }}</span>
                                </li>

                                <li>
                                    <span class="caption">রক্তের গ্রুপ</span>
                                    <span class="value">{{ __($bloodRequest->blood->name) }}</span>
                                </li>

                                <li>
                                    <span class="caption">রোগীর সমস্যা</span>
                                    <span class="value">{{ __($bloodRequest->problem) }}</span>
                                </li>
                                <li>
                                    <span class="caption">রক্তের পরিমাণ</span>
                                    <span class="value">{{ __($bloodRequest->amount_of_blood) }}</span>
                                </li>
                                <li>
                                    <span class="caption">রক্তদানের তারিখ</span>
                                    <span class="value">{{ showDateTime($bloodRequest->donate_date, 'd M Y') }}</span>
                                </li>
                                <li>
                                    <span class="caption">রক্তদানের সময়</span>
                                    <span class="value">{{ __($bloodRequest->donate_time) }}</span>
                                </li>
                                <li>
                                    <span class="caption">রক্তদানের স্থান</span>
                                    <span class="value">{{ __($bloodRequest->donate_address) }}</span>
                                </li>

                                <li>
                                    <span class="caption">যোগাযোগ</span>
                                    <span class="value">{{ __($bloodRequest->phone) }}</span>
                                </li>

                                <li>
                                    <span class="caption">কিছু কথা</span>
                                    <span class="value">{{ __($bloodRequest->message) }}</span>
                                </li>
                            </ul>
                        </div>
                        {{-- Comments Section --}}
                        <div class="row">
                            <div class="custom-comments bnfont" style="padding: 0px 36px 15px 36px;" id="custom-comments">
                                <p class="mt-2 mb-2 text-danger font-weight-bold"> <i class="fa-solid fa-eye"></i>
                                    {{ __($bloodRequest->click) }} People Visited</p>
                                <form action="{{ url('bloodrequest-comments') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="bloodrequest_id" value="{{ __($bloodRequest->id) }}" />
                                    <div style="margin-bottom: 10px">
                                    </div>
                                    <div class="rr-form">
                                        <div class="input-group" style="z-index:1;">
                                            <input style="border-radius: 25px 0px 0px 25px; height:46px; font-size:13px;"
                                                class="form-control" name="comment_body" type="text"
                                                placeholder="Write a Comment">
                                            <div class="input-group-prepend">
                                                <button style="border-radius: 0px 25px 25px 0px;" type="submit"
                                                    class="btn btn-primary pb-2"><i
                                                        class="fa fa-paper-plane mr-3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @php
                                    $bloodrequest_comment = App\Models\Comment::where('bloodrequest_id', $bloodRequest->id)->get();
                                @endphp

                                <div class="custom-review-count">
                                    @forelse ($bloodrequest_comment->sortByDesc('created_at') as $comment)
                                        @php
                                            $comment_donor_id = $comment->donor_id;
                                            $comment_donor_details = App\Models\Donor::where('id', $comment_donor_id)->first();

                                            $timestamp = $comment->created_at;
                                            $ctimeAgo = Carbon\Carbon::parse($timestamp)->ago();
                                        @endphp
                                        <div class="rev-user-item" id="comment-container">
                                            <hr>
                                            <div class="container" style="position: relative;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="review-user-info">
                                                            <div class="media">
                                                                <img class="shadow bg-white"
                                                                    src="{{ getImage('assets/images/donor/' . $comment_donor_details->image, imagePath()['donor']['size']) }}"
                                                                    alt="@lang('donor image')">
                                                                <div class="media-body">
                                                                    <h6 class="text-danger">
                                                                        {{ $comment_donor_details->name }}</h6>
                                                                    <p style="font-size: 12px">{{ $ctimeAgo }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (auth()->guard('admin')->check())
                                                    <div
                                                        style="position: absolute; top: 8px; right: 16px; font-size: 18px;">
                                                        <button type="button" class="deleteComment btn"
                                                            value="{{ $comment->id }}">
                                                            <i style="color: red" class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif

                                                @if (auth()->guard('donor')->check() && auth()->guard('donor')->user()->id == $comment->donor_id)
                                                <div style="position: absolute; top: 8px; right: 16px; font-size: 18px;">
                                                    <button type="button" class="deleteComment btn"
                                                        value="{{ $comment->id }}">
                                                        <i style="color: red" class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endif
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="comments-section-des">
                                                        <p> - {{ $comment->comment_body }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h5>No Comments</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        {{-- End Comments Section --}}
                    </div>
                </div>
                <style>
                    .sidebar .widget .widget__title::after {
                        width: 100%;
                    }

                    .widget .row:hover {
                        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                        transition: box-shadow 0.3s ease-in-out;
                    }
                </style>
                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <div class="widget" style="padding: 10px; border-radius: 10px;">
                            <h5 class="widget__title" style="text-align: center">@lang('Recent Blood Request')</h5>
                            @foreach ($bloodRequests as $bloodRequest)
                                @php
                                    $timestamp = $bloodRequest->created_at;
                                    $timeAgo = Carbon\Carbon::parse($timestamp)->ago();
                                @endphp
                                <div class="container" style="margin: 0px 0px 15px 0px;">
                                    <div class="row" style="border-radius: 5px;">
                                        <a style="padding: 0px;"
                                            href="{{ route('bloodrequest.details', [$bloodRequest->id]) }}">
                                            <div class="col-lg-12" style="padding: 0px;">
                                                <ul class="caption-list-two" style="background-color: #FFDADC;">
                                                    <li style="padding-bottom: 0px;">
                                                        <span class="caption">পোস্ট করেছেন</span>
                                                        <span class="value">{{ __($bloodRequest->donor->name) }}</span>
                                                    </li>
                                                    <li style="padding-bottom: 0px;">
                                                        <span class="caption">রক্তের গ্রুপ</span>
                                                        <span class="value">{{ __($bloodRequest->blood->name) }}</span>
                                                    </li>
                                                    <li style="padding-bottom: 0px;">
                                                        <span class="caption">বিভাগ</span>
                                                        <span
                                                            class="value">{{ __($bloodRequest->division->name) }}</span>
                                                    </li>
                                                    <li style="padding-bottom: 0px;">
                                                        <span class="caption">জেলা</span>
                                                        <span class="value">{{ __($bloodRequest->city->name) }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <ul class="small-post-list">

                            </ul>
                        </div>
                        @php
                            echo advertisements('416x554');
                        @endphp

                        @php
                            echo advertisements('416x554');
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.deleteComment', function() {
                if (confirm('Are you sure you want to delete this comment?')) {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/delete-comment') }}",
                        data: {
                            'comment_id': comment_id
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                thisClicked.closest('#comment-container').remove();
                                alert(res.message);
                            } else {
                                alert(res.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
