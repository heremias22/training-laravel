@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Showing a Profile from another user</div>

                <div class="panel-body">
                   
                        <label for='description'>username</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" required autofocus value='{{ $user->username }}' disabled>
                            </div>
                        </div>

                        <label for='name'>Nombre</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <label for='name'>Email</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                     
                                <a href='{{ route("subreddits.index") }}' type="button" class="btn btn-primary">
                                    Go Back
                                </a>

                    <hr>
                    <h3 style='text-align:center'>Activity</h3>

                    @if ($user->subreddits->count())
                        
                        <h4 style='text-align:left'>Subreddits</h4>
                        <div class='panel-body'>
                            @foreach ($user->subreddits as $creador)
                                <a href='{{ route("subreddit.main",[$creador])}}'>{{ $creador->name }}</a>
                            @endforeach
                        </div>
                    @endif

                    @if ($user->comments->count())

                        <h4 style='text-align:left'>Comments</h4>
                        <div class='panel-body'>
                            @foreach ($user->comments as $comment)
                                <a href='{{ route("posts.show",[$comment->post_id])}}'>{{ $comment->body }}</a>
                                <hr>
                            @endforeach
                        </div>
                    @endif

                    @if ($user->posts->count())

                        <h4 style='text-align:left'>Posts</h4>
                        <div class='panel-body'>
                            @foreach ($user->posts as $post)
                                <a href='{{ route("posts.show",[$post->id])}}'>{{ $post->name }}</a>
                                <hr>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
