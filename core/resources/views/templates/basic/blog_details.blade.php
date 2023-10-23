@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <section class="blog-details-section pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8" style="background-color: white; padding-top: 11px; border-radius: 6px;">
                    <div class="blog-details-wrapper">
                        <div class="blog-details__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->blog_image, '626x430') }}"
                                alt="@lang('Blog Image')">
                            <div class="post__date">
                                <span class="date">{{ showDateTime($blog->created_at, 'd') }}</span>
                                <span class="month">{{ showDateTime($blog->created_at, 'M') }}</span>
                            </div>
                        </div>
                        <div class="blog-details__content">
                            <h4 class="blog-details__title">{{ __($blog->data_values->title) }}</h4>
                            @php echo $blog->data_values->description_nic @endphp
                        </div>
                        <div class="blog-details__footer">
                            <h4 class="caption">@lang('Share Tish Post')</h4>
                            <ul class="social__links">
                                <li>
                                    <a href="https://www.facebook.com/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="__blank"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/share?url={{ urlencode(url()->current()) }}&text=Simple Share Buttons&hashtags=simplesharebuttons"
                                        target="__blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}"
                                        target="__blank"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                        {{-- Comments Section --}}
                        <div class="row">
                            <div class="custom-comments bnfont" id="custom-comments">
                                <p class="mt-4 mb-4 text-danger font-weight-bold"> <i class="fa-solid fa-eye"></i>
                                    12 People Visited</p>
                                <form action="{{ url('blog-comments') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ __($blog->id) }}" />
                                    <div style="margin-bottom: 10px">
                                        <h5 style="font-weight: bold">Leave Comments</h5>
                                    </div>
                                    <div class="rr-form">
                                        <div class="input-group" style="z-index:1;">
                                            <input style="border-radius: 25px 0px 0px 25px; height:46px; font-size:13px;" class="form-control"
                                                name="comment_body" type="text" placeholder="Write a Comment">
                                            <div class="input-group-prepend">
                                                <button style="border-radius: 0px 25px 25px 0px;" type="submit" class="btn btn-primary pb-2"><i
                                                        class="fa fa-paper-plane mr-3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @php
                                    $blog_comment = App\Models\Comment::where('post_id', $blog->id)->get();
                                @endphp

                                <div class="custom-review-count">
                                    @forelse ($blog_comment->sortByDesc('created_at') as $comment)
                                        @php
                                            $comment_donor_id = $comment->donor_id;
                                            $comment_donor_details = App\Models\Donor::where('id', $comment_donor_id)->first();
                                        @endphp
                                        <div class="rev-user-item">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="review-user-info">
                                                        <div class="media">
                                                            <img class="shadow bg-white"
                                                                src="{{ getImage('assets/images/donor/' . $comment_donor_details->image, imagePath()['donor']['size']) }}"
                                                                alt="@lang('donor image')">
                                                            <div class="media-body">
                                                                <h5 class="text-danger">{{ $comment_donor_details->name }}</h5>
                                                                <p>{{ $comment->created_at->format('d M Y') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="comments-section-des">
                                                        <p> - {{ $comment->comment_body }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <h5>No Comments</h5>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        {{-- End Comments Section --}}
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="sidebar">
                        <div class="widget">
                            <h5 class="widget__title">@lang('Recent Post')</h5>
                            <ul class="small-post-list">
                                @foreach ($blogs as $post)
                                    <li class="small-post">
                                        <div class="small-post__thumb"><img
                                                src="{{ getImage('assets/images/frontend/blog/' . $post->data_values->blog_image, '626x430') }}"
                                                alt="@lang('Blog Image')"></div>
                                        <div class="small-post__content">
                                            <h5 class="post__title"><a
                                                    href="{{ route('blog.details', [$post->id, slug($post->data_values->title)]) }}">{{ __($post->data_values->title) }}</a>
                                            </h5>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @php
                            echo advertisements('416x554');
                        @endphp

                        @php
                            echo advertisements('416x554');
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
