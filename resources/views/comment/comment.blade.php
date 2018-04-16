
<div class="panel panel-default">
        <p style='font-size:1.3em'>{{ $comment->body }}</p>
        <p style='font-size:0.8em'>
        Submitted <span>{{ $comment->created_at->diffForHumans()}}</span>
        by <a href='#'><span>{{ $comment->user->username}}</span></a>
        </p>
        <button data-id='#form-reply{{ $comment->id }}'  class='btn-xs btn-info' onclick='showForm(this)'>Reply</button>
        @if($comment->user === auth()->user())
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
                Points <span class='points_count badge'>{{ $comment->getPoints() }}</span>
                    <a href="#" data-type='up' data-id='{{ $comment->id }}' onclick="voteComment(this);" class='btn-xs btn-primary'>Up</a>
                    <a href="#" data-type='down' data-id='{{ $comment->id }}' onclick="voteComment(this);" class='btn-xs btn-danger'>Down</a>
        </div>

        @if(auth()->check())
            @include('comment.create', ['parentId' => $comment->id])
        @endif
        <!--IF THIS COMMENT HAS COMMENTS RINSE AND REPEAT -->
        @if (isset($comments[$comment->id]))
            @include('comment.index', ['collection' => $comments[$comment->id]])
        @endif

      
</div>

    
   
