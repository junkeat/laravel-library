@extends('layouts.app')

@section('content')
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="/posts" class="btn btn-default" style="float: right;">Go Back</a>
            <h1>{{$post->title}}</h1>
        </div>
        <div class="panel-body">
            <div>
                {!!$post->body!!}
            </div>
            <hr>
            <small>Written on {{$post->created_at}}</small>
            <br><br>
        
            @if (!Auth::guest())
                @if (Auth::user()->authority == 1)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                @endif
            @endif
        </div>
    </div>
@endsection