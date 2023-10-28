@extends('admin.layouts.app')
@section('panel')
    <style>
        form label {
            color: #000;
            font-weight: bold;
        }
    </style>
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card bnfont">
                <div class="card-body">
                    <h5 class="card-title mb-25 border-bottom pb-2">{{ __($donor->name) }}'s @lang('Profile Information')</h5>
                    UserName: {{ __($donor->phone) }}<br />

                    <form action="{{ route('admin.donor.update', $donor->id) }}" id="basic-form" method="POST"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <input autocomplete="false" name="hidden" type="text" style="display:none;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"
                                                name="imageUpload" class="imageUpload" required="" />
                                            <input type="hidden" name="base64image" required="" name="base64image"
                                                id="base64image">
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview container2">
                                            @php
                                                if (!empty($donor->image) && $donor->image != '' && getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size'])) {
                                                    $image = $donor->image;
                                                } else {
                                                    $image = 'default.png';
                                                }
                                                $url = url('assets/images/donor/' . $image);
                                                $imgs = "background-image:url($url)";

                                            @endphp
                                            <div id="imagePreview" style="{{ $imgs }};">
                                                <input type="hidden" required="" name="_token"
                                                    value="{{ csrf_token() }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Name')</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ $donor->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="font-weight-bold">@lang('Gender')</label>
                                    <select name="gender" id="gender" class="form-control form-control" required="">
                                        <option value="" selected="" disabled="">
                                            @lang('Select One')</option>
                                        <option value="1" @if ($donor->gender == 1) selected @endif>
                                            @lang('Male')</option>
                                        <option value="2" @if ($donor->gender == 2) selected @endif>
                                            @lang('Female')</option>
                                        <option value="3" @if ($donor->gender == 3) selected @endif>
                                            @lang('Other')</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="division" class="font-weight-bold">@lang('Division')
                                        <sup class="text--danger">*</sup></label>
                                    <select name="division" id="division-dropdown" class="form-control" required="">
                                        <option selected value="{{ __($donor->division->id) }}">
                                            {{ __($donor->division->name) }}</option>
                                        @foreach ($divisions as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="font-weight-bold">@lang('City')</label>
                                    <select name="city" id="city-dropdown" class="form-control" required="">
                                        <option value="{{ __($donor->city->id) }}">{{ __($donor->city->name) }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="location" class="font-weight-bold">@lang('Location')</label>
                                    <select name="location" id="location-dropdown" class="form-control" required="">
                                        <option value="{{ __($donor->location->id) }}">{{ __($donor->location->name) }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="blood" class="font-weight-bold">@lang('Blood Group')</label>
                                    <select name="blood" id="blood" class="form-control" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach ($bloods as $blood)
                                            <option value="{{ $blood->id }}"
                                                @if ($blood->id == $donor->blood_id) selected @endif>
                                                {{ __($blood->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="religion" class="font-weight-bold">@lang('Religion')</label>
                                    <select name="religion" id="religion" class="form-control" required="">
                                        <option value="{{ __($donor->religion) }}" selected="">
                                            {{ __($donor->religion) }}</option>
                                        <option value="Islam">@lang('Islam')</option>
                                        <option value="Hinduism">@lang('Hinduism')</option>
                                        <option value="Buddhism">@lang('Buddhism')</option>
                                        <option value="Christianity">@lang('Christianity')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="date_birth" class="font-weight-bold">@lang('Date Of Birth') <sup
                                            class="text--danger">*</sup></label>
                                    <input type="date" id="date_birth" name="birth_date"
                                        value="{{ \Carbon\Carbon::parse($donor->birth_date)->format('Y-m-d') }}"
                                        placeholder="@lang('DD-MM-YYYY')" class="form-control"
                                        maxlength="255" required="">
                                </div>
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Last Blood Donate')</label>
                                    <input type="date" name="last_donate" id="last_donate"
                                        value="{{ \Carbon\Carbon::parse($donor->last_date)->format('Y-m-d') }}"
                                        placeholder="@lang('DD-MM-YYYY')" class="form-control"
                                        autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">@lang('Email')</label>
                                    <input type="email" name="email" id="email" value="{{ __($donor->email) }}"
                                        placeholder="@lang('Enter Email')" class="form-control" maxlength="60">
                                </div>
                                <label for="facebook"
                                    class="form-control-label font-weight-bold">@lang('Facebook Url')</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="facebook" class="form-control"
                                        value="{{ $donor->facebook }}" placeholder="@lang('Enter Facebook Url')" name="facebook"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="lab la-facebook-f"></i></span>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Primary Phone')</label>
                                    <input class="form-control" type="text" name="phone"
                                        value="{{ $donor->phone }}">
                                </div>

                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Secondary Phone')</label>
                                    <input class="form-control" type="text" name="phone2"
                                        value="{{ $donor->phone2 }}">
                                </div>
                                <div class="form-group">
                                    <label for="details" class="font-weight-bold">@lang('About Donor')</label>
                                    <textarea maxlength="200" name="about_me" id="about_me" class="form-control" placeholder="@lang('Enter About Donor')">{{ $donor->about_me }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">@lang('Save Changes')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="model" class="modal fade imagecrop" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-11">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary crop" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('admin.donor.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="fa-solid fa-backward"></i>@lang(' Back')</a>
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
        // Cropper JS
        var $modal = $('.imagecrop');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".imageUpload", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1.5 / 1.9,
                viewMode: 1,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });
        $("body").on("click", "#crop", function() {
            canvas = cropper.getCroppedCanvas({
                width: 450,
                height: 570,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#base64image').val(base64data);
                    document.getElementById('imagePreview').style.backgroundImage = "url(" +
                        base64data + ")";
                    $modal.modal('hide');
                }
            });
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

        // Validate Password
        $("#passcheck").hide();
        let passwordError = true;
        $("#password").keyup(function() {
            validatePassword();
        });

        function validatePassword() {
            let passwordValue = $("#password").val();
            if (passwordValue.length == "") {
                $("#passcheck").show();
                passwordError = false;
                return false;
            }
            if (passwordValue.length < 3 || passwordValue.length > 10) {
                $("#passcheck").show();
                $("#passcheck").html(
                    "**length of your password must be between 3 and 10"
                );
                $("#passcheck").css("color", "red");
                passwordError = false;
                return false;
            } else {
                $("#passcheck").hide();
            }
        }

        // Validate Confirm Password
        $("#conpasscheck").hide();
        let confirmPasswordError = true;
        $("#password_confirmation").keyup(function() {
            validateConfirmPassword();
        });

        function validateConfirmPassword() {
            let confirmPasswordValue = $("#password_confirmation").val();
            let passwordValue = $("#password").val();
            if (passwordValue != confirmPasswordValue) {
                $("#conpasscheck").show();
                $("#conpasscheck").html("**Password didn't Match");
                $("#conpasscheck").css("color", "red");
                confirmPasswordError = false;
                return false;
            } else {
                $("#conpasscheck").hide();
            }
        }
    </script>
@endpush
