@php
    $finddivision = $donor->division->id;
    $findcity = $donor->city->id;
    $findlocation = $donor->location->id;
    $findblood = $donor->blood->id;

    $relateddonor = getContent('latest_donor.content', true);
    $relateddonors = App\Models\Donor::where('status', 1)
        ->where('division_id', $finddivision)
        ->where('city_id', $findcity)
        ->where('location_id', $findlocation)
        ->where('blood_id', $findblood)
        ->orderBy('id', 'DESC')
        ->with('blood', 'city', 'division', 'location')
        ->limit(6)
        ->get();
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $breadcrumb = getContent('breadcrumb.content', true);
    @endphp
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 d-md-block d-none">
                    @php
                        echo advertisements('Single_Donor_Left');
                    @endphp
                </div>
                <div class="col-xl-6 col-lg-9 col-md-8 bg-light rounded-2">
                    <div class="row gy-4">
                        <div class="col-lg-12 col-md-12 col-sm-6 text-center">
                            <img class="img-ext shadow p-1 bg-white"
                                src="{{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }}"
                                alt="@lang('image')"><br>
                            <span style="margin-top: 10px">
                                <h3 class="text-danger">{{ __($donor->name) }}</h3>
                            </span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6">
                            <ul class="caption-list-two mt-4"
                                style="background-color: #FFDADC;
                                        margin-left: 10px;
                                        margin-right: 10px;
                                        margin-bottom: 20px;">
                                <li>
                                    <span class="caption">Name</span>
                                    <span class="value">{{ __($donor->name) }}</span>
                                </li>
                                <li>
                                    <span class="caption">Blood Group</span>
                                    <span class="value">{{ __($donor->blood->name) }}</span>
                                </li>
                                <li>
                                    <span class="caption">Last Donate</span>
                                    <span class="value">{{ showDateTime($donor->last_donate, 'd M Y') }}</span>
                                </li>

                                <li>
                                    <span class="caption">Gender</span>
                                    <span class="value">
                                        @if ($donor->gender == 1)
                                            @lang('Male')
                                        @else
                                            @lang('Female')
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span class="caption">Date of Birth</span>
                                    <span class="value">{{ showDateTime($donor->birth_date, 'd M Y') }}</span>
                                </li>
                                <li>
                                    <span class="caption">Age</span>
                                    <span class="value">{{ Carbon\Carbon::parse($donor->birth_date)->age }}
                                        @lang('Years')</span>
                                </li>
                                <li>
                                    <span class="caption">Religion</span>
                                    <span class="value">{{ __($donor->religion) }}</span>
                                </li>
                                <li>
                                    <span class="caption">Profession</span>
                                    <span class="value">{{ __($donor->profession) }}</span>
                                </li>
                                <li>
                                    <span class="caption">Division</span>
                                    <span class="value">{{ __($donor->division->name) }}</span>
                                </li>
                                <li>
                                    <span class="caption">District</span>
                                    <span class="value">{{ __($donor->city->name) }}</span>
                                </li>
                                <li>
                                    <span class="caption">Upazila</span>
                                    <span class="value">{{ __($donor->location->name) }}</span>
                                </li>
                            </ul>
                            <span style="padding-left: 20px; font-weight: bold;">Contact Details</span><br>
                            <span style="padding-left: 20px; color: #00B074;"><a href="{{ route('donor.login') }}">দেখার
                                    জন্য লগইন করুন</a></span>
                            <ul class="caption-list-two"
                                style="background-color: #FFDADC; margin-left: 10px; margin-right: 10px; margin-bottom: 20px;">
                                <li>
                                    <span class="caption">Email</span>
                                    @if (auth()->guard('donor')->check())
                                        <span class="value">{{ __($donor->email) }} <a target="_blank"
                                                href="https://mail.google.com/mail/?view=cm&fs=1&to={{ __($donor->email) }}"><i
                                                    class="fa-regular fa-envelope"></i> Email</a></span>
                                    @else
                                        <span class="value">xxxxxxxxxx@gmail.com <p class="popup" style="color: #00B074;"
                                                onclick="myFunction()"> <i class="fa-regular fa-envelope"></i></i> Email
                                                <span class="popuptext" id="myPopup">
                                                    ইমেইল দেখতে <a href="{{ route('apply.donor') }}"> Signup </a> করে <a
                                                        href="{{ route('donor.login') }}"> Login </a> করুন</a>
                                                </span>
                                            </p></span>
                                    @endif
                                </li>

                                <li>
                                    <span class="caption">Phone</span>
                                    @if (auth()->guard('donor')->check())
                                        <span class="value">{{ __($donor->phone) }} <a
                                                href="tel:{{ __($donor->phone) }}"> <i class="fa fa-phone"></i> কল
                                                দিন</a></span>
                                    @else
                                        <span class="value">01xxxxxxxxx  <p class="popup" style="color: #00B074;"
                                                onclick="myFunction2()"> <i class="fa fa-phone"></i> কল দিন
                                                <span class="popuptext" id="myPopup2">
                                                    মোবাইল নম্বর দেখতে <a href="{{ route('apply.donor') }}"> Signup </a>
                                                    করে <a href="{{ route('donor.login') }}"> Login </a> করুন</a>
                                                </span>
                                    @endif
                                </li>
                                <li>
                                    <span class="caption">Secondary Phone</span>
                                    @if (auth()->guard('donor')->check())
                                        <span class="value">{{ __($donor->phone2) }} <a
                                                href="tel:{{ __($donor->phone2) }}"> <i class="fa fa-phone"></i> কল
                                                দিন</a></span>
                                    @else
                                        <span class="value">01xxxxxxxxx <p class="popup" style="color: #00B074;"
                                                onclick="myFunction3()"> <i class="fa fa-phone"></i> কল দিন
                                                <span class="popuptext" id="myPopup3">
                                                    মোবাইল নম্বর দেখতে <a href="{{ route('apply.donor') }}"> Signup </a>
                                                    করে <a href="{{ route('donor.login') }}"> Login </a> করুন</a>
                                                </span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="fb-comments" data-href="{{ route('donor.details', [slug($donor->name), $donor->id]) }}"
                        data-width="" data-numposts="5"></div>
                    @push('fbComment')
                        @php echo loadFbComment() @endphp
                    @endpush
                </div>
                <div class="col-xl-3 d-xl-block d-none">
                    @php
                        echo advertisements('Single_Donor_Right');
                    @endphp
                </div>
            </div>
        </div><br />
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-header text-center">
                        <h2 class="section-title">Related Donor</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center gy-4">
                @forelse($relateddonors as $donor)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="donor-item has--link" style="font-family: 'Noto Sans Bengali',  sans-serif;">
                            <div class="donor-item__thumb">
                                <img style="border-radius: 5px;"
                                    src="{{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }}"
                                    alt="@lang('image')">
                            </div>
                            <div class="donor-item__content">
                                <h5 style="color: #fff; font-weight: 600;" class="donor-item__name">
                                    {{ __($donor->name) }}
                                </h5>
                                <ul class="donor-item__list">
                                    <li class="donor-item__list">
                                        <i class="las la-tint"></i> @lang('ব্লাড গ্রুপ') :
                                        <span style="color: red">
                                            {{ __($donor->blood->name) }}
                                            @if ($donor->blood->name == 'A+')
                                                (এ পজেটিভ)
                                            @elseif ($donor->blood->name == 'A-')
                                                (এ নেগেটিভ)
                                            @elseif ($donor->blood->name == 'B+')
                                                (বি পজেটিভ)
                                            @elseif ($donor->blood->name == 'B-')
                                                (বি নেগেটিভ)
                                            @elseif ($donor->blood->name == 'AB+')
                                                (এবি পজেটিভ)
                                            @elseif ($donor->blood->name == 'AB-')
                                                (এবি নেগেটিভ)
                                            @elseif ($donor->blood->name == 'O+')
                                                (ও পজেটিভ)
                                            @elseif ($donor->blood->name == 'O-')
                                                (ও নেগেটিভ)
                                            @else
                                            @endif
                                        </span>
                                    </li>
                                    <li>
                                        সর্বশেষ রক্ত প্রদান: {{ showDateTime($donor->last_donate, 'd M Y') }}
                                    </li>
                                    <li class="text-truncate" style="font-weight: 600">
                                        <i class="las la-map-marker-alt"></i>
                                        {{ __($donor->location->name) }}, {{ __($donor->city->name) }}, {{ __($donor->division->name) }}
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-7 text-white"><span><a
                                                href="{{ route('donor.details', [slug($donor->name), $donor->id]) }}"
                                                class="custom-btn">View Details <i
                                                    class="fa fa-angle-double-right"></i></a></span>
                                    </div>
                                    <div class="col-5" style="text-align: right"><i class="las la-eye"></i>
                                        {{ __($donor->click) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center">{{ $emptyMessage }}</h3>
                @endforelse
            </div>
        </div>
    </section>
@endsection
