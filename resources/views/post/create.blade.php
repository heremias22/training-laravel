@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new POST</div>

                <div class="panel-body">
                   
                    <form class="form-horizontal" method="POST" action="{{ route('posts.store') }}">
                        {{ csrf_field() }}
                        <label for='name'>Post name</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>
                        <label for='body'>Post body</label>
                        <div class='form-group'>
                            <div class="col-md-6">
                                <textarea id="body" type="text" class="form-control" name="body" value="{{ old('body') }}" required autofocus></textarea>
                            </div>
                        </div>

                        <input id="subreddit_id" type="hidden" class="form-control" name="subreddit_id" value="{{ $id }}">

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
    </div>
</div>
@endsection
