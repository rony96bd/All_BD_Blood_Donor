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

<section class="pt-50 pb-50 position-relative z-index-2 overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header mb-4">
                    <h2 class="section-title">ব্লাড রিকোয়েস্ট পোস্টসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="container text-center my-3"">
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
        </div>
    </div>
</section>
