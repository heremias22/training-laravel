@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List of ALL subreddits</div>
            @foreach($subreddits as $subreddit)
                <div class="panel-body">
                    <h2>{{ $subreddit->name }}</h2>
                    <br>
                    <p>{{ $subreddit->description }}</p>
                </div>
            @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
