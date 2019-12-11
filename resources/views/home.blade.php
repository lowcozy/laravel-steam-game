@extends('layout.blank')

@section('title', __('Home'))

@push('styles')
    <link href="{{ asset('plugins/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- main -->
    <section class="p-y-5">
        <div class="owl-carousel owl-posts">
            @foreach($topBlog as $top)
                <div class="post-carousel">
                    <a href="blog-post.html"><img src="{{ urlBlogImage($top->image) }}" alt=""></a>
                    <span class="badge badge-ps4">{{ badgesBlog($top->category) }}</span>
                    <div class="post-block">
                        <div class="post-caption">
                            <h2 class="post-title">
                                <a href="{{ route('blog-detail', ['slug' => $top->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($top->id) ]) }}">{{ $top->title }}</a>
                            </h2>
                            <div class="post-meta">
                            <span><i class="fa fa-clock-o"></i> {{ $top->blog_date }} by <a
                                        href="profile.html">{{ $top->authors }}</a></span>
                                <span>
                                    <a href="{{ route('blog-detail', ['slug' => $top->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($top->id) ]) . '#comments'}}">
                                        <i class="fa fa-eye"></i>
                                        @if($top->count_view == 0)
                                            {{ rand(50,100) }}
                                        @else
                                            {{ $top->count_view }}
                                        @endif
                                        views
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="p-t-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="toolbar-custom">
                        <a class="btn btn-default btn-icon m-r-10 float-left hidden-xs-down" href="#"
                           data-toggle="tooltip" title="refresh" data-placement="bottom" role="button"><i
                                    class="fa fa-refresh"></i></a>
                        <div class="dropdown float-left">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">All Platform <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item active" href="#">All platform</a>
                                <a class="dropdown-item" href="#">Playstation 4</a>
                                <a class="dropdown-item" href="#">Xbox One</a>
                                <a class="dropdown-item" href="#">Origin</a>
                                <a class="dropdown-item" href="#">Steam</a>
                            </div>
                        </div>

                        <a class="btn btn-default btn-icon m-l-10 float-right hidden-xs-down" href="#"
                           data-toggle="tooltip" title="list" data-placement="bottom" role="button"><i
                                    class="fa fa-bars"></i></a>
                        <div class="dropdown float-right">
                            <button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">Date Added <i class="fa fa-caret-down"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item active" href="#">Date Added</a>
                                <a class="dropdown-item" href="#">Popular</a>
                                <a class="dropdown-item" href="#">Newest</a>
                                <a class="dropdown-item" href="#">Oldest</a>
                            </div>
                        </div>
                    </div>

                    <!-- post -->
                    @foreach($blogs as $blog)
                        <div class="post">
                            <h2 class="post-title"><a
                                        href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($blog->id) ]) }}">{{ $blog->title }}</a>
                            </h2>
                            <div class="post-meta">
                                <span><i class="fa fa-clock-o"></i> {{ $blog->blog_date }} by <a
                                            href="profile.html">{{ $blog->authors }}</a></span>
                                <span>
                            <a href="blog-post.html#comments"><i class="fa fa-eye"></i> {{ rand(50,100) }} views</a>
                            </span>
                            </div>
                            <div class="post-thumbnail">
                                <a href="{{ route('blog-detail', ['slug' => $blog->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($blog->id) ]) }}">
                                    <img src="{{ urlBlogImage($blog->image) }}"
                                         alt="Uncharted The Lost Legacy First Gameplay Details Revealed">
                                </a>
                                <span class="badge badge-ps4">{{ badgesBlog($blog->category) }}</span>
                            </div>
                            <p>{{ $blog->deck }}</p>
                        </div>
                    @endforeach

                    <div class="pagination-results d-flex justify-content-between">
                        <span>Showing {{ $blogs->perPage() }} to {{ $blogs->count() * $blogs->currentPage() }} of {{ $blogs->total() }} results</span>
                        {{ $blogs->links() }}
                    </div>
                    <!-- /.post -->
                </div>

                <!-- sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <!-- widget-games -->
                        <div class="widget widget-games">
                            <h5 class="widget-title">Upcoming Games</h5>
                            @foreach($upcomingGames as $key => $game)
                                <a href="#"
                                   style="background-image: url('{{ showImageGameUrl($game->cover) }}')">
                                    <span class="overlay"></span>
                                    <div class="widget-block">
                                        <div class="count">{{ $key + 1 }}</div>
                                        <div class="description">
                                            <h5 class="title">{{ $game->name }}</h5>
                                            <span class="date">November 14, 2017</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- widget post -->
                        <div class="widget widget-post">
                            <h5 class="widget-title">Reviews</h5>
                            <ul class="widget-list">
                                @foreach($topReviews as $review)
                                    <li>
                                        <div class="widget-img">
                                            <a href="blog-post.html" style="position: relative">
                                                <img src="{{ urlReviewImage($review->image) }}" alt="">
                                                <div class="score-review">
                                                    @if($review->score >= 8)
                                                        <span class="badge badge-primary">{{ $review->score }}</span>
                                                    @elseif($review->score <8 && $review->score >= 7)
                                                        <span class="badge badge-success">{{ $review->score }}</span>
                                                    @elseif($review->score < 7 && $review->score >= 4)
                                                        <span class="badge badge-warning">{{ $review->score }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $review->score }}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                        <div>
                                            <h4><a href="blog-post.html">{{ $review->title }}</a></h4>
                                            <span>{{ $review->date_by_format }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- widget tabs -->
                        <div class="widget widget-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a class="nav-link active" href="#comments"
                                                        aria-controls="comments" role="tab" data-toggle="tab"><i
                                                class="fa fa-comment-o"></i> Comments</a></li>
                                <li class="nav-item"><a class="nav-link" href="#popular" aria-controls="popular"
                                                        role="tab" data-toggle="tab">Popular</a></li>
                                <li class="nav-item"><a class="nav-link" href="#recent" aria-controls="recent"
                                                        role="tab" data-toggle="tab">Recent</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="comments">
                                    <ul class="widget-comments">
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-2.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post.html#comments"><b>Elizabeth:</b> It would have taken
                                                    a ridiculous amount of careful precise actions.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-3.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-disqus.html#comments"><b>Clark:</b> Lorem ipsum dolor
                                                    sit amet, consectetur adipiscing elit curabitur risque.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-1.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-video.html#comments"><b>Venom:</b> Practically no
                                                    verticality, which on levels like The Spire (Geonosis)
                                                    incredible.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-3.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-disqus.html#comments"><b>Clark:</b> I'm low level at
                                                    this point and have almost nothing unlocked, and veteran players
                                                    have an unfair advantage over me thanks.</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div><a href="profile.html"><img src="img/user/user-5.jpg" alt=""></a></div>
                                            <div>
                                                <a href="blog-post-disqus.html#comments"><b>Trevor:</b> A lot of people
                                                    would have stopped playing now if it wasn't for the online
                                                    stuff!</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="popular">
                                    <div class="widget-post">
                                        <ul class="widget-list">
                                            <li>
                                                <img src="https://i1.ytimg.com/vi/B6qY-P4eo1Q/mqdefault.jpg" alt="">
                                                <h4><a href="blog-post.html">How to Finish Mafia 3 With All of Your
                                                        Underbosses</a></h4>
                                                <span><i class="fa fa-clock-o"></i> July 12, 2017</span>
                                                <span>19 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">Uncharted: The Lost Legacy's Demo</a></h4>
                                                <span>June 28, 2017</span>
                                                <span>41 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">Mafia III Stones Unturned DLC Launch
                                                        Trailer</a></h4>
                                                <span>June 17, 2017</span>
                                                <span>7 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="recent">
                                    <div class="widget-post">
                                        <ul class="widget-list">
                                            <li>
                                                <img src="https://i1.ytimg.com/vi/ckUrcdnWZ2g/mqdefault.jpg" alt="">
                                                <h4><a href="blog-post.html">Free Mass Effect: Andromeda Trial Now
                                                        Available On All Platforms</a></h4>
                                                <span><i class="fa fa-clock-o"></i> July 12, 2017</span>
                                                <span>76 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">GTA 5 Online Players Find Secret Alien
                                                        Mission</a></h4>
                                                <span>June 23, 2017</span>
                                                <span>34 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                            <li>
                                                <h4><a href="blog-post.html">Mafia III Stones Unturned DLC Launch
                                                        Trailer</a></h4>
                                                <span>June 17, 2017</span>
                                                <span>7 comments</span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel
                                                    neque sed anter.</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /main -->
@endsection

@push('js')
    <script src="{{ asset('plugins/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script>
        (function ($) {
            "use strict";
            // owl carousel
            $('.owl-posts').owlCarousel({
                lazyLoad: true,
                margin: 5,
                loop: true,
                dots: false,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    1024: {
                        items: 1,
                        center: false
                    },
                    1200: {
                        items: 2,
                        center: true
                    }
                }
            });
        })(jQuery);
    </script>
@endpush