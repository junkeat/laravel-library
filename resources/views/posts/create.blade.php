@extends('layouts.app')

@section('content')
    <h1>Post Notice</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text', 'id' => 'article-ckeditor'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

        <hr>

    {{-- <form action="PostsController@store">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="" placeholder="Title" class="form-control">
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control" placeholder="Body Text"></textarea>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form> --}}
@endsection