@extends('layout.blank')

@section('title', $game->name)

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/css/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/slick/css/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugins/jquery-bar-rating-master/dist/themes/bars-square.css') }}">
@endpush

@section('content')
    <section class="hero hero-game"
             style="background-image: url('{{ empty(json_decode($game->screenshots)) ? asset('img/bg-empty.jpeg') : gameBackgroundImg($game) }}');">
        <div class="overlay"></div>
        <div class="container">
            <div class="hero-block row">
                <div class="hero-left col-lg-8">
                    <h2 class="hero-title">{{ $game->name }}</h2>
                    @if(!empty($game->summary))
                        <p class="text-over-summary-game">{{ $game->summary }}</p>
                    @endif
                    @if(!empty(json_decode($game->videos)))
                        <a class="btn btn-primary btn-shadow btn-rounded btn-lg"
                           href="{{ getUrlTrailerGame($game) }}" data-lightbox role="button">
                            Watch Trailer<i class="fa fa-play"></i>
                        </a>
                    @endif
                    <a class="btn btn-outline-default btn-shadow btn-rounded btn-lg m-l-10"
                       href="https://themeforest.net/item/gameforest-responsive-gaming-html-theme/5007730"
                       target="_blank" role="button">Follow Now<i class="fa fa-heart"></i></a>
                </div>
                <div class="hero-right col-lg-4">
                    <div class="hero-review">
                        <span>MetaCritic</span>
                        <a href="javascript:void(0)" class="chart easypiechart"
                           data-percent="{{ showRating($game->total_rating)  }}"
                           data-scale-color="#e3e3e3">
                            <span>{{ showRating($game->total_rating) }}</span>%
                        </a>
                    </div>
                    <div class="hero-review">
                        <span>User</span>
                        <a href="javascript:void(0)">{{ showRating($game->rating)  }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p-t-30">
        <div class="container">
            <div class="row game-detail-information">
                <div class="col-lg-8">
                    <div class="tabs-color">
                        <ul class="nav nav-tabs nav-icon-left" role="tablist">
                            <li class="nav-item"><a class="nav-link active" href="#color-profile"
                                                    aria-controls="profile" role="tab" data-toggle="tab"><i
                                            class="fa fa-video-camera"></i> Highlight</a></li>
                            <li class="nav-item"><a class="nav-link" href="#color-settings" aria-controls="settings"
                                                    role="tab" data-toggle="tab"><i class="fa fa-user-plus"></i>
                                    Blog</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#color-inbox" aria-controls="inbox"
                                                    role="tab" data-toggle="tab"><i class="fa fa-bar-chart"></i>
                                    Review</a></li>
                            @if($game->first_release_date <= now() && !empty($game->multiple))
                                <li class="nav-item"><a class="nav-link" href="#color-multiple" aria-controls="multiple"
                                                        role="tab" data-toggle="tab"><i class="fa fa-users"></i>Multiplayer</a>
                                </li>
                            @endif
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="color-profile" role="tabpanel">
                                @if(count(json_decode($game->videos)) >= 1)
                                    <div class="video-game" id="video-game">
                                        @foreach(json_decode($game->videos) as $video)
                                            <div class="video-game-item">
                                                <div class="youtube-player" data-id="{{ $video->video_id }}"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if(count(json_decode($game->screenshots))>= 1)
                                    <div class="slicker-show-up slider d-flex mb-5 p-2">
                                        @foreach(json_decode($game->screenshots) as $img)
                                            <div class="game-list-inline-item">
                                                <a class="img-box" href="{{ gameScreenshotFull($img) }}" data-lightbox>
                                                    <img class="img-responsive lazyload blur-up"
                                                         data-src="{{ gameScreenshot($img) }}"
                                                         alt="{{ $img }}">
                                                    <div class="overlay-img">
                                                        <div class="text"><i class="fa fa-search-plus"
                                                                             aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane" id="color-settings" role="tabpanel">
                                @include('game.sub.blog')
                            </div>
                            <div class="tab-pane" id="color-inbox" role="tabpanel">
                                <p class="m-b-0">Quisque et tincidunt dolor. Praesent nec lacinia dolor. Pellentesque
                                    ligula ante, dignissim a suscipit in, rutrum ac nulla. Fusce sagittis dolor massa,
                                    in pellentesque erat ultricies vitae.</p>
                            </div>

                            @if(!empty($game->multiple))
                                <div class="tab-pane" id="color-multiple" role="tabpanel">
                                    <div class="table-responsive m-b-0">
                                        <table class="table">
                                            <tr>
                                                <th>Campaign Coop</th>
                                                <td>
                                                    {!! showCheckMark($game->multiple->campaigncoop) !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Drop in/out</th>
                                                <td>{!! showCheckMark($game->multiple->dropin) !!}</td>
                                            </tr>
                                            <tr>
                                                <th>LAN Co-op</th>
                                                <td>{!! showCheckMark($game->multiple->lancoop) !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Offline Co-op</th>
                                                <td>{!! showCheckMark($game->multiple->offlinecoop) !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Offline Co-op max players</th>
                                                <td>{{ $game->multiple->offlinecoopmax }}</td>
                                            </tr>
                                            <tr>
                                                <th>Offline max players</th>
                                                <td>{{ empty($game->multiple->offlinemax) ? '' : $game->multiple->offlinemax  }}</td>
                                            </tr>
                                            <tr>
                                                <th>Online Co-op</th>
                                                <td>{!! showCheckMark($game->multiple->onlinecoop) !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Online Co-op max players</th>
                                                <td>{{ $game->multiple->onlinecoopmax }}</td>
                                            </tr>
                                            <tr>
                                                <th>Online max players</th>
                                                <td>{{ empty($game->multiple->onlinemax)  ?  '' : $game->multiple->onlinemax }}</td>
                                            </tr>
                                            <tr>
                                                <th>Offline Split-Screen</th>
                                                <td>{!! showCheckMark($game->multiple->splitscreen) !!}</td>
                                            </tr>
                                            <tr>
                                                <th>Online Split-Screen</th>
                                                <td>{!! showCheckMark($game->multiple->splitscreenonline) !!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget widget-game">
                        <div class="widget-block"
                             style="background-image: url('{{  empty($game->cover) ? asset('img/bg-empty.jpeg') : gameBigCover($game) }}')">
                            <div class="overlay"></div>
                            <div class="widget-item">
                                <h4>{{ $game->name }}</h4>
                                <span class="meta">Released: {{ $game->release_date }}</span>

                                <h5>Platforms</h5>

                                @if(!empty($game->platform))
                                    @foreach($game->platform as $plat_cate)
                                        <a href="javascript:void(0)"><span
                                                    class="badge badge-ps4 mt-2">{{ $plat_cate->platform['name'] }}</span></a>
                                    @endforeach
                                @endif


                                @if(!empty($game->developed))
                                    <h5>Developed</h5>
                                    <ul>
                                        @foreach($game->developed as $cate)
                                            <li class="mr-2"><a
                                                        href="javascript:void(0)">{{ $cate->company['name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif

                                <h5>Published</h5>
                                @if(!empty($game->publisher_game))
                                    <ul>
                                        @foreach($game->publisher_game as $cate)
                                            <li class="mr-2"><a
                                                        href="javascript:void(0)">{{ $cate->company['name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif

                                <h5>Engine</h5>
                                @if(!empty($game->engine))
                                    <ul>
                                        @foreach($game->engine as $cate_engine)
                                            <li><a href="javascript:void(0)">{{ $cate_engine->engine['name'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif

                                <h5>Genre</h5>
                                @if(!empty($game->genre))
                                    <ul>
                                        @foreach($game->genre as $cate)
                                            <li class="mr-2"><a href="javascript:void(0)">{{ $cate->genre['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <h5>Game Mode</h5>
                                @if(!empty($game->mode))
                                    <ul>
                                        @foreach($game->mode as $cate)
                                            <li class="mr-2"><a href="javascript:void(0)">{{ $cate->mode['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <h5>Theme</h5>
                                @if(!empty($game->theme))
                                    <ul>
                                        @foreach($game->theme as $cate)
                                            <li class="mr-2"><a href="javascript:void(0)">{{ $cate->theme['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <h5>Summary</h5>
                                <p>{{ $game->summary ?? '' }}</p>


                                <h5>Storyline</h5>
                                <p>{{ $game->storyline ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script type="text/javascript" src="{{ asset('plugins/slick/js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/lightbox/lightbox.js') }}"></script>
    <script src="{{ asset('plugins/jquery-bar-rating-master/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('plugins/sticky/jquery.sticky.js') }}"></script>
    <script src="{{ asset('plugins/easypiechart/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('plugins/easypiechart/jquery.easypiechart.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.chart').easyPieChart({
                barColor: '#5eb404',
                trackColor: '#e3e3e3',
                easing: 'easeOutBounce',
                onStep: function (from, to, percent) {
                    $(this.el).find('span').text(Math.round(percent));
                }
            });

            $('[data-lightbox]').lightbox();
        });
    </script>

    <script>
        $(document).ready(function () {
            //init slide img
            $(".slicker-show-up").slick({
                autoplay: true,
                autoplaySpeed: 4000,
                variableWidth: true,
                lazyLoad: "progressive",
                dots: true,
                centerMode: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
            });

            function postMessageToPlayer(player, command) {
                if (player == null || command == null) return;
                player.contentWindow.postMessage(JSON.stringify(command), "*");
            }

            function playPauseVideo(slick, control) {
                var currentSlide, player;

                currentSlide = slick.find(".slick-current");
                player = currentSlide.find("iframe").get(0);
                switch (control) {
                    case "play":
                        postMessageToPlayer(player, {
                            "event": "command",
                            "func": "playVideo"
                        });
                        break;
                    case "pause":
                        postMessageToPlayer(player, {
                            "event": "command",
                            "func": "pauseVideo"
                        });
                        break;
                }
            }

            var slideWrapper = $("#video-game");

            slideWrapper.on("beforeChange", function (event, slick) {
                slick = $(slick.$slider);
                playPauseVideo(slick, "pause");
            });

            $('#video-game').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                //autoplay: true,
                infinite: true,
                adaptiveHeight: true,
                //autoplaySpeed: 4000,
                lazyLoad: "progressive",
                speed: 600,
                arrows: true,
                dots: true,
                draggable: false,
                fade: true,
                cssEase: "cubic-bezier(0.87, 0.03, 0.41, 0.9)"
            });
        });
    </script>

    <script>
        // Embed youtube
        /* Light YouTube Embeds by @labnol */
        /* Web: http://labnol.org/?p=27941 */
        document.addEventListener("DOMContentLoaded",
            function () {
                var div, n,
                    v = document.getElementsByClassName("youtube-player");
                for (n = 0; n < v.length; n++) {
                    div = document.createElement("div");
                    div.setAttribute("data-id", v[n].dataset.id);
                    div.innerHTML = labnolThumb(v[n].dataset.id);
                    div.onclick = labnolIframe;
                    v[n].appendChild(div);
                }
            });

        function labnolThumb(id) {
            var thumb = '<img src="https://i.ytimg.com/vi/ID/sddefault.jpg">',
                play = '<div class="play"></div>';
            return thumb.replace("ID", id) + play;
        }

        function labnolIframe() {
            var iframe = document.createElement("iframe");
            var embed = "https://www.youtube.com/embed/ID?autoplay=1&enablejsapi=1";
            iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allowfullscreen", "1");
            iframe.setAttribute("allow", "autoplay");
            this.parentNode.replaceChild(iframe, this);
        }
    </script>
@endpush

