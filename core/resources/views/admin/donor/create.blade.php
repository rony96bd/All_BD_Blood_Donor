@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.donor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="background-image: url({{ getImage(imagePath()['donor']['path'], imagePath()['donor']['size']) }})">
                                                    <button type="button" class="remove-image"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'),
                                                        @lang('jpg')</b>. @lang('Image will be resized into')
                                                    {{ imagePath()['donor']['size'] }}@lang('px'). </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- নাম ----------------------------------->
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Name')</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Enter Full Name')" maxlength="80"
                                        required="">
                                </div>

                                <!-- লিঙ্গ ----------------------------------->
                                <div class="form-group">
                                    <label for="gender" class="font-weight-bold">@lang('Gender')</label>
                                    <select name="gender" id="gender" class="form-control form-control-lg"
                                        required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        <option value="1">@lang('Male')</option>
                                        <option value="2">@lang('Female')</option>
                                    </select>
                                </div>
                                <!-- বিভাগ ----------------------------------->
                                <div class="form-group">
                                    <label for="division" class="font-weight-bold">@lang('Division') <sup
                                            class="text--danger">*</sup></label>
                                    <select name="division" id="division-dropdown"
                                        class="select form-control form-control-lg" required="">
                                        <option value="">-- বিভাগ সিলেক্ট করুন --</option>
                                        @foreach ($divisions as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- জেলা ----------------------------------->
                                <div class="form-group">
                                    <label for="city" class="font-weight-bold">@lang('City')</label>
                                    <select name="city" id="city-dropdown" class="select form-control form-control-lg"
                                        required="">
                                        <option value="">-- জেলা --</option>
                                    </select>
                                </div>

                                <!-- উপজেলা ----------------------------------->
                                <div class="form-group">
                                    <label for="location" class="font-weight-bold">@lang('Location')</label>
                                    <select name="location" id="location-dropdown"
                                        class="select form-control form-control-lg" required="">
                                        <option value="">-- উপজেলা --</option>
                                    </select>
                                </div>

                                <!-- রক্তের গ্রুপ ----------------------------------->
                                <div class="form-group">
                                    <label for="blood_id" class="font-weight-bold">@lang('Blood Group')</label>
                                    <select name="blood" id="blood_id" class="form-control form-control-lg"
                                        required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach ($bloods as $blood)
                                            <option value="{{ $blood->id }}">{{ __($blood->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- ঠিকানা বিস্তারিত ----------------------------------->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="address" class="font-weight-bold">@lang('Address') <sup
                                        class="text--danger">*</sup></label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}"
                                    placeholder="@lang('Enter Address')" class="form-control form-control-lg" maxlength="255"
                                    required="">
                            </div>
                        </div>

                        <div class="row">
                            <!-- ধর্ম ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="religion" class="font-weight-bold">@lang('Religion') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="text" name="religion" id="religion" value="{{ old('religion') }}"
                                        placeholder="@lang('Enter Religion')" class="form-control form-control-lg"
                                        maxlength="40" required="">
                                </div>
                            </div>
                            <!-- পেশা ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="profession" class="font-weight-bold">@lang('Profession') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="text" name="profession" id="profession"
                                        value="{{ old('profession') }}" placeholder="@lang('Enter Profession')"
                                        class="form-control form-control-lg" maxlength="80" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- শেষ রক্ত দানের তারিখ ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_donate" class="font-weight-bold">@lang('Last Donate') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="text" name="last_donate" id="last_donate"
                                        value="{{ old('donate') }}" data-language="en" placeholder="@lang('Last Blood Donate Date')"
                                        class="form-control form-control-lg datepicker-here">
                                </div>

                            </div>
                            <!-- জন্ম তারিখ ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date_birth" class="font-weight-bold">@lang('Date Of Birth') <sup class="text--danger">*</sup></label>
                                    <input type="text" id="date_birth" name="birth_date"
                                        value="{{ old('birth_date') }}" data-language="en"
                                        placeholder="@lang('Enter Date Of Birth')" class="form-control form-control-lg datepicker-here"
                                        maxlength="255" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- ইমেইল ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">@lang('Email') <sup class="text--danger">*</sup></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        placeholder="@lang('Enter Email')" class="form-control form-control-lg" maxlength="60"
                                        required="">
                                </div>
                            </div>

                            <!-- ফেসবুক আইডি ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="facebook" class="font-weight-bold">@lang('Facebook Url') <sup class="text--danger">*</sup></label>
                                    <div class="custom-icon-field">
                                        <input type="text" name="facebook" id="facebook"
                                            value="{{ old('facebook') }}" placeholder="@lang('Enter Facebook Url')"
                                            class="form-control form-control-lg" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- প্রাইমারী মোবাইল নং ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone" class="font-weight-bold">@lang('Phone') <sup class="text--danger">*</sup></label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                        placeholder="@lang('Enter Phone')" class="form-control form-control-lg" maxlength="40"
                                        required="">
                                </div>
                            </div>
                            <!-- সেকেন্ডারী মোবাইল নং ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone2" class="font-weight-bold">@lang('Secondary Phone') <sup class="text--danger">*</sup></label>
                                    <input type="text" name="phone2" id="phone2" value="{{ old('phone2') }}"
                                        placeholder="@lang('Enter Phone')" class="form-control form-control-lg" maxlength="40"
                                        required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- পাসওয়ার্ড ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="font-weight-bold">@lang('Password') <sup class="text--danger">*</sup></label>
                                    <input type="password" name="password" id="password" value="{{ old('password') }}"
                                        placeholder="@lang('Enter Password')" class="form-control form-control-lg" maxlength="60"
                                        required="">
                                </div>
                            </div>
                            <!-- কনফার্ম পাসওয়ার্ড ----------------------------------->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password_confirmation" class="font-weight-bold">@lang('Confirm Password') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        value="{{ old('password_confirmation') }}" placeholder="@lang('Enter Confirm Password')"
                                        class="form-control form-control-lg" maxlength="60" required="">
                                </div>
                            </div>
                        </div>

                        <!-- সাবমিট বাটন ----------------------------------->
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><i
                                    class="fa fa-fw fa-paper-plane"></i> @lang('Create Donor')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('admin.donor.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";
        $('.datepicker-here').datepicker({
            autoClose: true,
            dateFormat: 'yyyy-mm-dd',
        });

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
