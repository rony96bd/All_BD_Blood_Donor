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

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
@push('script')
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

