@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            <div class='panel panel-primary'>
                    <div class="panel-heading">
                        <h3 class='panel-title'><a href="{{ route('posts.show',[$post->id])}}">{{ $post->name }}</a></h3>
                    </div>            
                    <div class="panel-body">
                        Submitted <span>{{ $post->updated_at->diffForHumans()}}</span>
                        by <a href='#'><span>{{ $post->user->username}}</span></a>
                        <a href='{{ route('posts.show',[$post->id])}}'><span class="badge badge-dark">{{ $post->comments->count() }}</span> Comments</a>
                        <hr>
                        <p style='font-size:1.3em; border:solid 1px grey; padding:8px; border-radius:5px;'>{{ $post->body }}</p>
                    </div>
            </div>
            <hr>
            <div class='panel panel-primary'>
                <div class='panel-body'>
                    @include("comment.create")
                </div>
            </div>
            <hr>
            @if($post->comments->count())
                <div class='panel panel-primary'>
                    <div class='panel-body'>
                        @include("comment.index")
                    </div>
                </div>
            @endif
                    



        </div>
    </div>
</div>
@endsection
