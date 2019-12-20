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
            <div>
                {!! $comment->content !!}
            </div>
            <div class="comment-footer">
                <ul>
                    <li><a href="#"><i class="fa fa-heart-o"></i> Like</a></li>
                    <li><a class="reply-btn"
                           data-comment="{{ $comment->id }}"
                           data-name="{{ $comment->user->name }}"
                           data-user="{{ hashId($comment->user_id) }}"
                           href="#">
                            <i class="icon-reply"></i> Reply</a>
                    </li>
                    <li><a href="#"><i class="fa fa-clock-o"></i> {{ $comment->created_at }}</a></li>
                </ul>
            </div>
        </div>
    </div>


    <ul class="reply ul-reply" data-comment="{{ $comment->id }}">
        @if(count($comment->reply) >= 1)
            @foreach($comment->reply as $reply)
                @include('sub.item_reply', ['reply' => $reply])
            @endforeach
        @endif
        <form class="reply-editor" data-comment="{{ $comment->id }}">
        </form>
    </ul>
</li>