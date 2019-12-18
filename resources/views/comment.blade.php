@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endpush

<div id="comments" class="comments anchor">
    <input id="type" hidden value="{{ $comments->first()->type ?? 'no-comment' }}">
    <input id="core_id" hidden value="{{ $comments->first()->core_id ?? 'no-comment' }}">

    <div class="comments-header">
        <h5><i class="fa fa-comment-o m-r-5"></i> Comments ({{ $totalComment }})</h5>
        @if($comments->total() > 1)
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Sorted by Best
                    <span class="caret"></span></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item active" href="#">Best</a>
                    <a class="dropdown-item" href="#">Latest</a>
                    <a class="dropdown-item" href="#">Oldest</a>
                    <a class="dropdown-item" href="#">Random</a>
                </div>
            </div>
        @endif
    </div>

    <div class="text-editor mt-5">
        <div class="form-group">
            <div class="summernote"></div>
        </div>
        <button class="btn btn-primary btn-comment">Submit Comment</button>
    </div>

    <div id="loading-gif">
    </div>

    <ul id="comments-list">
        @if($comments->total() >= 1)
            @foreach($comments as $comment)
                <li class="li-comment">
                    <div class="comment">
                        <div class="comment-avatar">
                            <a href="profile.html"><img src="{{ asset('img/avatar.png') }}" alt="avatar"></a>
                        </div>
                        <div class="comment-post">
                            <div class="comment-header">
                                <div class="comment-author">
                                    <h5><a href="profile.html">{{ $comment->user->name }}</a></h5>
                                    <span>Member</span>
                                </div>
                                <div class="comment-action">
                                    <div class="dropdown float-right">
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false"><i class="fa fa-chevron-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Moderate</a>
                                            <a class="dropdown-item" href="#">Embed</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                            <a class="dropdown-item" href="#">Mark as spam</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! $comment->content !!}
                            <div class="comment-footer">
                                <ul>
                                    <li><a href="#"><i class="fa fa-heart-o"></i> Like</a></li>
                                    <li><a class="reply-btn" data-comment="{{ $comment->id }}" href="#"><i
                                                    class="icon-reply"></i>
                                            Reply</a></li>
                                    <li><a href="#"><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(count($comment->reply) >= 1)
                        <ul class="reply ul-reply">
                            @foreach($comment->reply as $reply)
                                <li class="li-reply">
                                    <div class="comment">
                                        <div class="comment-avatar"><img src="{{ asset('img/avatar.png') }}" alt="">
                                        </div>
                                        <div class="comment-post">
                                            <div class="comment-header">
                                                <div class="comment-author">
                                                    <h5><a class="name-author" href="#">{{ $reply->user->name }}</a>
                                                    </h5>
                                                    <span>Member</span>
                                                </div>
                                                <div class="comment-action">
                                                    <div class="dropdown float-right">
                                                        <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                                           aria-expanded="false"><i class="fa fa-chevron-down"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#">Moderate</a>
                                                            <a class="dropdown-item" href="#">Embed</a>
                                                            <a class="dropdown-item" href="#">Report</a>
                                                            <a class="dropdown-item" href="#">Mark as spam</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! $reply->content !!}
                                            <div class="comment-footer">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-heart-o"></i> Like</a></li>
                                                    <li><a class="reply-btn" data-comment="{{ $reply->parent_id }}"
                                                           href="#"><i
                                                                    class="icon-reply"></i>
                                                            Reply</a></li>
                                                    <li><a href="#"><i
                                                                    class="fa fa-clock-o"></i> {{ $reply->created_at }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <form class="reply-editor" data-comment="{{ $comment->id }}">
                            </form>
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>

    @if($comments->currentPage() < $comments->lastPage())
        <div class="d-flex justify-content-center mb-5">
            <button id="btn-load-more" class="btn btn-primary btn-rounded" href="javascript:void(0)" role="button">
                Load more comments
            </button>
        </div>
    @endif
</div>

@push('modal')
    <div class="modal fade" id="modal-login">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-sign-in"></i>Login or register to comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-a-20">
                    <form action="profile.html" method="post">
                        @include('sub.social', ['nextUrl' => \Illuminate\Support\Facades\Request::url()])
                        <div class="divider">
                            <span>or</span>
                        </div>
                        <a class="btn btn-secondary btn-block" id="register-open-modal"
                           href="{{ redirectSignIn('login') }}"
                           role="button">Login using password and email<i class="fa fa-sign-in"></i>
                        </a>
                        <div class="divider">
                            <span>Don't have an account?</span>
                        </div>
                        <a class="btn btn-secondary btn-block" href="{{ redirectSignIn('register') }}"
                           role="button">Register with password and email<i class="fa fa-sign-in"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script src="{{ asset('plugins/summernote/summernote-bs4.js') }}"></script>
    <script>
        function initEditor() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ["insert", ["link", "picture"]],
                ]
            });
        }

        //click reply
        $(document).on("click", '.btn-comment-close', function (event) {
            event.preventDefault();
            $(this).closest('form').html('');
        });

        //click close cancel comment
        $(document).on("click", '.reply-btn', function (event) {
            event.preventDefault();
            let comment_id = $(this).data('comment');
            let place;
            place = $("form[data-comment='" + comment_id + "']");
            place.hide().html(
                '                            <div class="text-editor">\n' +
                '                                <div class="form-group">\n' +
                '                                    <div class="summernote"></div>\n' +
                '                                </div>\n' +
                '                                <button class="btn btn-primary btn-comment">Submit Comment</button>' +
                '                                <button class="btn btn-danger btn-comment-close">Cancel</button>\n' +
                '                            </div>').fadeIn(1000);
            initEditor();
        });

        $(document).on("click", '.btn-comment', function (event) {
            event.preventDefault();
            let summernote = $(this).closest('div').find('.summernote');
            let content = summernote.summernote('code');
            let clean_content = content.replace(/<\/?[^>]+(>|$)/g, "");

            $.ajax({
                type: "GET",
                url: "/check-login-ajax",
                success: function (data) {
                    let response = JSON.parse(data);
                    if (response.status === 'fail') {
                        console.log(JSON.parse(data).status);
                        $('#modal-login').modal('show');
                    }
                }
            });
        });


        $(document).ready(function () {
            "use strict";
            var page = 2;
            $("#btn-load-more").click(function (event) {
                event.preventDefault();
                $('#loading-gif').html('<a class="btn btn-primary text-left m-t-15 btn-block" href="#comments" role="button"><i class="fa fa-spinner fa-pulse m-r-5"></i> Loading more comments</a>');
                $.ajax({
                    type: "GET",
                    url: "/comments?page=" + page + '&core_id=' + $('#core_id').val() + '&type=' + $('#type').val(),
                    success: function (data) {
                        $("#comments-list").append(data);
                        $('#loading-gif').html('');
                        page = page + 1;
                    }
                });
            });

            initEditor();
        });
    </script>
@endpush