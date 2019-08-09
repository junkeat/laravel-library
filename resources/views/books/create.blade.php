@extends('layouts.app')

@section('content')
    <h1>Add Book</h1>
    {!! Form::open(['action' => 'BooksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Book Name', 'required' => 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('author', 'Author')}}
            {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author Name', 'required' => 'required'])}}
        </div>
        <div class="form-group">
            {{Form::label('synopsis', 'Synopsis')}}
            {{Form::textarea('synopsis', '', ['class' => 'form-control', 'placeholder' => 'Book Synopsis', 'required' => 'required', 'id' => 'article-ckeditor'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection