@extends('layouts.app')

@section('content')
    <div class="col-md-10 col-md-offset-1">
        <br>
        <h3>Book Receipt</h3>
        <h4>Receipt #{{$receipt->id}}</h4>
        <div class="col-md-6" style="padding: 0px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>To:</b> {{$user[0]->name}}
                </div>
                <div class="panel-body">
                    <p><b>Email: </b>{{$receipt->user}}</p>
                    <p><b>Book Name: </b><a href="/books/{{$book[0]->id}}" target="_blank">{{$receipt->name}}</a></p>
                    <p><b>Book Status: </b>{{$receipt->status}}</p>
                    <p><b>Borrow Date: </b>{{$receipt->created_at}}</p>
                    <p><b>Return Date: </b>{{$receipt->updated_at}}</p>
                </div>
            </div>
        </div>
        <table class="table" id="receipt-table">
            <col width="75%">
            <col width="15%">
            <col width="10%">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Book Loan Overdue</th>
                    <td>{{$overdueDays}} Days</td>
                    <td>RM{{number_format($overduePrice, 2)}}</td>
                </tr>
                <tr>
                    <th>Book Lost</th>
                    <td>{{$lostDescription}}</td>
                    <td>RM{{number_format($lostPrice, 2)}}</td>
                </tr>
            </tbody>
        </table>
        <div class="total-info">
            <table>
                <tr>
                    <td><b>Sub Total: </b></td>
                    <td>RM{{number_format($total, 2)}}</td>
                </tr>
                <tr>
                    <td><b>TAX: </b></td>
                    <td style="text-align: left;">N/A</td>
                </tr>
                <tr>
                    <td><b>Total: </b></td>
                    <td>RM{{number_format($total, 2)}}</td>
                </tr>
            </table>
        </div>

        <div style="clear: both;"></div>
        <br><br>
        <a href="/dashboard/receipt-list" class="btn btn-default" id="back-link">Go Back</a>
        <button onclick="printing()" class="btn btn-primary" style="float: right;" id="print-button">Print/Save</button>
    </div>

    <script>
        function printing(){
            window.print();
        }
    </script>
@endsection