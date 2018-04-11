
    <div class="row">
            <div style='text-align:left; margin-left:5px;'>Comments</div>
            <div class="panel panel-default">
                    @foreach($post->comments as $comment)
                    <div class='panel-body' style='border-top:1px solid black;'>
                        <p style='font-size:1.3em'>{{ $comment->body }}</p>
                        <p style='font-size:0.8em'>
                        Submitted <span>{{ $comment->created_at->diffForHumans()}}</span>
                        by <a href='#'><span>{{ $comment->user->username}}</span></a>
                        </p>
                            <a href='#' class='btn-xs btn-danger'>Reply</a>
                        @if($comment->isOwner(auth()->user()))
                            <a href='{{ route("comments.edit",[$comment]) }}' class='btn-xs btn-primary'>Edit</a>
                            <a href='#' onclick="var accept = confirm('Do you wanna delete this comment?');
                                if(accept)document.getElementById('deleteComment').submit();" 
                                class='btn-xs btn-danger'>Delete</a>
                            <form id='deleteComment' method='post' action='{{ route("comments.destroy",[$comment]) }}' style='display:none'>
                                {{ csrf_field() }}
                                @method("DELETE")
                             </form>
                        @endif

                        <div class='pull-right'>
                                Count <span class='points_count'>{{ $comment->getPoints() }}</span>
                                    <a href="#" data-type='up' data-id='{{ $comment->id }}' onclick="voteComment(this);" class='btn-xs btn-primary'>Upvote</a>
                                    <a href="#" data-type='down' data-id='{{ $comment->id }}' onclick="voteComment(this);" class='btn-xs btn-danger'>Downvote</a>
                        </div>     

                    </div>
                    @endforeach
            </div>
    </div>
    <script>
        
function voteComment(elemento){

    var url ="{{ route('vote.comment') }}";
    var type = $(elemento).attr("data-type");
    var comment = $(elemento).attr("data-id");
    //$(elemento).attr('disabled', true);

    $.ajax({
        dataType: 'json',
        type:'post',
        url: url,
        data:{id:comment,type:type},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data) {
       
        $(elemento).parent().find("span").text(data.points);
    });
    }
    </script>

