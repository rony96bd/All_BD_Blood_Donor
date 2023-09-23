@php
    $blood = getContent('blood.content', true);
    $bloods = App\Models\Blood::where('status', 1)
        ->with('donor')
        ->get();
    $bloodRequests = App\Models\BloodRequest::latest()
        ->with('blood', 'division', 'city', 'location', 'donor')
        ->limit(6)
        ->get();
@endphp

<section class="pt-50 pb-50 position-relative z-index-2 overflow-hidden">
    <div class="top-el-bg">
        <img src="{{ getImage('assets/images/frontend/blood/' . @$blood->data_values->background_image, '1920x389') }}"
            alt="@lang('image')">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header mb-4">
                    <h2 class="section-title">{{ __(@$blood->data_values->heading) }}</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @foreach ($bloods as $blood)
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="avaiable-blood-single has--link">
                        <a href="{{ route('blood.group.donor', [slug($blood->name), encrypt($blood->id)]) }}"
                            class="item--link"></a>
                        <h6 class="avaiable-blood-single__name"><i class="las la-tint"></i>{{ __($blood->name) }}</h6>
                        <span class="avaiable-blood-single__amount">{{ $blood->donor->count() }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="pt-35 pb-50 position-relative z-index-2 overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header mb-4">
                    <h2 class="section-title">ব্লাড রিকোয়েস্ট পোস্টসমূহ</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="slide-container container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                @foreach ($bloodRequests as $bloodRequest)
                    @php
                        $timestamp = $bloodRequest->created_at;
                        $timeAgo = Carbon\Carbon::parse($timestamp)->ago();
                    @endphp
                    <div class="card swiper-slide bnfont">
                        <div class="image-content">
                            <div class="container">
                                <a class="link-dark"
                                    href="{{ route('donor.details', [slug($bloodRequest->donor->name), $bloodRequest->donor->id]) }}">
                                    <div class="row">
                                        <div class="" style="text-align: right; width: 25%"><img
                                                src="{{ getImage('assets/images/donor/' . $bloodRequest->donor->image, imagePath()['donor']['size']) }}"
                                                alt="@lang('image')" class="img-fluid"
                                                style="border-radius: 50px; height: 40px; width: 40px"></div>
                                        <div class="" style="padding-left: 0px; line-height: 20px; width: 75%">
                                            {{ __($bloodRequest->donor->name) }}<br>{{ __($timeAgo) }}</div>
                                    </div>
                                </a>
                            </div>

                        </div>

                        <div class="card-content">
                            <p class="fw-bold text-center"
                                style="font-size: 14px;padding: 5px 0px 0px 0px; color: red; border-top: 1px solid lightgray;">
                                জরুরী প্রয়োজনে রক্তের সন্ধানে</p>
                            <ul class="caption-list-three">
                                <li>
                                    <span class="caption">বিভাগ</span>
                                    <span class="value">{{ __($bloodRequest->division->name) }}
                                    </span>
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
                                    <span class="caption">রক্তের পরিমাণ</span>
                                    <span class="value">{{ __($bloodRequest->amount_of_blood) }}</span>
                                </li>
                                <li>
                                    <span class="caption">রক্তদানের তারিখ</span>
                                    <span class="value">{{ showDateTime($bloodRequest->donate_date, 'd M Y') }}</span>
                                </li>
                                <li style="border-bottom: none">
                                    <span class="caption">রক্তদানের সময়</span>
                                    <span class="value">{{ __($bloodRequest->donate_time) }}</span>
                                </li>
                            </ul>

                            <span style="text-align: center; width: 100%; padding-top: 12px;"><a href="{{ route('bloodrequest.details',[$bloodRequest->id]) }}" class="button">View
                                    Details</a></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    </div>

    <div style="width: 100%; padding-top: 20px" class="text-center"><span><a href="{{ Route('bloodrequest')}}" class="custom-btn2"
                style="">সকল ব্লাড রিকোয়েস্ট পোস্টসমূহ</a></span></div>

    <!-- Swiper JS -->
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>

    <!-- JavaScript -->
    <!--Uncomment this line-->
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>
    <script>
        var swiper = new Swiper(".slide-content", {
            slidesPerView: 3,
            spaceBetween: 25,
            loop: true,
            centerSlide: 'true',
            fade: 'true',
            autoplay: true,
            grabCursor: 'true',
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                520: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 2,
                },
                950: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        });
    </script>

    {{-- <div class="container text-center my-3"">
            <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @foreach ($bloodRequests as $bloodRequest)
                        @php
                            $timestamp = $bloodRequest->created_at;
                            $timeAgo = Carbon\Carbon::parse($timestamp)->ago();
                        @endphp
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="row">
                                <div class="col-lg-11 col-md-11">
                                    <div class="blog-post" style="padding: 5px">
                                        <div class="row respalign">
                                        <div class="col-lg-3"><img
                                            src="{{ getImage('assets/images/donor/' . $bloodRequest->donor->image, imagePath()['donor']['size']) }}"
                                            alt="@lang('image')" class="img-fluid" style="border-radius: 50px; height: 40px; width: 40px"></div>
                                        <div class="col-lg-9" style="padding-left: 0px; line-height: 20px;">{{ __($bloodRequest->donor->name) }}<br>{{ __($timeAgo) }}</div>
                                        </div>
                                        <div class="blog-post__content" style="padding: 5px 0px 0px 0px;">
                                            <p class="fw-bold" style="font-size: 14px;padding: 5px 0px 0px 0px; color: red; border-top: 1px solid lightgray;">জরুরী প্রয়োজনে রক্তের সন্ধানে</p>
                                            <ul class="caption-list-three">
                                                <li>
                                                    <span class="caption">বিভাগ</span>
                                                    <span class="value">খুলনা</span>
                                                </li>
                                                <li>
                                                    <span class="caption">জেলা</span>
                                                    <span class="value">চুয়াডাঙ্গা</span>
                                                </li>
                                                <li>
                                                    <span class="caption">উপজেলা</span>
                                                    <span class="value">আলমডাঙ্গা</span>
                                                </li>
                                                <li>
                                                    <span class="caption">রক্তের গ্রুপ</span>
                                                    <span class="value">B+ (বি পজেটিভ)</span>
                                                </li>
                                                <li>
                                                    <span class="caption">রক্তের পরিমাণ</span>
                                                    <span class="value">১ ব্যাগ</span>
                                                </li>
                                                <li>
                                                    <span class="caption">রক্তদানের তারিখ</span>
                                                    <span class="value">25-10-2023</span>
                                                </li>
                                                <li style="border-bottom: none">
                                                    <span class="caption">রক্তদানের সময়</span>
                                                    <span class="value">04:45 PM</span>
                                                </li>
                                            </ul>
                                            <div style="width: 267px"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
                    data-bs-slide="prev" style="width: 3%; left: -28px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
                    data-bs-slide="next" style="width: 4%; right: -26px;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div> --}}

</section>
