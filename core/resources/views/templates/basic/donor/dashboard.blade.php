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
                    Donor Profile
                </div>
                <div class="card-body">
                    <section style="background-color: #eee; border-radius: 10px;">
                        <div class="container py-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <img src="{{ getImage('assets/images/donor/' . $donor->image ?? '', imagePath()['donor']['size']) }}"
                                                alt="@lang('Image')" class="rounded-circle img-fluid"
                                                style="width: 120px;">
                                            <h5 class="my-3">{{ __($donor->name) }}</h5>
                                            <p class="mb-1 text-danger">@lang('Blood Group') : {{ __($donor->blood->name) }}
                                            </p>
                                            <p class="text-muted mb-4">@lang('Location') :
                                                {{ __($donor->location->name) }},
                                                {{ __($donor->city->name) }}</p>
                                            <style>
                                                .button1 {
                                                    background-color: #00b074;
                                                    color: white;
                                                    padding: 8px 10px 4px;
                                                    border-radius: 5px;
                                                    transition: all .5s ease-out;
                                                }

                                                .button1:hover {
                                                    background-color: #0866FF;
                                                    color: white;
                                                }
                                            </style>

                                            <div class="d-flex justify-content-center mb-2 edit-button">
                                                <a href="{{ route('donor.profile') }}" class="button1">
                                                    <i class="fa-solid fa-pen-to-square"></i><span
                                                        style="padding-left: 5px;">Edit Your Profile</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Profile Status</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    @if ($donor->status == 1)
                                                        <span class="badge badge--success fw-bold">@lang('Your Profile is Actived')</span>
                                                    @elseif($donor->status == 2)
                                                        <span class="badge badge--danger fw-bold">@lang('Your Profile is Banned')</span>
                                                    @else
                                                        <span class="badge badge--primary fw-bold">@lang('Your Profile is Pending for Admin Approval.')</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Full Name</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->name) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Gender</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        @if ($donor->gender == 1)
                                                            @lang('Male')
                                                        @else
                                                            @lang('Female')
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Date of Birth</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ showDateTime($donor->birth_date, 'd M Y') }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Age</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">
                                                        {{ Carbon\Carbon::parse($donor->birth_date)->age }}
                                                        @lang('Years')</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Religion</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->religion) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Email</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->email) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Facebook</p>
                                                </div>
                                                <div class="col-sm-9">

                                                    <p class="mb-0"><i style="color: #0866FF"
                                                            class="fa-brands fa-square-facebook"></i> <a
                                                            href="{{ __($donor->facebook) }}" target="_blank"
                                                            tabindex="-1">{{ __($donor->facebook) }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Phone</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->phone) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Secondary Phone</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->phone2) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Division</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->division->name) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">District</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->city->name) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Upazila</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->location->name) }}</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">About Me</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->about_me) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
