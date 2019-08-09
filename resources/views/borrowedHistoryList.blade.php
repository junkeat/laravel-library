@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Borrowed Books List</h3>
                </div>

                <div class="panel-body">
                    <div class="form-group">
                        <label for="search">Search User Email</label>
                        <input type="text" class="form-control" placeholder="Email" id="searchInput">
                    </div>

                    @if (count($borrowed) >= 1)
                        <table class="table" id="borrowedTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Book Name</th>
                                    <th>User Email</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Borrow DateTime</th>
                                </tr>
                            </thead>    
                            <tbody>
                                @foreach ($borrowed as $row)
                                    <tr id="filter">
                                        <th scope="row">{{$row->id}}</th>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->user}}</td>
                                        <td>{{$row->due_date}}</td>
                                        <td>{{$row->status}}</td>
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

<!-- JQuery search filter -->
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#borrowedTable #filter").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

@endsection
