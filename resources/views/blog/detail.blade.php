@extends('layout.blank')

@section('title', $blog->title)

{{--@section('breadcrumb')--}}
{{--    <section class="breadcrumbs">--}}
{{--        <div class="container">--}}
{{--            {{ Breadcrumbs::render('blog-detail', $blog) }}--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endsection--}}

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 hidden-md-down">
                    <!-- widget share -->
                    <div class="widget widget-share" data-fixed="widget">
                        <div class="widget-block">
                            <a class="btn btn-social btn-facebook btn-circle" href="#" data-toggle="tooltip"
                               title="Share on Facebook" data-placement="right" role="button"><i
                                        class="fa fa-facebook"></i></a>
                            <a class="btn btn-social btn-twitter btn-circle" href="#" data-toggle="tooltip"
                               title="Share on Twitter" data-placement="right" role="button"><i
                                        class="fa fa-twitter"></i></a>
                            <a class="btn btn-social btn-google-plus btn-circle" href="#" data-toggle="tooltip"
                               title="Share on Google Plus" data-placement="right" role="button"><i
                                        class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <!-- post -->
                    <div class="post post-single mb-5">
                        <h2 class="post-title">{{ $blog->title }}</h2>
                        <div class="post-meta">
                            <span><i class="fa fa-clock-o"></i> {{ $blog->blog_date }} by <a
                                        href="javascript:void(0)">{{ $blog->authors }}</a></span>
                            {{--                            <span><a href="#comments"><i class="fa fa-comment-o"></i> 98 comments</a></span>--}}
                        </div>
                        <div class="post-thumbnail">
                            <img src="{{ urlBlogImage($blog->image) }}"
                                 alt="{{ $blog->title }}">
                        </div>

                        {!! $blog->body !!}
                    </div>

                    <div class="post-actions">
                        @if(!empty($associations))
                            <div class="post-tags">
                                @foreach($associations as $itemAss)
                                    <a href="javascript:void(0)">#{{ $itemAss['name'] }}</a>
                                @endforeach
                            </div>
                        @endif
                        <div class="social-share">
                            <a class="btn btn-social btn-facebook btn-circle" href="#" data-toggle="tooltip"
                               title="Share on Facebook" data-placement="bottom" role="button"><i
                                        class="fa fa-facebook"></i></a>
                            <a class="btn btn-social btn-twitter btn-circle" href="#" data-toggle="tooltip"
                               title="Share on Twitter" data-placement="bottom" role="button"><i
                                        class="fa fa-twitter"></i></a>
                            <a class="btn btn-social btn-google-plus btn-circle" href="#" data-toggle="tooltip"
                               title="Share on Google Plus" data-placement="bottom" role="button"><i
                                        class="fa fa-google-plus"></i></a>
                        </div>
                    </div>

                    @if(!empty($relatedBlog) && count($relatedBlog) >= 1)
                        <div class="post-related">
                            <h4 class="subtitle">Related Posts</h4>
                            <div class="row">
                                @foreach($relatedBlog as $related)
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="card card-widget">
                                            <div class="card-img">
                                                <a href="{{ route('blog-detail', ['slug' => $related->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($related->id) ]) }}">
                                                    <img src="{{ urlBlogImage($related->image) }}"
                                                         alt="{{ $related->title }}">
                                                </a>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="card-title">
                                                    <a href="{{ route('blog-detail', ['slug' => $related->slug, 'id' => \Vinkla\Hashids\Facades\Hashids::encode($related->id) ]) }}">{{ $related->title }}</a>
                                                </h4>
                                                <div class="card-meta"><span><i class="fa fa-clock-o"></i>{{ $related->blog_date }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @include('comment', [
                        'comments' => $comments,
                        'totalComment' => $commentsCount,
                        'core_id' => $blog->id,
                        'type' => \App\Model\Comment::BLOG
                        ])
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('iframe').each(function () {
                let attr_value = $(this).data("src");
                $(this).attr('src', attr_value);
            });
        });
    </script>
@endpush