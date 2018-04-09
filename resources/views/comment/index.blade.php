
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
                    </div>
                    @endforeach
            </div>
    </div>

