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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-6 text-center">
                            <img class="img-ext shadow p-1 bg-white"
                                src="{{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }}"
                                alt="@lang('image')"><br>
                            <span style="margin-top: 10px">
                                <h3 class="text-danger">{{ __($donor->name) }}</h3>
                                <br />
                                {{ __($donor->about_me) }}
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
                                    <span class="value" style="color: red">
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
                                @if ($donor->last_donate == null)
                                @else
                                    <li>
                                        <span class="caption">Last Donate</span>
                                        <span class="value">{{ showDateTime($donor->last_donate, 'd M Y') }}</span>
                                    </li>
                                @endif
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
                            @if (auth()->guard('donor')->check())
                            @else
                                <span style="padding-left: 20px; color: #00B074;"><a
                                        href="{{ route('donor.login') }}">দেখার
                                        জন্য লগইন করুন</a></span>
                            @endif

                            <ul class="caption-list-two"
                                style="background-color: #FFDADC; margin-left: 10px; margin-right: 10px; margin-bottom: 20px;">
                                <li>
                                    <span class="caption"><i class="fa-brands fa-facebook"></i> Facebook</span>
                                    @if (auth()->guard('donor')->check())
                                        <span class="value"><a target="_blank" href="{{ __($donor->facebook) }}">{{ __($donor->facebook) }} </a></span>
                                    @else
                                        <span class="value">
                                            <p class="popup" style="color: #00B074;" onclick="myFunction1()">
                                                facebook.com/xxxxx
                                                <span class="popuptext" id="myPopup1">
                                                    ফেসবুক লিংক দেখতে <a href="{{ route('apply.donor') }}"> Signup </a> করে
                                                    <a href="{{ route('donor.login') }}"> Login </a> করুন</a>
                                                </span>
                                            </p>
                                        </span>
                                    @endif
                                </li>
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
                    {{-- <div class="fb-comments" data-href="{{ route('donor.details', [slug($donor->name), $donor->id]) }}"
                        data-width="" data-numposts="5"></div> --}}
                    {{-- @push('fbComment')
                        @php echo loadFbComment() @endphp
                    @endpush --}}

                    {{-- Comments Section --}}
                    <style>
                        div#social-links {
                            margin: 0 auto;
                            max-width: 500px;
                        }

                        div#social-links ul li {
                            display: inline-block;
                        }

                        div#social-links ul li a {
                            padding: 5px 6px 0px 6px;
                            border: 1px solid #ccc;
                            margin: 1px;
                            font-size: 15px;
                            background-color: beige;
                            border-radius: 4px;
                        }

                        .fa-square-facebook {
                            color: #3B5998
                        }

                        .fa-twitter {
                            color: #33CCFF;
                        }

                        .fa-linkedin {
                            color: #4875B4;
                        }

                        .fa-telegram {
                            color: rgb(51, 144, 236);
                        }

                        .fa-whatsapp {
                            color: #00a884;
                        }
                    </style>
                    <div class="row">
                        <div class="custom-comments bnfont" id="custom-comments">
                            <div class="container" style="padding: 0 0 0 0;">
                                <div class="row" style="margin-top: 8px;">
                                    <div class="col-3">
                                        <p class="mt-2 mb-2 text-danger font-weight-bold"> <i class="fa-solid fa-eye"></i>
                                            {{ __($donor->click) }}</p>
                                    </div>
                                    <div class="col-9"><span style="float: right">
                                            @php
                                                $shareComponent = \Share::currentPage()
                                                    ->facebook()
                                                    ->twitter()
                                                    ->linkedin()
                                                    ->whatsapp();
                                            @endphp
                                            {!! $shareComponent !!}
                                        </span></div>
                                </div>
                            </div>
                            <form action="{{ url('comments') }}" method="post">
                                @csrf
                                <input type="hidden" name="donordetails_id" value="{{ __($donor->id) }}" />
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

                            <div class="custom-review-count">
                                @forelse ($donor->comments->sortByDesc('created_at') as $comment)
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
                                                                <h5 class="text-danger">{{ $comment_donor_details->name }}
                                                                </h5>
                                                                <p style="font-size: 12px">{{ $ctimeAgo }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="comments-section-des" style="margin-left: 48px;">
                                                        <p> - {{ $comment->comment_body }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (auth()->guard('admin')->check())
                                                <div style="position: absolute; top: 8px; right: 16px; font-size: 18px;">
                                                    <button type="button" class="deleteComment btn"
                                                        value="{{ $comment->id }}">
                                                        <i style="color: red" class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endif

                                            @if (auth()->guard('donor')->check() &&
                                                    auth()->guard('donor')->user()->id == $comment->donor_id)
                                                <div style="position: absolute; top: 8px; right: 16px; font-size: 18px;">
                                                    <button type="button" class="donordeleteComment btn"
                                                        value="{{ $comment->id }}">
                                                        <i style="color: red" class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endif
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
                        <h4 style="font-weight: bold">Related Donor</h4>
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
                                <h5 style="font-weight: 600;" class="donor-item__name">
                                    {{ __($donor->name) }}
                                </h5>
                                <ul class="donor-item__list">
                                    <li class="donor-item__list">
                                        <i style="color: red" class="las la-tint"></i> @lang('ব্লাড গ্রুপ') :
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
                                    {{-- <li>
                                        সর্বশেষ রক্ত প্রদান: {{ showDateTime($donor->last_donate, 'd M Y') }}
                                    </li> --}}
                                    <li class="text-truncate" style="font-weight: 600; margin-bottom: 3px">
                                        <i style="color: #00B074" class="las la-map-marker-alt"></i>
                                        {{ __($donor->location->name) }}, {{ __($donor->city->name) }},
                                        {{ __($donor->division->name) }}
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
            $(document).on('click', '.donordeleteComment', function() {
                if (confirm('Are you sure you want to delete your comment?')) {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/donor-delete-comment') }}",
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
