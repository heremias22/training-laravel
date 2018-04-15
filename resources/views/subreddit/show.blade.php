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
           
            <hr>
            <div class="modal-body">
                    
                <ul style='list-style-type: none;'>
                        <form method="POST" action="{{ route("subreddit.add-moderator", [$subreddit]) }}">
                                @csrf
                                <input id='userInput' name="username" onchange='searchUser()'  />
                                <button class='btn-xs btn-success'>request mod</button>
                            </form>
             @foreach($subreddit->moderators as $moderator)
                <li>
                        
                    <span class='text-danger' style='font-weight:bold;'>{{$moderator->name }}</span>
                        <form method="POST" action="{{ route("subreddit.remove-moderator", [$subreddit, $moderator]) }}">
                            @method('DELETE')
                            @csrf
                            <button class='btn-xs btn-danger'>remove mod</button>
                        </form>
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
<script>
function searchUser(){

     var url ="{{ route('users.find') }}";
     var query = $("#userInput").val();
     console.log(query);
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data:{q:query},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data) {
       
        console.log(data);
    });

          }
</script>

@endsection
