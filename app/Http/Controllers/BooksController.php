<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Pending;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use DB;

class BooksController extends Controller
{
    public function __construct(){
        $this->middleware('adminCheck', ['except' => ['index', 'show', 'search','getAPI']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(12);
        return view('books.index')->with('books', $books);
    }

    public function getAPI()
    {
        $books = Book::orderBy('id', 'desc')->paginate(12);
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle image upload
        if ($request->hasFile('cover_image')) {
           //Get image file name
           $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
           //Get file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
           //Get ext name
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.jpg';
        }

        //Insert to table
        $book = new Book;
        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->synopsis = $request->input('synopsis');
        $book->cover_image = $fileNameToStore;
        $book->save();

        return redirect('/books')->with('success', 'Book Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if (($request->hasFile('cover_image')) && ($book->cover_image != "no_image.jpg")){
            //Delete old image
            Storage::delete('public/cover_images/' . $book->cover_image);
            //Get image file name
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get extension name
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Save image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = $book->cover_image;
        }

        $book->name = $request->input('name');
        $book->author = $request->input('author');
        $book->synopsis = $request->input('synopsis');
        $book->cover_image = $fileNameToStore;
        $book->save();

        return redirect('/books')->with('success', 'Book Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book->cover_image == "no_image.jpg"){
            $book->delete();
        } else {
            Storage::delete('public/cover_images/' . $book->cover_image);
            $book->delete();
        }
        return redirect('/books')->with('success', 'Book Removed');
    }

    public function search(Request $request){
        $searchInput = $request->input('search');
        $books = Book::orderBy('name', 'asc')->where('name', 'like', "%{$searchInput}%")->get();
        return view('books.search')->with('books', $books);
    }

    public function requestBorrow(Request $request, $id){
        $book = Book::find($id);

        //Check if data already exists
        $checking = Pending::where('name', '=', $book->name)->where('user', '=', Auth::user()->email)->where('status', '=', 'Pending')->count();
        if ($checking == 0){
            $pending = new Pending;
            $pending->name = $book->name;
            $pending->user = Auth::user()->email;
            $pending->status = "Pending";
            $pending->save();
        } else {
            return redirect("/books/{$book->id}")->with('error', 'Already Requested for Borrow.');
        }
        return redirect("/books/{$book->id}")->with('success', 'Successfully Requested for Borrow.');
    }
}
