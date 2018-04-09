@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">

                @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div><h2 style='text-align:center;'>{{$subreddit->name}}</h2></div>
            <hr>
            <a class='btn-sm btn-danger' href='{{ route("post.create",['id' => $subreddit->id]) }}'>Create Post</a>
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

        </div>
    </div>
</div>
@endsection
