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
                {{-- <div class="col-lg-6 col-md-8 col-sm-9">
                    <ul class="header__info-list d-flex flex-wrap align-items-center justify-content-sm-start justify-content-center">
                        <li><a href="tel:{{__($contact->data_values->contact_number)}}"><i class="las la-phone"></i> {{__($contact->data_values->contact_number)}}</a></li>
                       <li><a href="mailto:{{__($contact->data_values->email_address)}}"><i class="las la-envelope"></i> {{__($contact->data_values->email_address)}}</a></li>
                    </ul>
                </div> --}}

                {{-- <div class="col-lg-6 col-md-4 col-sm-3 text-sm-end text-center">
                    <select class="language-select langSel">
                        @foreach ($language as $item)
                            <option value="{{$item->code}}" @if (session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                        @endforeach
                    </select>
                </div> --}}
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

                    <span class="login-menu"><a href="{{ route('donor.login') }}">Login</a>   <a
                            href="{{ route('apply.donor') }}">Signup</a></span>

                    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span style="font-size: 30px;"><i class="las la-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse mt-lg-0 mt-3" id="navbarSupportedContent">
                        <ul class="navbar-nav main-menu text-center">
                            <li style="border-bottom: 1px solid lightgray;"><a href="{{ route('home') }}">@lang('Home')</a></li>
                            @foreach ($pages as $k => $data)
                                <li style="border-bottom: 1px solid lightgray;"><a href="{{ route('pages', [$data->slug]) }}">{{ __($data->name) }}</a></li>
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
