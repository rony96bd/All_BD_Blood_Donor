@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $breadcrumb = getContent('breadcrumb.content', true);
    @endphp
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 d-md-block d-none">
                    @php
                        echo advertisements('Single_Donor_Left');
                    @endphp
                </div>
                <div class="col-xl-6 col-lg-9 col-md-8 bg-light rounded-2">
                    <div class="row gy-4">
                        <div class="col-lg-12 col-md-12 col-sm-6 text-center">
                            <img class="img-ext shadow p-1 bg-white"
                                src="{{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }}"
                                alt="@lang('image')"><br>
                            <span style="margin-top: 10px">
                                <h3 class="text-danger">{{ __($donor->name) }}</h3>
                            </span>
                        </div>
                        <div style="padding: 0px 20px 20px 20px;">
                            <p><span class="donor-info-span">Name</span>:<span
                                    class="donor-info-span-right">{{ __($donor->name) }}</span></p>
                            <p><span class="donor-info-span">Blood Group</span>:<span
                                    class="donor-info-span-right">{{ __($donor->blood->name) }}</span></p>
                            <p><span class="donor-info-span">Last Donate</span>:<span
                                    class="donor-info-span-right">{{ showDateTime($donor->last_donate, 'd M Y') }}</span>
                            </p>
                            <p><span class="donor-info-span">Gender</span>:<span class="donor-info-span-right">
                                    @if ($donor->gender == 1)
                                        @lang('Male')
                                    @else
                                        @lang('Female')
                                    @endif
                                </span></p>
                            <p><span class="donor-info-span">Date of Birth</span>:<span
                                    class="donor-info-span-right">{{ showDateTime($donor->birth_date, 'd M Y') }}</span>
                            </p>
                            <p><span class="donor-info-span">Age:</span>:<span
                                    class="donor-info-span-right">{{ Carbon\Carbon::parse($donor->birth_date)->age }}
                                    @lang('Years')</span></p>
                            <p><span class="donor-info-span">Religion </span>:<span
                                    class="donor-info-span-right">{{ __($donor->religion) }}</span></p>
                            <p><span class="donor-info-span">Email</span>:<span
                                    class="donor-info-span-right"></span>{{ __($donor->email) }}</p>
                            <p><span class="donor-info-span">Profession</span>:<span
                                    class="donor-info-span-right">{{ __($donor->profession) }}</span></p>
                            <p><span class="donor-info-span">Division</span>:<span
                                    class="donor-info-span-right">{{ __($donor->division->name) }}</span></p>
                            <p><span class="donor-info-span">District</span>:<span
                                    class="donor-info-span-right">{{ __($donor->city->name) }}</span></p>
                            <p><span class="donor-info-span">Upazila</span>:<span
                                    class="donor-info-span-right">{{ __($donor->location->name) }}</span></p>
                            <p><span class="donor-info-span">Address</span>:<span
                                    class="donor-info-span-right">{{ __($donor->address) }}</span></p>
                            <p><span class="donor-info-span">Phone</span>:<span
                                    class="donor-info-span-right"><a href="tel:{{ __($donor->phone) }}">{{ __($donor->phone) }}</a></span></p>
                            <p><span class="donor-info-span">Secondary Phone</span>:<span
                                    class="donor-info-span-right">{{ __($donor->phone2) }}</span></p>
                        </div>
                    </div>

                </div>
                <div class="col-xl-3 d-xl-block d-none">
                    @php
                        echo advertisements('Single_Donor_Right');
                    @endphp
                </div>
            </div>
        </div>
    </section>
@endsection
