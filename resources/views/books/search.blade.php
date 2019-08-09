@extends('layouts.app')

@section('content')
    <h1>Books</h1>
    {!! Form ::open(['action' => ['BooksController@search'], 'method' => 'GET']) !!}
        <div class="form-group">
            {{Form::label('search', 'Search')}}
            {{Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Book Name'])}}
        </div>
        {{Form::submit('Search', ['class' => 'btn btn-primary'])}}
    {!! Form :: close() !!}
    <br>
    @if(count($books)>= 1)
        @foreach ($books as $book)
        <div class="well">
            <div class="media">
                <div class="media-left">
                    <img style="width: 104px; height: 158px;" class="media-object" src="/storage/cover_images/{{$book->cover_image}}" alt="{{$book->name}}">
                </div>
                <div class="media-body">
                    <h3 class="media-title" id="book-title"><a href="/books/{{$book->id}}">{{$book->name}}</a></h3>
                    <div class="book-synopsis" style="max-height:70px; overflow-y:hidden; ">
                        {!!$book->synopsis!!}
                    </div>
                    <br>
                    <small>Add on {{$book->created_at}}</small>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <br>
        <p>No books found</p>
    @endif
@endsection