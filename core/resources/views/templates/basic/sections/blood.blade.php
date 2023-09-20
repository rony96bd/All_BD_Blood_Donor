@php
    $blood = getContent('blood.content', true);
    $bloods = App\Models\Blood::where('status', 1)
        ->with('donor')
        ->get();
    $bloodRequests = App\Models\BloodRequest::latest()
        ->with('blood', 'division', 'city', 'location', 'donor')
        ->limit(6)
        ->get();
@endphp

<section class="pt-50 pb-50 position-relative z-index-2 overflow-hidden">
    <div class="top-el-bg">
        <img src="{{ getImage('assets/images/frontend/blood/' . @$blood->data_values->background_image, '1920x389') }}"
            alt="@lang('image')">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header mb-4">
                    <h2 class="section-title">{{ __(@$blood->data_values->heading) }}</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-4">
            @foreach ($bloods as $blood)
                <div class="col-lg-3 col-sm-4 col-6">
                    <div class="avaiable-blood-single has--link">
                        <a href="{{ route('blood.group.donor', [slug($blood->name), encrypt($blood->id)]) }}"
                            class="item--link"></a>
                        <h6 class="avaiable-blood-single__name"><i class="las la-tint"></i>{{ __($blood->name) }}</h6>
                        <span class="avaiable-blood-single__amount">{{ $blood->donor->count() }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="pt-50 pb-50 position-relative z-index-2 overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header mb-4">
                    <h2 class="section-title">ব্লাড রিকোয়েস্ট পোস্টসমূহ</h2>
                </div>
            </div>
        </div>
        <div class="row mx-auto my-auto justify-content-center">
            <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @foreach ($bloodRequests as $bloodRequest)
                        @php
                            $timestamp = $bloodRequest->created_at;
                            $timeAgo = Carbon\Carbon::parse($timestamp)->ago();
                        @endphp
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="col-md-3">
                                <div class="card" style="padding: 5px; margin-right: 10px; border-radius: 10px">
                                    <div class="row">
                                        <div class="col-lg-3"><img
                                                src="{{ getImage('assets/images/donor/' . $bloodRequest->donor->image, imagePath()['donor']['size']) }}"
                                                alt="@lang('image')"
                                                style="border-radius: 50%; width: 50px; height: 47px;"
                                                class="img-fluid"></div>
                                        <div style="padding-left: 0px" class="col-lg-9">
                                            {{ __($bloodRequest->donor->name) }}<br>{{ __($timeAgo) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
                    data-bs-slide="prev" style="width: 5%;left: -28px;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
                    data-bs-slide="next" style="width: 5%;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
</section>
