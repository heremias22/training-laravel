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
                        @if($post->isOwner(auth()->user()))
                        <button class='btn-xs btn-primary'>Delete</button>
                        <button class='btn-xs btn-danger'>Edit</button>
                        @endif
                        <div class='pull-right'>
                            Points <span class='points_count badge'>{{ $post->getPoints() }}</span>
                                <a href="#" data-type='up' data-id='{{ $post->id }}' onclick="votePost(this);" class='btn-xs btn-primary'>Up</a>
                                <a href="#" data-type='down' data-id='{{ $post->id }}' onclick="votePost(this);" class='btn-xs btn-danger'>Down</a>
                        </div>
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
<script>
    function votePost(elemento){

    var url ="{{ route('vote.post') }}";
    var type = $(elemento).attr("data-type");
    var post = $(elemento).attr("data-id");
    //$(elemento).attr('disabled', true);

    $.ajax({
        dataType: 'json',
        type:'post',
        url: url,
        data:{id:post,type:type},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data) {
       
        $(elemento).parent().find("span").text(data.points);
    });
    }

</script>
@endsection
