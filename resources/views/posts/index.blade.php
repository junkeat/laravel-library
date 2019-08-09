@extends('layouts.app')

@section('content')
    <h1>Notices</h1>
    @if(count($posts)>= 1)
        @foreach ($posts as $post)
            @if($post == $posts->first())
                <h4>Latest Notice</h4>
                <div class="jumbotron" style="padding: 36px 36px;">
                    <h2 style="margin-top: 0px;"><b>{{$post->title}}</b></h2>
                    <p style="font-size: 18px; max-height: 200px; overflow-y:hidden;">{!!$post->body!!}</p>
                    <a href="/posts/{{$post->id}}" class="btn btn-primary btn-lg">Details</a>
                    <br><br>
                    <small>Written on {{$post->created_at}}</small>
                </div>
            @else
                <div class="well">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}}</small>
                </div>
            @endif
        @endforeach
    @else
        <p>No notices found</p>
    @endif
@endsection