<div style="text-align: center; padding-bottom: 30px;">
    <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px;">Comments</h1>
    <form id="addComment" action="">
        @csrf
        <textarea id="comment" name="comment" style="height: 150px; width: 600px;" placeholder="Comment something here"></textarea>
        <br>
        <input type="submit" class="btn btn-primary" value="Comment">
    </form>
</div>

<div style="margin-left: 20%">
    @include('user.comments.user_comments')
</div>

    <div class="replyDiv" style="display: none">
        <form id="addCommentReply" action="">
            @csrf
            <textarea id="reply"  name="reply" style="height: 150px; width: 600px;" placeholder="Write something here"></textarea>
            <input type="hidden" id="comment_id" name="comment_id">
            <br>
            <button class="btn btn-warning" type="submit">Reply</button>
            <a onclick="replyClose(this)" class="btn btn-dark" href="javascript:void(0);">Close</a>
        </form>
    </div>

<script>

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addComment').on('submit', function (e) {
            e.preventDefault();
            let comment = $('#comment').val();
            $.ajax({
                url: "/add_comment",
                type: "POST",
                data: {
                    comment: comment,
                },
                success: function (data) {
                    showComments();
                    $("#addComment")[0].reset();
                }
            })
        })
        $('#addCommentReply').on('submit', function (e) {
            e.preventDefault();
            let comment_id = $('#comment_id').val();
            let reply = $('#reply').val();
            $.ajax({
                url: "/add_comment_reply",
                type: "POST",
                data: {
                    comment_id: comment_id,
                    reply: reply,
                },
                success: function () {
                    $("#addCommentReply")[0].reset();
                    showComments();
                }
            })
        })
        $('#deleteComment').click(function (e) {
            e.preventDefault();
            let id = $('#comment_id').val();
            $.ajax({
                url: "delete_comment/"+id,
                type: "POST",
                data: {
                    id: id,
                },
                success: function () {
                    showComments();
                    console.log(id);
                    }
                })
            })
    })

    function showComments()
    {
        $.ajax({
            url: "/show_comments",
            type: "GET",
            success: function (data) {
                $("#comments").html(data);
            }
        });
    }

    function reply(caller)
    {
        document.getElementById('comment_id').value = $(caller).attr('data-commentId');
        $('.replyDiv').insertAfter($(caller));
        $('.replyDiv').show();
    }

    function replyClose(caller)
    {
        $('.replyDiv').hide();
    }
</script>



