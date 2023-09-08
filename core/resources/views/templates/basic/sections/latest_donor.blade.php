@php
    $donor = getContent('latest_donor.content', true);
    $donors = App\Models\Donor::where('status', 1)->orderBy('id', 'DESC')->with('blood')->limit(9)->get();
@endphp

<section class="pt-100 pb-100 border-top  position-relative z-index-2 overflow-hidden">
    <div class="bottom-el-bg">
        <img src="{{getImage('assets/images/frontend/latest_donor/'. @$donor->data_values->background_image, '1920x596')}}" alt="@lang('image')">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$donor->data_values->heading)}}</h2>
                    <p class="mt-2">{{__(@$donor->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @foreach($donors as $donor)
                <div class="col-100-1 col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="donor-card has--link">
                        <a href="{{route('donor.details', [slug($donor->name), encrypt($donor->id)])}}" class="item--link"></a>
                        <div class="donor-card__thumb">
                            <img src="{{getImage('assets/images/donor/'. $donor->image, imagePath()['donor']['size'])}}" alt="@lang('image')">
                        </div>
                        <div class="donor-card__content">
                            <h4 class="donor-card__name">{{__($donor->name)}}</h4>
                            <p class="text-white bnfont fs--14px">@lang('ব্লাড গ্রুপ') : {{__($donor->blood->name)}}

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
                            </p>
                            <p class="text-white bnfont fs--14px">সর্বশেষ রক্ত প্রদান: {{showDateTime($donor->last_donate, 'd M Y')}}</p>
                            <p class="text-white bnfont fs--14px"><i class="las la-map-marker"></i> কুষ্টিয়া, খুলনা</p>
                            <div class="row">
                            <div class="col-7 text-white"><span><a href="{{route('donor.details', [slug($donor->name), encrypt($donor->id)])}}" class="custom-btn">Read More <i class="fa fa-angle-double-right"></i></a></span></div>
                            <div class="col-5 text-white"><i class="las la-eye"></i> 2145</div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
