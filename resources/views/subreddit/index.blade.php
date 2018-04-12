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

            <div class="panel panel-primary">
            @foreach($subreddits as $subreddit)
                <div class="panel-body">
                <h2><a href="{{ route('subreddit.main',[$subreddit])}}">{{ $subreddit->name }}</a></h2>
                <h4 class='pull-right'>
                    <span id='sub-count'>{{ $subreddit->subscriptions->count() }}</span> subscribed
                    @if(auth()->user()->isSubscribedTo($subreddit))
                        <button data-id='{{ $subreddit->id }}' data-url='{{ URL::route('unsubcribe.subreddit') }}' onclick='unsubscribeSubreddit(this);' class='btn-sm btn-info' >Unsubscribe</button>
                    @else
                        <button data-id='{{ $subreddit->id }}' data-url='{{ URL::route('subcribe.subreddit') }}' onclick='subcribeSubreddit(this);' class='btn-sm btn-info' >Subscribe</button>
                    @endif
                    </h4>
                    <br>
                    <p><strong>Description:</strong>{{ $subreddit->description }}</p>
                </div>
                <hr>
            @endforeach

          
            </div>

        </div>
    </div>
</div>
    <script type="text/javascript">
    
    function subcribeSubreddit(elemento){



var url = $(elemento).attr("data-url");
var subreddit_id = $(elemento).attr("data-id");
$(elemento).attr('disabled', true);

$.ajax({
    dataType: 'json',
    type:'post',
    url: url,
    data:{id:subreddit_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
}).done(function(data) {
   
        $(elemento).text("unsubcribe");
        $(elemento).attr("data-url","{{ URL::route('unsubcribe.subreddit') }}");
        var numero = parseInt($("#sub-count").text())+1;
        $("#sub-count").text(numero);
        $(elemento).attr("onClick","unsubscribeSubreddit(this)");
        $(elemento).attr('disabled', false);
});
}

function unsubscribeSubreddit(elemento){
var url = $(elemento).attr("data-url");
var subreddit_id = $(elemento).attr("data-id");
$(elemento).attr('disabled', true);

$.ajax({
    dataType: 'json',
    type:'post',
    url: url,
    data:{id:subreddit_id},
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
}).done(function(data) {

        $(elemento).text("subcribe");
        $(elemento).attr("data-url","{{ URL::route('subcribe.subreddit') }}");
        var numero = parseInt($("#sub-count").text())-1;
        $("#sub-count").text(numero);
        $(elemento).attr("onClick","subcribeSubreddit(this)");
        $(elemento).attr('disabled', false);    
}).fail(function(data) {
    alert('failed!');
});
}
    
    
    </script>
@endsection
