
    <div class="row">
            <div style='text-align:left;  margin-left:5px;'> new Comment</div>
            <div class="panel panel-default">
                <div class="panel-body">
                   
                    <form class="form-horizontal" method="POST" action="{{ route('comments.store') }}">
                        {{ csrf_field() }}
    
                        <label for='body'>Body</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control" name="body" value="{{ old('body') }}" required autofocus></textarea>
                            </div>
                        </div>
                    <input type='hidden' value='{{ $post->id }}' name='post_id'>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
    </div>

