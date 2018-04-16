
    <div class="row">
            <div class="panel panel-primary">
                <div class='panel-heading'>Reply to post</div>
                <div class="panel-body">
                   <!-- CHANGE POST ID -->
                    <form class method="POST" action="comments/create/{{ $post->id }}">
                        {{ csrf_field() }}
    
                        <label for='body'>Body</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control" name="body" value="{{ old('body') }}" required autofocus></textarea>
                            </div>
                        </div>
                        @if(isset($parentId))
                            <input type='hidden' value='{{ $parentId }}' name='parent_id'>
                        @endif
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

