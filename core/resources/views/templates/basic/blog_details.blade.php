@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'partials.breadcrumb')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @php
                    echo advertisements('Single_Blog_Bottom');
                @endphp
            </div>
        </div>
    </div>
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
                        <style>
                            div#social-links {
                                margin: 0 auto;
                                max-width: 500px;
                            }

                            div#social-links ul li {
                                display: inline-block;
                            }

                            div#social-links ul li a {
                                padding: 5px 6px 0px 6px;
                                border: 1px solid #ccc;
                                margin: 1px;
                                font-size: 15px;
                                background-color: beige;
                                border-radius: 4px;
                            }

                            .fa-square-facebook {
                                color: #3B5998
                            }

                            .fa-twitter {
                                color: #33CCFF;
                            }

                            .fa-linkedin {
                                color: #4875B4;
                            }

                            .fa-telegram {
                                color: rgb(51, 144, 236);
                            }

                            .fa-whatsapp {
                                color: #00a884;
                            }
                        </style>
                        <div class="blog-details__footer">

                            @php
                                $shareComponent = \Share::currentPage()
                                    ->facebook()
                                    ->twitter()
                                    ->linkedin()
                                    ->whatsapp();
                            @endphp
                            {{-- <span><h4>@lang('Share This Post')</h4></span>  <span>{!! $shareComponent !!}</span> --}}
                            {{-- <ul class="social__links">
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
                            </ul> --}}
                        </div>
                        {{-- Comments Section --}}
                        <div class="row">
                            <div class="custom-comments bnfont" id="custom-comments">
                                <div class="container" style="padding: 0 0 0 0;">
                                    <div class="row" style="margin-top: 8px;">
                                        <div class="col-3">

                                        </div>
                                        <div class="col-9"><span style="float: right">
                                                @php
                                                    $shareComponent = \Share::currentPage()
                                                        ->facebook()
                                                        ->twitter()
                                                        ->linkedin()
                                                        ->whatsapp();
                                                @endphp
                                                {!! $shareComponent !!}
                                            </span></div>
                                    </div>
                                </div>
                                <form action="{{ url('blog-comments') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ __($blog->id) }}" />
                                    <div style="margin-bottom: 10px">
                                    </div>
                                    <div class="rr-form">
                                        <div class="input-group" style="z-index:1;">
                                            <input style="border-radius: 25px 0px 0px 25px; height:46px; font-size:13px;"
                                                class="form-control" name="comment_body" type="text"
                                                placeholder="Write a Comment">
                                            <div class="input-group-prepend">
                                                <button style="border-radius: 0px 25px 25px 0px;" type="submit"
                                                    class="btn btn-primary pb-2"><i
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
                                            $timestamp = $comment->created_at;
                                            $ctimeAgo = Carbon\Carbon::parse($timestamp)->ago();
                                        @endphp
                                        <div class="rev-user-item" id="comment-container">
                                            <hr>
                                            <div class="container" style="position: relative;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="review-user-info">
                                                            <div class="media">
                                                                <img class="shadow bg-white"
                                                                    src="{{ getImage('assets/images/donor/' . $comment_donor_details->image, imagePath()['donor']['size']) }}"
                                                                    alt="@lang('donor image')">
                                                                <div class="media-body">
                                                                    <h5 class="text-danger">
                                                                        {{ $comment_donor_details->name }}</h5>
                                                                    <p style="font-size: 12px">{{ $ctimeAgo }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (auth()->guard('admin')->check())
                                                    <div
                                                        style="position: absolute; top: 8px; right: 16px; font-size: 18px;">
                                                        <button type="button" class="deleteComment btn"
                                                            value="{{ $comment->id }}">
                                                            <i style="color: red" class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif

                                                @if (auth()->guard('donor')->check() &&
                                                        auth()->guard('donor')->user()->id == $comment->donor_id)
                                                    <div
                                                        style="position: absolute; top: 8px; right: 16px; font-size: 18px;">
                                                        <button type="button" class="donordeleteComment btn"
                                                            value="{{ $comment->id }}">
                                                            <i style="color: red" class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif
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
    <div id="visits">...</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @php
                    echo advertisements('Single_Blog_Bottom');
                @endphp
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $.getJSON("https://api.countapi.xyz/hit/roktodin.com/", function(response) {
            $("#visits").text(response.value);
        });
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.deleteComment', function() {
                if (confirm('Are you sure you want to delete this comment?')) {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/delete-comment') }}",
                        data: {
                            'comment_id': comment_id
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                thisClicked.closest('#comment-container').remove();
                                alert(res.message);
                            } else {
                                alert(res.message);
                            }
                        }
                    });
                }
            });
            $(document).on('click', '.donordeleteComment', function() {
                if (confirm('Are you sure you want to delete your comment?')) {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/donor-delete-comment') }}",
                        data: {
                            'comment_id': comment_id
                        },
                        success: function(res) {
                            if (res.status == 200) {
                                thisClicked.closest('#comment-container').remove();
                                alert(res.message);
                            } else {
                                alert(res.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
