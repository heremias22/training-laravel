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
@endsection
