@extends('layouts.app')

@section('content')
<div class="fluid-container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div><h2 style='text-align:center;'>{{$subreddit->name}}</h2></div>
            <hr>
            <hr>
                @foreach($subreddit->posts as $post)
                    <div class='panel panel-primary'>
                        <div class="panel-heading">
                            <h3 class='panel-title'><a href="{{ route('posts.show',[$post->id])}}">{{ $post->name }}</a></h3>
                        </div>            
                        <div class="panel-body">
                            
                            Submitted <span>{{ $post->updated_at->diffForHumans()}}</span>
                        by <a href='{{ route("user.profile",[$post->user]) }}'><span style='font-size:1.3em;'>{{ $post->user->username}}</span></a>
                        <a href='{{ route('posts.show',[$post->id])}}'><span class="badge badge-dark">{{ $post->comments->count() }}</span> Comments</a>
                            <div class='pull-right'>
                            Count <span class='points_count'>{{ $post->getPoints() }}</span>
                                <a href="#" data-type='up' data-id='{{ $post->id }}' onclick="votePost(this);" class='btn-xs btn-primary'>Upvote</a>
                                <a href="#" data-type='down' data-id='{{ $post->id }}' onclick="votePost(this);" class='btn-xs btn-danger'>Downvote</a>
                                <a href='#' onclick="formManual(this);">downVote manual</a>
                                <form id='manual{{$post->id}}' method="post" action="{{ route("vote.post")  }}">
                                        @csrf
                                    <input type="hidden" name='id' value='{{ $post->id }}'>
                                    <input type="hidden" name='type' value='down'>
                                    </form>
                            </div>
                        </div>
                  
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="col-md-2" style='border:1px solid black'>
                    <hr>
                    @if($subreddit->user->id===auth()->user()->id)
                        <a class='btn-sm btn-info' href='{{ route("subreddits.show",[$subreddit->id])}}'>Subreddit options</a>
                    @endif
                    <hr>
                    <a class='btn-sm btn-danger' href='{{ route("post.create",['id' => $subreddit->id]) }}'>Submit Post</a>
                    <hr>
                    <span id='sub-count'>{{ $subreddit->subscriptions->count() }}</span> subscribed
                    @if(auth()->user()->isSubscribedTo($subreddit))
                        <button data-id='{{ $subreddit->id }}' data-url='{{ URL::route('unsubcribe.subreddit') }}' onclick='unsubscribeSubreddit(this);' class='btn-sm btn-info' >Unsubscribe</button>
                    @else
                        <button data-id='{{ $subreddit->id }}' data-url='{{ URL::route('subcribe.subreddit') }}' onclick='subcribeSubreddit(this);' class='btn-sm btn-info' >Subscribe</button>
                    @endif
                    <hr>
                    <p>{{ $subreddit->description }}</p>
                    <ul class="list-group">Moderators
                    @foreach($subreddit->moderators as $mod)
                    <li class="list-group-item list-group-item-danger">{{ $mod->username }}</li>    
                    @endforeach
                    </ul>
                    <ul class="list-group">Rules
                        <li class="list-group-item list-group-item-warning" >1#Rule</li>
                        <li class="list-group-item list-group-item-warning">2#Rule</li>
                        <li class="list-group-item list-group-item-warning">3#Rule</li>
                        <li class="list-group-item list-group-item-warning">4#Rule</li>
                        <li class="list-group-item list-group-item-warning">5#Rule</li>
                    </ul>
            </div>

        </div>
    </div>
</div>
<script>

    function formManual(elemento){
        var prueba = $(elemento).next().attr("id");
        document.getElementById(prueba).submit();
    }

function votePost(elemento){

    var url ="{{ route('vote.post') }}";
    var type = $(elemento).attr("data-type");
    var post = $(elemento).attr("data-id");
    //$(elemento).attr('disabled', true);

    $.ajax({
        dataType: 'json',
        type:'post',
        url: url,
        data:{id:post,type:type},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data) {
       
        $(elemento).parent().find("span").text(data.points);
    });
    }

</script>
@endsection
