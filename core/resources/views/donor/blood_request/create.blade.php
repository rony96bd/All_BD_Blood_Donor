@extends('donor.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form class="bnfont" action="{{ route('donor.blood-request.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="division" class="font-weight-bold">@lang('Division') <sup
                                        class="text--danger">*</sup></label>
                                <select class="form-control form-control-lg" name="division" id="division-dropdown"
                                    class="select" required="">
                                    <option value="">-- বিভাগ সিলেক্ট করুন --</option>
                                    @foreach ($divisions as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- জেলা ----------------------------------->
                            <div class="form-group col-lg-3">
                                <label for="city" class="font-weight-bold">@lang('District') <sup
                                        class="text--danger">*</sup></label>
                                <select class="form-control form-control-lg" name="city" id="city-dropdown"
                                    class="select" required="">
                                </select>
                            </div>

                            <!-- উপজেলা ----------------------------------->
                            <div class="form-group col-lg-3">
                                <label for="location" class="font-weight-bold">@lang('Upazila') <sup
                                        class="text--danger ">*</sup></label>
                                <select class="form-control form-control-lg" name="location" id="location-dropdown"
                                    class="select" required="">
                                </select>
                            </div>

                            <!-- রক্তের গ্রুপ ---------------------------------->
                            <div class="form-group col-lg-3">
                                <label for="blood_id" class="font-weight-bold">@lang('Blood Group')</label>
                                <select name="blood" id="blood_id" class="form-control form-control-lg" required="">
                                    <option value="" selected="" disabled="">@lang('Select One')</option>
                                    @foreach ($bloods as $blood)
                                        <option value="{{ $blood->id }}">{{ __($blood->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- রোগীর সমস্যা ---------------------------------->
                            <div class="form-group col-lg-12">
                                <div class="form-group">
                                    <label for="problem" class="font-weight-bold">@lang('রোগীর সমস্যা')</label>
                                    <input type="text" id="problem" name="problem" value="{{ old('problem') }}"
                                        class="form-control form-control-lg" placeholder="@lang('রোগীর সমস্যা লিখুন')" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">
                                <div class="form-group">
                                    <label for="amount_of_blood" class="font-weight-bold">@lang('রক্তের পরিমাণ (ব্যাগ)')</label>
                                    <input type="text" id="amount_of_blood" name="amount_of_blood"
                                        value="{{ old('amount_of_blood') }}" class="form-control form-control-lg"
                                        placeholder="@lang('রক্তের পরিমাণ লিখুন (কত ব্যাগ)')" required="">
                                </div>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="donate_date" class="font-weight-bold">@lang('রক্ত দানের তারিখ')</label>
                                <input type="date" id="donate_date" name="donate_date" value="{{ old('donate_date') }}"
                                    data-language="en" placeholder="@lang('DD/MM/YYYY')"
                                    class="form-control form-control-lg" maxlength="255" required="">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="donate_time" class="font-weight-bold">@lang('রক্ত দানের সময়')</label>
                                <input type="time" id="donate_time" name="donate_time" value="{{ old('donate_time') }}"
                                    data-language="en" class="form-control form-control-lg" maxlength="255" required="">
                            </div>
                        </div>

                        <div class="row">
                            <!-- রক্ত দানের স্থান ---------------------------------->
                            <div class="form-group col-lg-8">
                                <div class="form-group">
                                    <label for="donate_address" class="font-weight-bold">@lang('রক্ত দানের স্থান')</label>
                                    <input type="text" id="donate_address" name="donate_address"
                                        value="{{ old('donate_address') }}" class="form-control form-control-lg"
                                        placeholder="@lang('ঠিকানা/হাসপাতাল বা ক্লিনিকের নাম উল্লেখ করুন...')" required="">
                                </div>
                            </div>
                            <div class="form-group col-lg-4">
                                <div class="form-group">
                                    <label for="phone" class="font-weight-bold">@lang('যোগাযোগ')</label>
                                    <input type="number" id="phone" name="phone" value="{{ __($donor->phone) }}"
                                        class="form-control form-control-lg" placeholder="@lang('যোগাযোগের মোবাইল নম্বর')"
                                        required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- কিছু কথা ---------------------------------->
                            <div class="form-group col-lg-12">
                                <div class="form-group">
                                    <label for="problem" class="font-weight-bold">@lang('কিছু কথা')</label>
                                    <textarea class="form-control form-control-lg" rows="5" id="message" name="message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><i
                                    class="fa fa-fw fa-paper-plane"></i> @lang('Blood Request Post')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('donor.blood-request.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'frontend/css/datepicker.min.css') }}">
@endpush
@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/datepicker.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'frontend/js/datepicker.en.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $("#basic-form").validate();
        });

        $(document).ready(function() {
            $('#division-dropdown').on('change', function() {
                var idDivision = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{ Route('donor.fetchcity') }}",
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
                    url: "{{ Route('donor.fetchlocation') }}",
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
