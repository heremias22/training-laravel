
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
                    </div>
                    @endforeach
            </div>
    </div>

