@php
    $breadcrumb = getContent('breadcrumb.content', true);
@endphp

<section class="inner-hero bg_img overlay--one">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                <li class="breadcrumb-item" aria-current="page">{{ __($pageTitle) }}</li>
            </ol>
        </nav>
    </div>
</section>
