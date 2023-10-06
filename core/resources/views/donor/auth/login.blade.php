@php
    $footer = getContent('footer.content', true);
    $contact = getContent('contact_us.content', true);
    $policys = getContent('policy_pages.element', false);
@endphp
@extends('donor.layouts.master')
@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close"
                        data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <style>
        .site-logo img {
            max-width: 10.9375rem;
            max-height: 3.75rem;
        }

        @media (max-width: 1199px) {
            .site-logo img {
                max-width: 9.375rem;
            }
        }

        .site-logo.site-title {
            font-size: 1.5rem;
        }

        @media (min-width: 1400px) {

            .container2,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 1320px;
            }
        }
    </style>
    <div class="container2">
        <nav id="navbar_top" class="navbar navbar-expand-login navbar-light bg-light">
            <a class="site-logo site-title" href="{{ route('home') }}">
                <img src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}" alt="@lang('logo')">
            </a>


            <button class="navbar-toggler" style="border: none;" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="login-menu"><a href="{{ route('donor.login') }}">Login</a>   <a
                        href="{{ route('apply.donor') }}">Signup</a></span>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto text-center" style="font-weight:bold">
                    <li class="nav-item active" style="border-bottom: 1px solid lightgray;">
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active" style="border-bottom: 1px solid lightgray;">
                        <a class="nav-link" href="./about-us">About <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active" style="border-bottom: 1px solid lightgray;">
                        <a class="nav-link" href="{{ route('donor.list') }}">Donor <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active" style="border-bottom: 1px solid lightgray;">
                        <a class="nav-link" href="{{ route('blog') }}">Blog <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('contact') }}">Contact <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="page-wrapper default-version">
        <div class="form-area"
            style="background: rgb(0,236,255); background: linear-gradient(117deg, rgba(0,236,255,1) 0%, rgba(173,0,255,1) 100%);">
            <div class="form-wrapper">
                <h4 class="logo-text mb-15">@lang('Welcome to') <strong>{{ __($general->sitename) }}</strong></h4>
                <p class="bnfont" style="font-size: 18px; font-weight: bold;">যদি হই <span
                        style="color: red;">রক্তদাতা</span>, জয় করবো মানবতা।</p>
                {{-- <p>{{ __($pageTitle) }} @lang('to') {{ __($general->sitename) }} @lang('dashboard')</p> --}}
                <form action="{{ route('donor.login.save') }}" method="POST" class="cmn-form mt-30">
                    @csrf
                    <div class="form-group">
                        <label for="phone">@lang('Phone')</label>
                        <input type="text" name="phone" class="form-control b-radius--capsule" id="phone"
                            value="{{ old('phone') }}" placeholder="@lang('Phone No: 017xxxxxxxx')">
                        <i class="las la-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label for="pass">@lang('Password')</label>
                        <input type="password" name="password" class="form-control b-radius--capsule" id="pass"
                            placeholder="@lang('Enter your password')">
                        <i class="las la-lock input-icon"></i>
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <label class="checkbox" style="color:#00B074;">
                            <input type="checkbox" value="remember" id="rememberMe" name="remember"> Stay login
                            <span class="checkmark"></span>
                        </label>
                        <a href="{{ route('donor.password.reset') }}" class="text-muted text--small"><i
                                class="las la-lock"></i>@lang('Forgot password?')</a>

                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Login') <i
                                class="las la-sign-in-alt"></i></button>
                    </div>
                </form>
                <span class="bnfont">একাউন্ট নেই? <a style="font-size: 16px;" href="{{ Route('apply.donor') }}"><span
                            style="color:#00B074">নতুন একাউন্ট তৈরি করুন</span></a></span>
            </div>

        </div><!-- login-area end -->
    </div>
    <footer class="footer img-overlay"
        style="background-image: url({{ getImage('assets/images/frontend/footer/' . $footer->data_values->background_image, '1920x921') }}); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="footer__top">
            <div class="container">
                <div class="row gy-5 justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-sm-8 order-lg-1 order-1">
                        <div class="footer-widget">
                            <a style="background-color: white;
                        border-radius: 10px;
                        padding: 24px 9px 24px 9px;"
                                href="{{ route('home') }}" class="footer-logo"><img
                                    src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                                    alt="@lang('logo')"></a>
                            <p class="mt-3">{{ __($footer->data_values->title) }}</p>

                            <br />
                            <span class="text-light mb1" style="font-size: 14px">POWERED BY <i
                                    class="fa fa-chevron-circle-right" aria-hidden="true"></i></span><span
                                style="color: #00e999"> MA GROUP</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-sm-6 order-lg-2 order-3">
                        <div class="footer-widget">
                            <h4 class="footer-widget__title">@lang('User Reading')</h4>
                            <ul class="footer-links-list">
                                @foreach ($policys as $policy)
                                    <li><a
                                            href="{{ route('footer.menu', [slug($policy->data_values->title), $policy->id]) }}">{{ __($policy->data_values->title) }}</a>
                                    </li>
                                @endforeach
                                <li><a href="./about-us">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-sm-6 order-lg-3 order-4">
                        <div class="footer-widget">
                            <h4 class="footer-widget__title">@lang('Join Now')</h4>
                            <ul class="footer-links-list">
                                <li><a href="{{ route('donor.login') }}">@lang('Login')</a></li>
                                <li><a href="{{ route('apply.donor') }}">@lang('Signup')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-4 order-lg-4 order-2">
                        <div class="footer-widget">
                            <h4 class="footer-widget__title">@lang('Contact Us')</h4>
                            <ul>
                                <li><i class="las la-envelope"></i>  <a
                                        href="mailto:{{ __($contact->data_values->email_address) }}">{{ __($contact->data_values->email_address) }}</a>
                                </li>
                                <li><i class="las la-envelope"></i>  <a
                                        href="mailto:{{ __($contact->data_values->email_address) }}">{{ __($contact->data_values->email_address) }}</a>
                                </li>
                                <li><i class="las la-phone-volume"></i>  <a
                                        href="tel:{{ __($contact->data_values->contact_number) }}">{{ __($contact->data_values->contact_number) }}</a>
                                </li>
                                <hr>
                                <li>Follow Us</li>
                                <li>
                                    <a href="https://facebook.com/" style="margin: 0 6px;" target="_blank">
                                        <i class="fa-brands fa-square-facebook"></i>
                                    </a>
                                    <a href="#" style="margin: 0 6px;" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                    <a href="#" style="margin: 0 6px;" target="_blank">
                                        <i class="fa-brands fa-linkedin"></i>
                                    </a>
                                    <a href="#" style="margin: 0 6px;" target="_blank">
                                        <i class="fa-brands fa-pinterest"></i>
                                    </a>
                                    <a href="#" style="margin: 0 6px;" target="_blank">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>@lang('Copyright') © {{ Carbon\Carbon::now()->format('Y') }} <a href="{{ route('home') }}"
                                class="text--base"> {{ __($general->sitename) }} </a> @lang('All Right Reserved')</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.getElementById('navbar_top').classList.add('fixed-top');
                // add padding top to show content behind navbar
                navbar_height = document.querySelector('.navbar').offsetHeight;
                document.body.style.paddingTop = navbar_height + 'px';
            } else {
                document.getElementById('navbar_top').classList.remove('fixed-top');
                // remove padding top from body
                document.body.style.paddingTop = '0';
            }
        });
    });
</script>
