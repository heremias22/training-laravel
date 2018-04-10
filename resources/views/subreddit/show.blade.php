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

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmods">Manage mods</button>
                            
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

<!-- Modal -->
<div class="modal fade" id="addmods" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Add user to mod</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class='form-group'>
                <div class="input-group" style='margin:0 auto; display:block;'>
                    <input type="text" class="form-control" placeholder="Search user...">
                </div>
            </div>
            <hr>
            <div class="modal-body">
                    
                <ul style='list-style-type: none;'>
             @foreach($subreddit->subscriptions as $subscribed)
                <li>
                    <span class='text-danger' style='font-weight:bold;'>{{ $subscribed->user->name }}</span>
                    @if($subscribed->user->moderadedSubreddits()->where("user_id",$subscribed->user->id)->where("subreddit_id",$subreddit->id)->first())
                        <a href='{{ route("removeModerator.subreddit",[$subscribed->user,$subreddit]) }}' class='btn-xs btn-danger'>remove mod</a>
                    @else
                        <a href='{{ route("addModerator.subreddit",[$subscribed->user,$subreddit]) }}' class='btn-xs btn-success'>request mod</a>
                    @endif
                    
                    
                </li>
             @endforeach
                </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection
