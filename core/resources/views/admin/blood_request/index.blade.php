@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('বিভাগ - জেলা - উপজেলা')</th>
                                    <th>@lang('ব্লাড গ্রুপ - রোগীর সমস্যা')</th>
                                    <th>@lang('রক্তের পরিমান')</th>
                                    <th>@lang('রক্তদানের তারিখ ও সময়')</th>
                                    <th>@lang('রক্ত দানের স্থান')</th>
                                    <th>@lang('রিকোয়েস্টকারীর নাম <br> ও যোগাযোগের নম্বর')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bloodRequests as $bloodRequest)
                                    <tr>
                                        <td>
                                            <span>বিভাগ: {{ __($bloodRequest->division->name) }}</span><br>
                                            <span>জেলা: {{ __($bloodRequest->city->name) }}</span><br>
                                            <span>উপজেলা: {{ __($bloodRequest->location->name) }}</span>
                                        </td>
                                        <td>
                                            <span>{{ __($bloodRequest->blood->name) }}</span><br>
                                            <span>{{ __($bloodRequest->problem) }}</span>
                                        </td>
                                        <td>
                                            <span>{{ __($bloodRequest->amount_of_blood) }}</span>
                                        </td>
                                        <td>
                                            <span>{{ __($bloodRequest->donate_date) }}</span><br>
                                            <span>{{ __($bloodRequest->donate_time) }}</span>
                                        </td>

                                        <td>
                                            <span>{{ __($bloodRequest->donate_address) }}</span>
                                        </td>

                                        <td>
                                            @if ($bloodRequest->donor_id == 0)
                                                @php
                                                    $admin_name = DB::table('admins')->value('name');
                                                @endphp
                                                {{ $admin_name }}
                                            @else
                                                <a target="_blank"
                                                    href="{{ route('donor.details', [slug($bloodRequest->donor->name ?? ''), $bloodRequest->donor->id ?? '']) }}"><span>{{ __($bloodRequest->donor->name ?? '') }}</span></a>
                                            @endif
                                            <br>
                                            <span>{{ __($bloodRequest->phone) }}</span>
                                        </td>

                                        <td data-label="@lang('Action')">

                                            <a href="{{ route('donor.blood-request.edit', $bloodRequest->id) }}"
                                                class="icon-btn btn--primary ml-1"><i class="las la-pen"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($bloodRequests) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Blood Request')</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="bnfont" action="{{ route('admin.blood-request.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
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
                            <div class="form-group col-lg-6">
                                <label for="city" class="font-weight-bold">@lang('District') <sup
                                        class="text--danger">*</sup></label>
                                <select class="form-control form-control-lg" name="city" id="city-dropdown"
                                    class="select" required="">
                                </select>
                            </div>

                            <!-- উপজেলা ----------------------------------->
                            <div class="form-group col-lg-6">
                                <label for="location" class="font-weight-bold">@lang('Upazila') <sup
                                        class="text--danger ">*</sup></label>
                                <select class="form-control form-control-lg" name="location" id="location-dropdown"
                                    class="select" required="">
                                </select>
                            </div>

                            <!-- রক্তের গ্রুপ ---------------------------------->
                            <div class="form-group col-lg-6">
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
                                        class="form-control form-control-lg" placeholder="@lang('রোগীর সমস্যা লিখুন')"
                                        required="">
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
                                <input type="date" id="donate_date" name="donate_date"
                                    value="{{ old('donate_date') }}" data-language="en" placeholder="@lang('DD/MM/YYYY')"
                                    class="form-control form-control-lg" maxlength="255" required="">
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="donate_time" class="font-weight-bold">@lang('রক্ত দানের সময়')</label>
                                <input type="time" id="donate_time" name="donate_time"
                                    value="{{ old('donate_time') }}" data-language="en"
                                    class="form-control form-control-lg" maxlength="255" required="">
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
                                    <input type="number" id="phone" name="phone" value=""
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="updateBloodModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Update Blood Group')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.blood.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name"
                                placeholder="@lang('Enter Blood Group Name')" maxlength="60" required="">
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')"
                                name="status">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--primary"><i
                                class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a style="color: white" data-toggle="modal" data-target="#myModal"
        class="btn btn-sm btn--primary box--shadow1 text--small addBlood"><i class="fa fa-fw fa-paper-plane"></i>
        @lang('Add Blood Request')</a>
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
@push('script')
    <script>
        "use strict";
        // $('.addBlood').on('click', function() {
        //     $('#bloodCreateModel').modal('show');
        // });

        $('.updateBlood').on('click', function() {
            var modal = $('#updateBloodModel');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.find('input[name=name]').val($(this).data('name'));
            var data = $(this).data('status');
            if (data == 1) {
                modal.find('input[name=status]').bootstrapToggle('on');
            } else {
                modal.find('input[name=status]').bootstrapToggle('off');
            }
            modal.modal('show');
        });
    </script>
@endpush
