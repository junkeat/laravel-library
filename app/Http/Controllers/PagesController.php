<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Book;

class PagesController extends Controller
{
    public function index(){
        $books = Book::orderBy('created_at', 'desc')->paginate(6);
        return view('pages.index')->with('books', $books);
    }

    public function about(){
        return view('pages.about');
    }

    public function contact(){
        return view('pages.contact');
    }
}
