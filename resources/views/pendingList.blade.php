@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Pending Borrow Requests</h3>
                </div>

                <div class="panel-body">
                     <div class="form-group">
                        <label for="search">Search User Email</label>
                        <input type="text" class="form-control" placeholder="Email" id="searchInput">
                    </div>

                    @if (count($pending) >= 1)
                        <table class="table" id="pendingTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>User Email</th>
                                    <th>Status</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending as $row)
                                    <tr id="filter">
                                        <th scope="row">{{$row->id}}</th>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->user}}</td>
                                        <td>{{$row->status}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>
                                            {!! Form::open(['action' => ['DashBoardController@insertToBorrowed', $row->id], 'method' => 'POST']) !!}
                                                {{Form::submit('Accept', ['class' => 'btn btn-primary'])}}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['action' => ['DashBoardController@rejectPending', $row->id], 'method' => 'POST']) !!}
                                                {{Form::hidden('_method', 'PUT')}}
                                                {{Form::submit('Reject', ['class' => 'btn btn-primary'])}}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No pending requests found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JQuery search filter -->
<script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#pendingTable #filter").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection
