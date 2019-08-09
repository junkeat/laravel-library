<?php

use App\Events\MessagePosted;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/about', 'PagesController@about');

Route::get('/contact', 'PagesController@contact');

Route::get('/books/search', 'BooksController@search');

Route::get('/dashboard/password', 'DashBoardController@changePassword');

Route::get('/dashboard/pending-list', 'DashBoardController@pendingList');

Route::get('/dashboard/borrowed-list', 'DashBoardController@borrowedList');

Route::get('/dashboard/borrowed-history-list', 'DashBoardController@borrowedHistoryList');

Route::get('/dashboard/receipt-list', 'DashBoardController@receiptList');

Route::get('/dashboard/receipt/{receipt}', 'DashBoardController@receipt');

Route::put('/dashboard/password', 'DashBoardController@updatePassword');

Route::put('dashboard/pending-list/{pending}', 'DashBoardController@rejectPending');

Route::put('dashboard/borrowed-list/return/{borrowed}', 'DashBoardController@returnBook');

Route::put('dashboard/borrowed-list/lost/{borrowed}', 'DashBoardController@lostBook');

Route::post('/books/{book}/request', 'BooksController@requestBorrow');

Route::post('/dashboard/pending-list/{pending}', 'DashBoardController@insertToBorrowed');

Route::resource('/posts', 'PostsController');

Route::resource('/books', 'BooksController');

Route::resource('/dashboard', 'DashBoardController');

//Live chat
Route::get('/chat', function(){
    return view('chat');
})->middleware('auth');

Route::get('/messages', function(){
    return App\Message::with('user')->get();
})->middleware('auth');

Route::post('/messages', function(){
    //Store new messages
    $user = Auth::user();
    $message = request()->get('message');

    $message = $user->messages()->create([
        'message' => $message
    ]);

    //Announce that a new message has been posted
    broadcast(new MessagePosted($message, $user))->toOthers();

    return ['status' => 'OK'];
})->middleware('auth');