@extends('layouts.app')

@section('content')
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
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
                <h2><a href="{{ route('subreddit.main',[$subreddit->id])}}">{{ $subreddit->name }}</a></h2>
                <h4 class='pull-right'>
                    {{ $subreddit->subscriptions->count() }} subscribed
                    @if(auth()->user()->isSubscribedTo($subreddit))
                        <a data-id='{{ $subreddit->id }}' onclick='suscribeSubreddit(this);' class='unsubscribe btn-sm btn-info' href='#'>Unsubscribe</a>
                    @else
                        <a data-id='{{ $subreddit->id }}' onclick='suscribeSubreddit(this);' class='suscribe btn-sm btn-info' href='#'>Subscribe</a>
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

        var url = "{{ URL::route('suscribe.subreddit') }}";
    /* Suscribe Subreddit */

        function suscribeSubreddit(elemento){

            var subreddit_id = $(elemento).attr("data-id");

            $.ajax({
                dataType: 'json',
                type:'post',
                url: url,
                data:{id:subreddit_id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }).done(function(data) {
                alert(data);
            });
        }

    </script>
@endsection
