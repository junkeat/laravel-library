@extends('layouts.app')

@section('content')
    <h1>Edit Book</h1>
    {!! Form::open(['action' => ['BooksController@update', $book->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $book->name, ['class' => 'form-control', 'placeholder' => 'Book Name'])}}
        </div>
        <div class="form-group">
                {{Form::label('author', 'Author')}}
                {{Form::text('author', $book->author, ['class' => 'form-control', 'placeholder' => 'Book Author'])}}
            </div>
        <div class="form-group">
            {{Form::label('synopsis', 'Synopsis')}}
            {{Form::textarea('synopsis', $book->synopsis, ['class' => 'form-control', 'placeholder' => 'Synopsis', 'id' => 'article-ckeditor'])}}
        </div>
        <div class="form-group">
                {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection