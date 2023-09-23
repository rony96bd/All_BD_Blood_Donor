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
                        <div class="blog-details__footer" style="padding: 10px 0;">
                            <div class="fb-comments" data-href="{{ route('bloodrequest.details', [$bloodRequest->id]) }}"
                                data-numposts="5"></div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget__title">@lang('Recent Post')</h5>
                            @foreach ($bloodRequests as $bloodRequest)
                                <span>{{ __($bloodRequest->id) }}</span>
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
