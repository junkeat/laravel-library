@extends('layouts.app')

@section('home')
    <div class="image-container">
        <div class="home-title">
            <div class="animate infinite pulse">
                <h1>Welcome to library</h1>
                <p>Lorem ipsum dolor sit amet.</p>
            </div>
        </div>
    </div>
    <section class="book-section">
        <div class="container">
            <div class="row">
                <h3>Search</h3>
                {!! Form ::open(['action' => ['BooksController@search'], 'method' => 'GET']) !!}
                <div class="input-group">
                    {{Form::text('search', '', ['class' => 'form-control', 'placeholder' => 'Book Name'])}}
                    <span class="input-group-btn">
                        {{Form::submit('Search', ['class' => 'btn btn-primary'])}}
                        {!! Form :: close() !!}   
                    </span>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <h3>Latest Books</h3>
            <div class="books">
                @if(count($books) >= 1)
                    @foreach ($books as $book)
                        <div class="col-xs-6 col-sm-4 col-md-2">
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
        </div>
    </section>

    <section class="about-section" id="about">
        <div class="about-container">
            <h2>About</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere consectetur, quisquam dolorem eos quas 
                perferendis, optio reiciendis dolores deserunt rerum consequatur velit quos illo eveniet beatae ipsam, 
                suscipit voluptatum ut!
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, soluta dolor quos quam perferendis 
                et nisi obcaecati eaque autem dolorem ullam ea eum qui eligendi adipisci sit similique quae at.
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, soluta dolor quos quam perferendis.
            </p>
        </div>
    </section>

    <section class="built-section">
        <h2>Developed with</h2>
        <div class="built-container">
            <img src="../images/laravel.png" alt="laravel">
            <img src="../images/bootstrap.png" alt="bootstrap">
            <img src="../images/html.png" alt="html">
            <img src="../images/css.png" alt="css">
            <img src="../images/javascript.png" alt="javacript">
        </div>
    </section>

    <div class="copyright-container">
        <h2>Copyright © 2019 FYP</h2>
        <small>Privacy - Terms & Conditions</small>
        <a href="/#top"><img src="../images/arrowup.png" class="up-link"></a>
    </div>
@endsection