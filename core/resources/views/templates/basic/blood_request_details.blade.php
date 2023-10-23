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
                                style="background-color: #FFDADC;
                                        margin-left: 10px;
                                        margin-right: 10px;
                                        margin-bottom: 20px;">
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
                                <p class="mt-4 mb-4 text-danger font-weight-bold"> <i class="fa-solid fa-eye"></i>
                                    {{ __($bloodRequest->click) }} People Visited</p>
                                <form action="{{ url('bloodrequest-comments') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="bloodrequest_id" value="{{ __($bloodRequest->id) }}" />
                                    <div style="margin-bottom: 10px">
                                        <h5 style="font-weight: bold">Leave Comments</h5>
                                    </div>
                                    <div class="rr-form">
                                        <div class="input-group" style="z-index:1;">
                                            <input style="border-radius: 25px 0px 0px 25px; height:46px; font-size:13px;" class="form-control"
                                                name="comment_body" type="text" placeholder="Write a Comment">
                                            <div class="input-group-prepend">
                                                <button style="border-radius: 0px 25px 25px 0px;" type="submit" class="btn btn-primary pb-2"><i class="fa fa-paper-plane mr-3"></i></button>
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
                                        @endphp
                                        <div class="rev-user-item">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="review-user-info">
                                                        <div class="media">
                                                            <img class="shadow bg-white"
                                                                src="{{ getImage('assets/images/donor/' . $comment_donor_details->image, imagePath()['donor']['size']) }}"
                                                                alt="@lang('donor image')">
                                                            <div class="media-body">
                                                                <h5 class="text-danger">{{ $comment_donor_details->name }}</h5>
                                                                <p>{{ $comment->created_at->format('d M Y') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget__title">@lang('Recent Post')</h5>
                            @foreach ($bloodRequests as $bloodRequest)
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6">
                                <span>{{ __($bloodRequest->id) }}</span>
                                    </div>
                                    <div class="col-lg-6">
                                        Hello
                                    </div>
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
@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush
