@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

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
                    <a class='btn-sm btn-info' href='#'>Subreddit options</a>
                    <hr>
                    <a class='btn-sm btn-danger' href='{{ route("post.create",['id' => $subreddit->id]) }}'>Submit Post</a>
                    <hr>
                    <span id='sub-count'>{{ $subreddit->subscriptions->count() }}</span> subscribed
                    <button data-id='{{ $subreddit->id }}' data-url='{{ URL::route('unsubcribe.subreddit') }}' onclick='unsubscribeSubreddit(this);' class='btn-xs btn-danger' >subscribe</button>
                    <hr>
                    <ul>Moderators
                    @foreach($subreddit->moderators as $mod)
                    <li>{{ $mod->username }}</li>    
                    @endforeach
                    </ul>
                    <ul>
                        <li>1#Rule</li>
                        <li>2#Rule</li>
                        <li>3#Rule</li>
                        <li>4#Rule</li>
                        <li>5#Rule</li>
                    </ul>
            </div>

        </div>
    </div>
</div>
@endsection
