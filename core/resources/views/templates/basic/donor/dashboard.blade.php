@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contact = getContent('contact_us.content', true);
    @endphp
    <style>
        .active {
            background-color: lightgray;
        }

        .active a {
            font-weight: bold;
        }

        .sidebar__menu-wrapper .active ul li a {
            font-weight: bold;
        }

        .sidebar__menu-wrapper ul li:hover {
            background-color: lightgray;
        }

        .sidebar__menu-wrapper ul li a {
            color: #333
        }

        .sidebar__menu-wrapper ul li a:hover {
            color: #00B074;
        }

        .donor-menu-card-header {
            background-color: #00B074;
            color: white;
            font-weight: bold;
            font-size: 125%;
        }

        .donor-menu-card-header:first-child {
            border-radius: 10px 10px 0px 0px;
        }
    </style>
    <div class="row" style="margin: 10px">
        <div class="col-md-2" style="padding-top: 10px">
            <div class="card" style="border-radius: 10px">
                <div class="card-header donor-menu-card-header">
                    Menus
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
                        <ul>
                            <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item {{ menuActive('donor.dashboard') }}">
                                <a href="{{ route('donor.dashboard') }}" class="nav-link ">
                                    <i style="color: #00B074" class="fa-solid fa-gauge"></i>
                                    <span class="menu-title">@lang('My Profile')</span>
                                </a>
                            </li>
                            <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item {{ menuActive('donor.blood-request.index') }}">
                                <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="menu-title">@lang('Blood Request')</span>
                                </a>
                            </li>
                            <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item {{ menuActive('donor.blood-request.index') }}">
                                <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span class="menu-title">@lang('Edit Profile')</span>
                                </a>
                            </li>
                            <li style="border-bottom:lightgray solid 1px" class="sidebar-menu-item {{ menuActive('donor.blood-request.index') }}">
                                <a href="{{ Route('donor.blood-request.index') }}" class="nav-link ">
                                    <i class="fa-solid fa-key"></i>
                                    <span class="menu-title">@lang('Change Password')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item {{ menuActive('donor.logout') }}">
                                <a href="{{ route('donor.logout') }}" class="nav-link ">
                                    <i class="fa fa-sign-out"></i>
                                    <span class="menu-title">@lang('Sign Out')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
                                            <p class="text-muted mb-4">@lang('Location') : {{ __($donor->location->name) }},
                                                {{ __($donor->city->name) }}</p>

                                            <div class="d-flex justify-content-center mb-2">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="window.location.href = '{{ route('donor.profile') }}';">Edit
                                                    your profile</button>
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
                                                        <span
                                                            class="badge badge--success fw-bold">@lang('Your Profile is Actived')</span>
                                                    @elseif($donor->status == 2)
                                                        <span
                                                            class="badge badge--danger fw-bold">@lang('Your Profile is Banned')</span>
                                                    @else
                                                        <span
                                                            class="badge badge--primary fw-bold">@lang('Your Profile is Pending for Admin Approval.')</span>
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
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p class="mb-0 fw-bold">Profession</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->profession) }}</p>
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
                                                    <p class="mb-0 fw-bold">Address</p>
                                                </div>
                                                <div class="col-sm-9">
                                                    <p class="text-muted mb-0">{{ __($donor->address) }}</p>
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
