@php
    $donor = getContent('latest_donor.content', true);
    $donors = App\Models\Donor::where('status', 1)
        ->orderBy('id', 'DESC')
        ->with('blood', 'city', 'division', 'location')
        ->limit(9)
        ->get();
@endphp

<section class="pt-20 pb-20 position-relative z-index-2 overflow-hidden">
    <div class="bottom-el-bg">
        <img src="{{ getImage('assets/images/frontend/latest_donor/' . @$donor->data_values->background_image, '1920x596') }}"
            alt="@lang('image')">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{ __(@$donor->data_values->heading) }}</h2>
                    {{-- <p class="mt-2">{{__(@$donor->data_values->sub_heading)}}</p> --}}
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @forelse($donors as $donor)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="donor-item has--link" style="font-family: 'Noto Sans Bengali',  sans-serif;">
                        <div class="donor-item__thumb">
                            <img style="border-radius: 5px;" src="{{ getImage('assets/images/donor/' . $donor->image, imagePath()['donor']['size']) }}"
                                alt="@lang('image')">
                        </div>
                        <div class="donor-item__content">
                            <h5 style="color: #fff; font-weight: 600;" class="donor-item__name">{{ __($donor->name) }}</h5>
                            <ul class="donor-item__list">
                                <li class="donor-item__list">
                                    <i class="las la-tint"></i> @lang('ব্লাড গ্রুপ') :
                                    <span style="color: red">
                                    {{ __($donor->blood->name) }}
                                    @if ($donor->blood->name == 'A+')
                                        (এ পজেটিভ)
                                    @elseif ($donor->blood->name == 'A-')
                                        (এ নেগেটিভ)
                                    @elseif ($donor->blood->name == 'B+')
                                        (বি পজেটিভ)
                                    @elseif ($donor->blood->name == 'B-')
                                        (বি নেগেটিভ)
                                    @elseif ($donor->blood->name == 'AB+')
                                        (এবি পজেটিভ)
                                    @elseif ($donor->blood->name == 'AB-')
                                        (এবি নেগেটিভ)
                                    @elseif ($donor->blood->name == 'O+')
                                        (ও পজেটিভ)
                                    @elseif ($donor->blood->name == 'O-')
                                        (ও নেগেটিভ)
                                    @else
                                    @endif
                                    </span>
                                </li>
                                <li>
                                    সর্বশেষ রক্ত প্রদান: {{ showDateTime($donor->last_donate, 'd M Y') }}
                                </li>
                                <li class="text-truncate" style="font-weight: 600">
                                    <i class="las la-map-marker-alt"></i>
                                    {{ __($donor->city->name) }}, {{ __($donor->division->name) }}
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-7 text-white"><span><a
                                            href="{{ route('donor.details', [slug($donor->name), encrypt($donor->id)]) }}"
                                            class="custom-btn">View Details <i
                                                class="fa fa-angle-double-right"></i></a></span></div>
                                <div class="col-5" style="text-align: right"><i class="las la-eye"></i> {{ __($donor->click) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3 class="text-center">{{ $emptyMessage }}</h3>
            @endforelse
        </div>
    </div>
    <div style="width: 100%; padding-top: 20px" class="text-center"><span><a href="{{ route('donor.list') }}"
                class="custom-btn2" style="">সকল রক্তদাতা</a></span></div>
</section>
