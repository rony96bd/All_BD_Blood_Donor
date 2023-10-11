@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contact = getContent('contact_us.content', true);
    @endphp
    <div class="row" style="margin: 10px">

        @include($activeTemplate . 'donor.partials.donor_menu')

        <div class="col-md-10" style="padding-top: 10px">
            <div class="card" style="border-radius: 10px">
                <div class="card-header donor-menu-card-header">
                    Your Blood Request List
                </div>
                <div class="card-body">
                    <section style="background-color: #eee; border-radius: 10px;">
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
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
