@foreach ($bloodRequests as $bloodRequest)
    @php
        $timestamp = $bloodRequest->created_at;
        $timeAgo = Carbon\Carbon::parse($timestamp)->ago();
    @endphp
    <div class="col-lg-6">
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

                <span style="text-align: center; width: 100%; padding-top: 12px;"><a
                        href="{{ route('bloodrequest.details', [$bloodRequest->id]) }}" class="button">View
                        Details</a></span>
            </div>
        </div>
    </div>
@endforeach
