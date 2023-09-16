@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $banner = getContent('banner.content', true);
    @endphp
    <section class="hero bg_img"
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
                            <select class="select" name="division_id" id="division-dropdown">
                                <option value="" disabled="" selected="">@lang('বিভাগ')</option>
                                @foreach ($divisions as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field">
                            <i class="las la-location-arrow"></i>
                            <select class="select" name="location_id" id="city-dropdown">
                                <option value="" disabled="" selected="">@lang('জেলা')</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <i class="las la-location-arrow"></i>
                            <select class="select" name="location_id" id="location-dropdown">
                                <option value="" disabled="" selected="">@lang('উপজেলা')</option>
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
    <div class="mt-3 text-center">
        @php
            echo advertisements('After_Banner1');
        @endphp
        @php
            echo advertisements('After_Banner2');
        @endphp
        @php
            echo advertisements('After_Banner3');
        @endphp
    </div>

    <div id="myModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title w-100 fw-bold bnfont text-danger">সাবধানতা</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bnfont text-center" style="padding-bottom: unset;">
                    <p>রক্তের বিনিময়ে কেউ টাকা চাইলে বুঝে নিবেন সে প্রতারক। প্রকৃত রক্তদাতা কখনো টাকার বিনিময়ে রক্তদান
                        করেন না।</p>

                </div>
                <hr>
                <span class="bnfont text-center fw-bold text-primary">লগইন করুন</span>
                <hr>
                <div class="form-wrapper">
                    <form action="{{ route('donor.login') }}" method="POST" class="cmn-form mt-30">
                        @csrf
                        <div class="form-group">
                            <label for="phone">@lang('Phone')</label>
                            <input type="text" name="phone" class="form-control b-radius--capsule" id="phone"
                                value="{{ old('phone') }}" placeholder="@lang('Phone No: 017xxxxxxxx')">

                        </div>
                        <div class="form-group">
                            <label for="pass">@lang('Password')</label>
                            <input type="password" name="password" class="form-control b-radius--capsule" id="pass"
                                placeholder="@lang('Enter your password')">

                        </div>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <label class="checkbox" style="color:#00B074;">
                                <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe">
                                Stay login
                                <span class="checkmark"></span>
                            </label>
                            <a href="{{ route('donor.password.reset') }}" class="text-muted text--small"><i
                                    class="las la-lock"></i>@lang('Forgot password?')</a>

                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="submit-btn mt-25 b-radius--capsule">@lang('Login') <i
                                    class="las la-sign-in-alt"></i></button>
                        </div>
                    </form>
                    <span class="bnfont">একাউন্ট নেই? <a style="font-size: 16px;" href="{{ Route('apply.donor') }}"><span
                                style="color:#00B074">নতুন একাউন্ট তৈরি করুন</span></a></span>
                </div>
            </div>
        </div>
    </div>
    </div>

    @php
        $popup = 1;
    @endphp

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
@push('script')
    @if ($popup == 1)
        <script>
            $(document).ready(function() {
                $("#myModal").modal("show");
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#division-dropdown').on('change', function() {
                var idDivision = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-cities') }}",
                    type: "POST",
                    data: {
                        division_id: idDivision,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city-dropdown').html(
                            '<option value="">-- জেলা সিলেক্ট করুন --</option>');
                        $.each(result.cities, function(key, value) {
                            $("#city-dropdown").append('<option value="' + value.id +
                                '">' + value.name + '</option>');
                        });
                        $('#location-dropdown').html(
                            '<option value="">-- Select City --</option>');
                    }
                })
            });

            $('#city-dropdown').on('change', function() {
                var idCity = this.value;
                $("#location-dropdown").html('');
                $.ajax({
                    url: "{{ url('api/fetch-locations') }}",
                    type: "POST",
                    data: {
                        city_id: idCity,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#location-dropdown').html(
                            '<option value="">-- উপজেলা সিলেক্ট করুন --</option>');
                        $.each(result.locations, function(key, value) {
                            $("#location-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                })
            });
        });
    </script>
@endpush
