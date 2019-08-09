@extends('layouts.app')

@section('content')
    <h1>Books</h1>
    {!! Form ::open(['action' => 'BooksController@search', 'method' => 'GET']) !!}
        <div class="form-group">
            {{Form::label('search', 'Search')}}
            {{Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Book Name'])}}
        </div>
        {{Form::submit('Search', ['class' => 'btn btn-primary'])}}
    {!! Form :: close() !!}
    <br>

    <div class="row">
        @if(count($books) >= 1)
            @foreach ($books as $book)
                    <div class="col-xs-6 col-sm-3 col-md-2">
                        <div class="thumbnail">
                            <a href="/books/{{$book->id}}">
                                <img style="width: 150px; height: 225px;" src="/storage/cover_images/{{$book->cover_image}}" alt="{{$book->name}}">
                            </a>
                            <div class="caption" style="text-align:center;">
                                <h4 style="margin:0px; height:60px; overflow-y:hidden;"><a href="/books/{{$book->id}}">{{$book->name}}</a></h4>
                                <small class="author-name">{{$book->author}}</small>
                            </div>
                        </div>
                    </div>
            @endforeach
        @else
            <p>No books found</p>
        @endif
    </div>
    {{$books->links()}}
@endsection