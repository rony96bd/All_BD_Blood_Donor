@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pb-100 position-relative z-index section--bg" style="background-color: #FDE7EF">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('apply.donor.store') }}"
                        class="contact-form bg-white p-sm-5 p-3 rounded-3 position-relative" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-3">@lang('Personal Information')</h5>
                        <div class="row mb-4">
                            <!-- নাম ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="name">@lang('Name') <sup class="text--danger">*</sup></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    placeholder="@lang('Full name')" class="form--control" maxlength="80" required="">
                            </div>
                            <!-- লিঙ্গ ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="gender">@lang('Gender') <sup class="text--danger">*</sup></label>
                                <select name="gender" id="gender" class="select" required="">
                                    <option value="{{ old('gender') }}" selected="" disabled="">{{ old('gender') }}</option>
                                    <option value="1">@lang('Male')</option>
                                    <option value="2">@lang('Female')</option>
                                </select>
                            </div>
                            <!-- বিভাগ ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="division">@lang('Division') <sup class="text--danger">*</sup></label>
                                <select name="division" id="division-dropdown" class="select" required="">
                                    <option value="">-- বিভাগ সিলেক্ট করুন --</option>
                                    @foreach ($divisions as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- জেলা ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="city">@lang('District') <sup class="text--danger">*</sup></label>
                                <select name="city" id="city-dropdown" class="select" required="">
                                </select>
                            </div>

                            <!-- উপজেলা ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="location">@lang('Upazila') <sup class="text--danger">*</sup></label>
                                <select name="location" id="location-dropdown" class="select" required="">
                                </select>
                            </div>

                            {{-- <!-- ঠিকানা বিস্তারিত ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="address">@lang('Address') <sup class="text--danger">*</sup></label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}"
                                    placeholder="@lang('Enter Address')" class="form--control" maxlength="255" required="">
                            </div> --}}

                            <!-- ধর্ম ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="religion">@lang('Religion') <sup class="text--danger">*</sup></label>
                                <select name="religion" id="religion" class="select" required="">
                                    <option value="{{ old('religion') }}" selected="" disabled="">{{ old('religion') }}</option>
                                    <option value="Islam">@lang('Islam')</option>
                                    <option value="Hinduism">@lang('Hinduism')</option>
                                    <option value="Buddhism">@lang('Buddhism')</option>
                                    <option value="Christianity">@lang('Christianity')</option>
                                </select>
                            </div>

                            {{-- <!-- পেশা ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="profession">@lang('Profession') <sup class="text--danger">*</sup></label>
                                <input type="text" name="profession" id="profession" value="{{ old('profession') }}"
                                    placeholder="@lang('Enter Profession')" class="form--control" maxlength="80" required="">
                            </div> --}}

                            <!-- রক্তের গ্রুপ ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="blood_id">@lang('Blood Group') <sup class="text--danger">*</sup></label>
                                <select name="blood" id="blood_id" class="select" required="">
                                    <option value="" selected="" disabled="">@lang('Select One')</option>
                                    @foreach ($bloods as $blood)
                                        <option value="{{ $blood->id }}">{{ __($blood->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- শেষ রক্ত দানের তারিখ ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="last_donate">@lang('Last Donate') <sup class="text--danger">*</sup></label>
                                <input type="text" name="last_donate" id="last_donate" value="{{ old('donate') }}"
                                    data-language="en" placeholder="@lang('Last Blood Donate Date')"
                                    class="form--control datepicker-here">
                            </div>

                            <!-- জন্ম তারিখ ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="date_birth">@lang('Date Of Birth') <sup class="text--danger">*</sup></label>
                                <input type="text" id="date_birth" name="birth_date" value="{{ old('birth_date') }}"
                                    data-language="en" placeholder="@lang('Enter Date Of Birth')"
                                    class="form--control datepicker-here" maxlength="255" required="">
                            </div>

                            <!-- ইমেইল ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="email">@lang('Email') <sup class="text--danger">*</sup></label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="@lang('Enter Email')" class="form--control" maxlength="60"
                                    required="">
                            </div>

                            <!-- ফেসবুক আইডি ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="facebook">@lang('Facebook Url') <sup class="text--danger">*</sup></label>
                                <div class="custom-icon-field">
                                    <i class="lab la-facebook-f"></i>
                                    <input type="text" name="facebook" id="facebook" value="{{ old('facebook') }}"
                                        placeholder="@lang('Enter Facebook Url')" class="form--control" required="">
                                </div>
                            </div>

                            <!-- প্রোফাইল পিক ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="file">@lang('Image') <sup class="text--danger">*</sup></label>
                                <input type="file" id="file" name="image"
                                    class="form--control custom-file-upload" required="">
                            </div>

                            <!-- প্রাইমারী মোবাইল নং ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="phone">@lang('Phone') <sup class="text--danger">*</sup></label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    placeholder="@lang('Enter Phone')" class="form--control" maxlength="40"
                                    required="">
                            </div>

                            <!-- সেকেন্ডারী মোবাইল নং ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="phone2">@lang('Secondary Phone') <sup class="text--danger">*</sup></label>
                                <input type="text" name="phone2" id="phone2" value="{{ old('phone2') }}"
                                    placeholder="@lang('Enter Phone')" class="form--control" maxlength="40"
                                    required="">
                            </div>
                            <!-- পাসওয়ার্ড ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="password">@lang('Password') <sup class="text--danger">*</sup></label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}"
                                    placeholder="@lang('Enter Password')" class="form--control" maxlength="60"
                                    required="">
                            </div>

                            <!-- কনফার্ম পাসওয়ার্ড ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="password_confirmation">@lang('Confirm Password') <sup class="text--danger">*</sup></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="@lang('Enter Confirm Password')" class="form--control" maxlength="60" required="">
                            </div>
                            <!-- Accept Terms and Conditions ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label class="checkbox" style="color:#00B074;">
                                    <input type="checkbox" value="1" id="rememberMe" name="term"> <a target="_blank" href="../menu/terms-of-service/43"> Accept Terms and Conditions. </a>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--base w-100">@lang('Apply Now')</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    @include($activeTemplate . 'sections.faq')
@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/datepicker.min.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/datepicker.en.js') }}"></script>
@endpush
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
