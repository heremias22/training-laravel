
    <div class="row">
            <div style='text-align:left;  margin-left:5px;'> Edit Comment</div>
            <div class="panel panel-default">
                <div class="panel-body">
                   
                    <form class="form-horizontal" method="POST" action="{{ route('comments.update', [$comment]) }}">
                        {{ csrf_field() }}
                        @method("PUT")

                        <label for='body'>Body</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control" name="body" value="{{ old('body') }}" required autofocus></textarea>
                            </div>
                        </div>
                    <input type='hidden' value='{{ $comment->post_id }}' name='post_id'>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
    </div>

