@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="blog-details-section pt-100 pb-100">
  	<div class="container">
    	<div class="row">
	        <div class="col-lg-8 col-md-8">
	            <div class="blog-details-wrapper">
	              	<div class="blog-details__thumb">
	                	<img src="" alt="@lang('Blog Image')">
		                <div class="post__date">
		                  	<span class="date"></span>
		                  	<span class="month"></span>
		                </div>
	              	</div>
	              	<div class="blog-details__content">
	                	<h4 class="blog-details__title">{{ __($bloodRequest->donor->name) }}</h4>

	              	</div>
	              	<div class="blog-details__footer">

	              	</div>

	              	 <div class="fb-comments" data-href="" data-numposts="5"></div>
	            </div>
      		</div>

	        <div class="col-lg-4 col-md-4">
	            <div class="sidebar">
	              	<div class="widget">
	                	<h5 class="widget__title">@lang('Recent Post')</h5>
                        @foreach ($bloodRequests as $bloodRequest)
                        <span>{{__($bloodRequest->id) }}</span>
                        @endforeach
                		<ul class="small-post-list">

                		</ul>
	              	</div>
	              	@php
                        echo advertisements("416x554")
                    @endphp

                    @php
                        echo advertisements("416x554")
                    @endphp
	            </div>
	        </div>
    	</div>
  	</div>
</section>
@endsection
@push('fbComment')
	@php echo loadFbComment() @endphp
@endpush

