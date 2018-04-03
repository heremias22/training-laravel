@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Showing a single subreddit</div>

                <div class="panel-body">
                   
                <form class="form-horizontal" method="POST" action="{{ route("subreddits.update", [$subreddit->id]) }}">
                        {{ csrf_field() }}
                        @method("PUT")
                        <label for='name'>Subreddit name</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $subreddit->name }}" disabled>
                            </div>
                        </div>
                        <label for='description'>Subreddit description</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control" name="description" required autofocus>{{ $subreddit->description }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                <a href='#' type="button" class="btn btn-danger" 
                                onclick="
                                var accept = confirm('Do you wanna delete this subreddit?');
                                if(accept){
                                    document.getElementById('deleteSubreddit').submit();
                                }">
                                    Delete
                                    </a>
                                <a href='{{ route("subreddits.index") }}' type="button" class="btn btn-primary">
                                    Go Back
                                </a>
                            </div>
                        </div>
                    </form>
                    <form id='deleteSubreddit' method='post' action='{{ route("subreddits.destroy", [$subreddit->id]) }}' style='display:none'>
                            {{ csrf_field() }}
                            @method("DELETE")
                        <input name='id' value='{{ $subreddit->id }}' required>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
