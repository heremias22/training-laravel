@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Showing a single User</div>

                <div class="panel-body">
                   
                <form class="form-horizontal" method="POST" action="{{ route("users.update", [$user->id]) }}">
                        {{ csrf_field() }}
                        @method("PUT")

                        <label for='description'>username</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" required autofocus value='{{ $user->username }}' disabled>
                            </div>
                        </div>

                        <label for='name'>Nombre</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <label for='name'>Email</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group">
                           
                                <button style='margin-left:10px;' type="submit" class="btn btn-success">
                                    Update
                                </button>
                                <a href='#' type="button" class="btn btn-danger" 
                                onclick="
                                var accept = confirm('Do you wanna delete this user?');
                                if(accept){
                                    document.getElementById('deleteuser').submit();
                                }">
                                    Delete
                                    </a>
                                <a href='{{ route("subreddits.index") }}' type="button" class="btn btn-primary">
                                    Go Back
                                </a>
                            
                        </div>
                    </form>
                    <form id='deleteuser' method='post' action='{{ route("users.destroy", [$user->id]) }}' style='display:none'>
                            {{ csrf_field() }}
                            @method("DELETE")
                        <input name='id' value='{{ $user->id }}' required>
                    </form>

                    <hr>
                    <h3 style='text-align:center'>Activity</h3>

                    @if ($user->subreddits->count())
                        
                        <h4 style='text-align:left'>Your Subreddits</h4>
                        <div class='panel-body'>
                            @foreach ($user->subreddits as $creador)
                                <a href='{{ route("subreddits.show",[$creador->id])}}'>{{ $creador->name }}</a>
                            @endforeach
                        </div>
                    @endif

                    @if ($user->comments->count())

                        <h4 style='text-align:left'>Your Comments</h4>
                        <div class='panel-body'>
                            @foreach ($user->comments as $comment)
                                <a href='{{ route("posts.show",[$comment->post_id])}}'>{{ $comment->body }}</a>
                                <hr>
                            @endforeach
                        </div>
                    @endif

                    @if ($user->posts->count())

                        <h4 style='text-align:left'>Your Posts</h4>
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
