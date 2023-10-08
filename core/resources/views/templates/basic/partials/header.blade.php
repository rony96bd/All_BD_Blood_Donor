@php
    $contact = getContent('contact_us.content', true);
@endphp

<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row align-items-center gy-2"
                style="font-family: 'Noto Sans Bengali', sans-serif; font-size: 20px;">
                <div class="adv2 text-center">
                    @php
                        echo advertisements('Front_Top');
                    @endphp
                </div>
                <div class="col top-nav-date">
                    @php
                        use Rajurayhan\Bndatetime\BnDateTimeConverter; // on Top

                        $dateConverter = new BnDateTimeConverter();
                        $date_now = date('Y-m-d');
                        $dateConverter->getConvertedDateTime('2018-09-07 12:19:50 pm', 'EnBn', ''); // Friday 23rd Bhadra 1425 12:19:50 pm
                        $dateConverter->getConvertedDateTime('2018-09-07 12:19:50 pm', 'BnBn', ''); // শুক্রবার ২৩শে ভাদ্র ১৪২৫ দুপুর ১২:১৯:৫০
                        echo $dateConverter->getConvertedDateTime($date_now, 'BnEn', 'l, jS F Y ইং'); // শুক্রবার ৭ই সেপ্টেম্বর ২০১৮ দুপুর ১২:১৯:৫০
                        $dateConverter->getConvertedDateTime('2018-09-07 12:19:50 pm', 'EnEn', ''); // Friday 7th September 2018 12:19:50 PM
                    @endphp
                </div>
                <div class="top-nav-bar adv text-end hidden-lg" style="width: 320px; height: 50px">
                    @php
                        echo advertisements('Front_Top');
                    @endphp
                </div>
            </div>
        </div>
    </div>
    <nav id="navbar_top" style="background-color: #fff;">
        <div class="header__bottom">
            <div class="container">
                <nav class="navbar navbar-expand-xl p-0 align-items-center">
                    <a class="site-logo site-title" href="{{ route('home') }}">
                        <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                            alt="@lang('logo')">
                    </a>
                    <style>
                        .dropdown ul li a {
                            color: #333;
                        }

                        .dropdown ul li a:hover {
                            color: #FFF;
                        }

                        .dropdown ul li:hover {
                            background-color: #00b074;
                            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
                        }
                    </style>
                    <span>
                        @if (auth()->guard('donor')->check())
                            <span class="dropdown">
                                <button style="background: none;" class="dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img style="height: 45px; border-radius: 50px; width: 45px; border: 1px solid lightgray;"
                                        src="{{ getImage('assets/images/donor/' .auth()->guard('donor')->user()->image) }}"
                                        alt="Donor Image">
                                    <span class="donorname"> {{ auth()->guard('donor')->user()->name }} </span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item">
                                        <a href="{{ route('donor.dashboard') }}" class="nav-link ">
                                            <i class="fa-solid fa-gauge"></i>
                                            <span class="menu-title">@lang('My Profile')</span>
                                        </a>
                                    </li>
                                    <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item">
                                        <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                                            <i class="fa-solid fa-user"></i>
                                            <span class="menu-title">@lang('Blood Request')</span>
                                        </a>
                                    </li>
                                    <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item">
                                        <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span class="menu-title">@lang('Edit Profile')</span>
                                        </a>
                                    </li>
                                    <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item">
                                        <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                                            <i class="fa-solid fa-key"></i>
                                            <span class="menu-title">@lang('Change Password')</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-menu-item">
                                        <a href="{{ route('donor.logout') }}" class="nav-link ">
                                            <i class="fa fa-sign-out"></i>
                                            <span class="menu-title">@lang('Sign Out')</span>
                                        </a>
                                    </li>
                                </ul>
                            </span>
                        @else
                            <p class="login-menu2"><a href="{{ route('donor.login') }}">Login</a>   <a
                                    href="{{ route('apply.donor') }}">Signup</a></p>
                        @endif
                        <span>
                            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span style="font-size: 30px;"><i class="las la-bars"></i></span>
                            </button>
                        </span>
                    </span>

                    <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                        <ul class="navbar-nav main-menu text-center">
                            <li style="border-bottom: 1px solid lightgray;"><a
                                    href="{{ route('home') }}">@lang('Home')</a></li>
                            @foreach ($pages as $k => $data)
                                <li style="border-bottom: 1px solid lightgray;"><a
                                        href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
                            @endforeach
                        </ul>
                        {{-- <div class="nav-right">
                        <a href="{{ route('apply.donor') }}" class="btn btn-md btn--base d-flex align-items-center"><i
                                class="las la-user fs--18px me-2"></i> @lang('Apply as a Donor')</a>
                    </div> --}}
                    </div>
                </nav>
            </div>
        </div>
    </nav>
</header>
