
    <div class="row">
        @foreach($collection as $comment)
        
            
            @include("comment.comment");
            
            @if($comment->replies)
                @foreach($comment->replies as $comment)
                    @include("comment.comment");
                @endforeach
            @endif

        @endforeach
    </div>
    <script>
        
function voteComment(elemento){

    var url ="{{ route('vote.comment') }}";
    var type = $(elemento).attr("data-type");
    var comment = $(elemento).attr("data-id");
    //$(elemento).attr('disabled', true);

    $.ajax({
        dataType: 'json',
        type:'post',
        url: url,
        data:{id:comment,type:type},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    }).done(function(data) {
       
        $(elemento).parent().find("span").text(data.points);
    });
}

function showForm(elemento){
    var form_id = $(elemento).attr("data-id");

    if($(form_id).css("display")=="none"){
        $(form_id).show();
    } else {
        $(form_id).hide();
    }

   
}
    </script>

