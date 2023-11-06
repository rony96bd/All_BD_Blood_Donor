@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-12 col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Profile Information')</h5>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                    style="background-image: url({{ getImage(imagePath()['profile']['admin']['path'] .'/' .auth()->guard('admin')->user()->image,imagePath()['profile']['admin']['size']) }})">
                                                    <button type="button" class="remove-image"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                    id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'),
                                                        @lang('jpg').</b> @lang('Image will be resized into 400x400px') </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Name')</label>
                                    <input class="form-control" type="text" name="name"
                                        value="{{ auth()->guard('admin')->user()->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Email')</label>
                                    <input class="form-control" type="email" name="email"
                                        value="{{ auth()->guard('admin')->user()->email }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Phone')</label>
                                    <input class="form-control" type="number" name="phone"
                                        value="{{ auth()->guard('admin')->user()->phone }}">
                                </div>
                                <label for="facebook" class="form-control-label font-weight-bold">@lang('Facebook Url')</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="facebook" class="form-control"
                                        value="{{ $admin->fb }}" placeholder="@lang('Enter Facebook Url')" name="facebook"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="lab la-facebook-f"></i></span>
                                    </div>
                                </div>
                                <label for="youtube" class="form-control-label font-weight-bold">@lang('YouTube Url')</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="facebook" class="form-control"
                                        value="{{ $admin->yt }}" placeholder="@lang('Enter Youtube Url')" name="yt"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="lab la-youtube"></i></span>
                                    </div>
                                </div>
                                <label for="linkedin" class="form-control-label font-weight-bold">@lang('Linkedin Url')</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="facebook" class="form-control"
                                        value="{{ $admin->linkedin }}" placeholder="@lang('Enter LinkedIn Url')" name="linkedin"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="lab la-linkedin"></i></span>
                                    </div>
                                </div>
                                <label for="pinterest" class="form-control-label font-weight-bold">@lang('Pinterest Url')</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="facebook" class="form-control"
                                        value="{{ $admin->pin }}" placeholder="@lang('Enter Pinterest Url')" name="pin"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="lab la-pinterest"></i></span>
                                    </div>
                                </div>
                                <label for="twitter" class="form-control-label font-weight-bold">@lang('Twitter Url')</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="facebook" class="form-control"
                                        value="{{ $admin->twitter }}" placeholder="@lang('Enter Twitter Url')" name="twitter"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="lab la-twitter"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ route('admin.password') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i
            class="fa fa-key"></i>@lang(' Password Setting')</a>
@endpush
