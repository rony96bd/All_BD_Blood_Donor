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
                        <style>
                            /* The container */
                            .checkbox {
                                display: block;
                                position: relative;
                                padding-left: 28px;
                                margin-bottom: 12px;
                                cursor: pointer;
                                font-size: 22px;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                -ms-user-select: none;
                                user-select: none;
                            }

                            /* Hide the browser's default checkbox */
                            .checkbox input {
                                position: absolute;
                                opacity: 0;
                                cursor: pointer;
                                height: 0;
                                width: 0;
                            }

                            /* Create a custom checkbox */
                            .checkmark {
                                position: absolute;
                                top: 0;
                                left: 0;
                                height: 20px;
                                width: 20px;
                                background-color: #eee;
                                border: 1px solid darkgray;
                            }

                            /* On mouse-over, add a grey background color */
                            .checkbox:hover input~.checkmark {
                                background-color: #ccc;
                            }

                            /* When the checkbox is checked, add a blue background */
                            .checkbox input:checked~.checkmark {
                                background-color: #00B074;
                            }

                            /* Create the checkmark/indicator (hidden when not checked) */
                            .checkmark:after {
                                content: "";
                                position: absolute;
                                display: none;
                            }

                            /* Show the checkmark when checked */
                            .checkbox input:checked~.checkmark:after {
                                display: block;
                            }

                            /* Style the checkmark/indicator */
                            .checkbox .checkmark:after {
                                left: 8px;
                                top: 3px;
                                width: 5px;
                                height: 10px;
                                border: solid white;
                                border-width: 0 3px 3px 0;
                                -webkit-transform: rotate(45deg);
                                -ms-transform: rotate(45deg);
                                transform: rotate(45deg);
                            }
                        </style>
                        <label class="checkbox" style="color:#00B074;">
                            <input type="checkbox" value="remember-me" id="rememberMe" name="remember"> Stay login
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
