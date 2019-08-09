@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if (Auth::user()->authority == 1)
                        <h3>Admin Dashboard</h3>
                    @else
                        <h3>User Dashboard</h3>
                    @endif
                </div>

                <div class="panel-body">

                    @if (Auth::user()->authority == 1)
                        <a href="/posts/create" class="btn btn-success">Create Notice</a>
                        <a href="/books/create" class="btn btn-success">Add Book</a>
                        <a href="/dashboard/pending-list" class="btn btn-success">Pending Requests</a>
                        <a href="/dashboard/borrowed-list" class="btn btn-success">Borrowed Books</a>
                        <a href="/dashboard/receipt-list" class="btn btn-success">Receipts</a>
                        <br><br>
                    @endif 

                    <a href="/dashboard/password" class="btn btn-primary">Change Password</a>
                    <a href="/dashboard/borrowed-history-list" class="btn btn-primary">My Borrowed History</a>

                    <hr>
                    <h4>Change Name</h4>
                    {!! Form::open(['action' => ['DashBoardController@update', $user->id], 'method' => 'POST', ]) !!}
                        <div class="form-group">
                            {{Form::label('name', 'Name')}}
                            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
                        </div>
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Change', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}

                    <hr>
                    <h4>Pending Borrow Requests</h4>
                    @if (count($pending) >= 1)
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>Status</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending as $row)
                                    <tr>
                                        <th scope="row">{{$row->id}}</th>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->status}}</td>
                                        <td>{{$row->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No pending requests found</p>
                    @endif

                    <hr>
                    <h4>Borrowed Books</h4>
                    @if (count($borrowed) >= 1)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowed as $row)
                                    <tr>
                                        <th scope="row">{{$row->id}}</th>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->status}}</td>
                                        <td>{{$row->due_date}}</td>
                                        <td>{{$row->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No borrowed books found</p>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
