@extends('layouts.app')

@section('content')
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="/books" class="btn btn-default" style="float: right;">Go Back</a>
            <h1>{{$book->name}}</h1>
        </div>
        <div class="panel-body">
            <img style="max-width:100%;" src="/storage/cover_images/{{$book->cover_image}}" alt="{{$book->name}}">
            <br><br>
            <div>
                {!!$book->synopsis!!}
            </div>
            <br>
            @if (Auth::check())
                {!!Form::open(['action' => ['BooksController@requestBorrow', $book->id], 'method' => 'POST'])!!}
                    {{Form::submit('Request Borrow', ['class' => 'btn btn-primary'])}}
                {!!Form::close()!!}
            @endif
            <hr>
            <small>Added on {{$book->created_at}}</small>
            <br><br>
            @if (Auth::check())
                @if (Auth::user()->authority == 1)
                <a href="/books/{{$book->id}}/edit" class="btn btn-default">Edit</a>
                {!!Form::open(['action' => ['BooksController@destroy', $book->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
                @endif
            @endif
        </div>
    </div>
@endsection