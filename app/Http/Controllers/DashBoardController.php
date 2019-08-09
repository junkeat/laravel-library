<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Pending;
use App\Borrowed;
use App\Book;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('adminCheck', ['except' => ['index', 'update', 'changePassword', 'updatePassword', 'borrowedHistoryList']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $pending = Pending::where('user', '=', Auth::user()->email)->where('status', '=', 'Pending')->get();
        $borrowed = Borrowed::where('user', '=', Auth::user()->email)->where('status', '=', 'Borrowed')->get();
        return view('dashboard')->with([
            'user' => $user,
            'pending' => $pending,
            'borrowed' => $borrowed
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->save();

        return redirect('/dashboard')->with('success', 'Name Changed');
    }

    public function changePassword(){
        return view('changePassword');
    }

    public function updatePassword(Request $request){
        $this->validate($request, [
            'opassword' => 'required',
            'npassword' => 'required',
            'cpassword' => 'required'
        ]);

        $user = Auth::user();

        $currentPasswordHash = Auth::user()->password;

        if (Hash::check($request->input('opassword'), $currentPasswordHash)){
            if ($request->input('npassword') == $request->input('cpassword')){
                $user->password = bcrypt($request->input('npassword'));
                $user->save();
                return redirect('/dashboard/password')->with('success', 'Password Changed');
            } else {
                return redirect('/dashboard/password')->with('warning', 'Password confirmation failed');
            }
        } else {
            return redirect('/dashboard/password')->with('warning', 'Old Password is Wrong');
        }
    }

    public function pendingList(){
        $pending = Pending::where('status', '=', 'Pending')->orderBy('id', 'asc')->get();
        return view('pendingList')->with('pending', $pending);
    }

    public function insertToBorrowed(Request $request, $id){
        $pending = Pending::find($id);
        $borrowed = new Borrowed;

        $borrowed->name = $pending->name;
        $borrowed->user = $pending->user;
        $borrowed->status = "Borrowed";
        $borrowed->due_date = date("Y/m/d", strtotime("+7 day"));
        $borrowed->save();

        $pending->status = "Accepted";
        $pending->save();

        return redirect('/dashboard/pending-list')->with('success', 'Borrow request accepted');
    }

    public function rejectPending($id){
        $pending = Pending::find($id);
        $pending->status = "Rejected";
        $pending->save();
        return redirect('/dashboard/pending-list')->with('warning', 'Borrow request rejected.');
    }

    public function borrowedList(){
        $borrowed = Borrowed::orderBy('id', 'desc')->where('status', '=', 'Borrowed')->get();
        return view('borrowedList')->with('borrowed', $borrowed);
    }

    public function returnBook($id){
        $borrowed = Borrowed::find($id);
        $borrowed->status = "Returned";
        $borrowed->save();
        return redirect('/dashboard/borrowed-list')->with('success', 'Book returned.');
    }

    public function lostBook($id){
        $borrowed = Borrowed::find($id);
        $borrowed->status = "Lost";
        $borrowed->save();
        return redirect('/dashboard/borrowed-list')->with('warning', 'Book Lost.');
    }

    public function borrowedHistoryList(){
        $borrowed = Borrowed::where('user', '=', Auth::user()->email)->orderBy('id', 'desc')->get();
        return view('borrowedHistoryList')->with('borrowed', $borrowed);
    }

    public function receiptList(){
        $receipts = Borrowed::orderBy('id', 'desc')->where('status', '=', 'Returned')->orWhere('status', 'Lost')->get();
        return view('receiptList')->with('receipts', $receipts);
    }

    public function receipt($id){
        $receipt = Borrowed::find($id);
        $user = User::where("email", "=", $receipt->user)->get();
        $book = Book::where("name", "=", $receipt->name)->get();

        //Check borrowed days
        $borrowDate = $receipt->created_at;
        $returnDate = $receipt->updated_at;
        $days = $returnDate->diff($borrowDate)->format("%a");

        //Calculate overdue price and days;
        if($days > 7){
            $overdueDays = $days - 7;
            $overduePrice = $overdueDays * 5;
        } else {
            $overdueDays = 0;
            $overduePrice = 0;
        }

        if($receipt->status == "Lost"){
            $lostPrice = 100;
            $overduePrice = 0;
            $lostDescription = "Lost";
        } else {
            $lostPrice = 0;
            $lostDescription = "None";
        }

        $total = $overduePrice + $lostPrice;

        return view('receipt')->with([
            'receipt' => $receipt,
            'user' => $user,
            'book' => $book,
            'overdueDays' => $overdueDays,
            'overduePrice' => $overduePrice,
            'lostPrice' => $lostPrice,
            'lostDescription' => $lostDescription,
            'total' => $total
        ]);
    }
}
