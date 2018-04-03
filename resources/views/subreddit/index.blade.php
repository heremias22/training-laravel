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

            <div class="panel panel-default">
                <div class="panel-heading">List of ALL subreddits</div>
            @foreach($subreddits as $subreddit)
                <div class="panel-body">
                <h2><a href="{{ route('subreddits.show',[$subreddit->id])}}">{{ $subreddit->name }}</a></h2>
                    <br>
                    <p>{{ $subreddit->description }}</p>
                </div>
            @endforeach

          
            </div>

        </div>
    </div>
</div>
@endsection
