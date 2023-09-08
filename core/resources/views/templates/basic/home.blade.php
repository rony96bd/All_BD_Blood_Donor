@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $banner = getContent('banner.content', true);
    @endphp

    <style>
        .anym {
            animation-name: example;
            animation-duration: 2s;
        }

        @keyframes example {
            25% {
                background-color: yellow;
                left: 200px;
                top: 0px;
            }

            100% {
                background-color: red;
                left: 0px;
                top: 0px;
            }
        }
    </style>
    <section class="hero bg_img anym"
        style="background-image: url({{ getImage('assets/images/frontend/banner/' . @$banner->data_values->background_image, '1920x1280') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-lg-8 text-center">
                    <h2 class="hero__title">{{ __(@$banner->data_values->heading) }}</h2>
                    <span
                        style="color: red;
                font-size: 40px;
                font-weight: bold;
                line-height: initial;
                font-family: 'Bensen'; text-shadow: -1px -1px 0 #fff, 0 -1px 0 #fff, 1px -1px 0 #fff, 1px 0 0 #fff, 1px 1px 0 #fff, 0 1px 0 #fff, -1px 1px 0 #fff, -1px 0 0 #fff;">বাংলাদেশের
                        সকল রক্তদাতাদের খুঁজুন এখানে</span>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-xxl-12 col-xl-12 col-lg-10">
                    <form method="GET" action="{{ route('donor.search') }}" class="hero__blood-search-form">
                        <div class="input-field">
                            <i class="las la-tint"></i>
                            <select name="blood_id">
                                <option value="" selected="" disabled="">@lang('রক্তের গ্রুপ')</option>
                                @foreach ($bloods as $blood)
                                    <option value="{{ __($blood->id) }}">{{ __($blood->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <i class="las la-location-arrow"></i>
                            <select name="city_id">
                                <option value="" selected="" disabled="">@lang('বিভাগ')</option>
                                @foreach ($cities as $city)
                                    <option value="{{ __($city->id) }}">{{ __($city->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <i class="las la-location-arrow"></i>
                            <select name="city_id">
                                <option value="" selected="" disabled="">@lang('জেলা')</option>
                                @foreach ($cities as $city)
                                    <option value="{{ __($city->id) }}">{{ __($city->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <i class="las la-location-arrow"></i>
                            <select name="city_id">
                                <option value="" selected="" disabled="">@lang('উপজেলা')</option>
                                @foreach ($cities as $city)
                                    <option value="{{ __($city->id) }}">{{ __($city->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="btn-area">
                            <button type="submit" class="btn btn-md btn--base"><i class="las la-search"></i>
                                @lang('খুঁজুন')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="my-5 text-center">
        @php
            echo advertisements('ad');
        @endphp
        <div>

            @if ($sections->secs != null)
                @foreach (json_decode($sections->secs) as $sec)
                    @include($activeTemplate . 'sections.' . $sec)
                @endforeach
            @endif
        @endsection
