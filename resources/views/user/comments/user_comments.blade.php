<div id="comments">
    @if($comments_count > 0)
    <h1 style="font-size: 40px; padding-bottom:1px;">All Comments</h1>
        @foreach($comments as $comment)
            <b style="font-size: 20px;">{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a data-commentId="{{$comment->id}}" style="color: #0e0ed6"
               onclick="reply(this)" href="javascript:void(0);">Reply</a>
            @if($user_id == $comment->user_id)
                <a id="deleteComment" style="color: #d90808" href="javascript:void(0);">Delete</a>
            @endif
            @foreach($replies as $reply)
                @if($reply->comment_id == $comment->id)
                    <div style="padding: 1%;">
                        <p>{{$reply->name}}</p>
                        <p>{{$reply->reply}}</p>
                    </div>
                @endif
            @endforeach
            <input id="comment_id" type="hidden" value="{{$comment->id}}">
            <br>
        @endforeach
    @else
        <h1 style="font-size: 40px; padding-bottom:1px;">No Comments</h1>
    @endif
</div>
