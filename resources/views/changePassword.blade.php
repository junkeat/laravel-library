@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Change Password</h4>
                </div>

                <div class="panel-body">               
                    <a href="/dashboard" class="btn btn-default">Go Back</a>
                    <br><br>
                    {!! Form::open(['action' => ['DashBoardController@updatePassword'], 'method' => 'POST']) !!}
                    <div class="form-group">
                            {{Form::label('opassword', 'Old Password')}}
                            {{Form::text('opassword', '', ['class' => 'form-control', 'placeholder' => 'Old Password', 'required' => 'required'])}}
                        </div>
                    <div class="form-group">
                        {{Form::label('npassword', 'New Password')}}
                        {{Form::text('npassword', '', ['class' => 'form-control', 'placeholder' => 'New Password', 'required' => 'required'])}}
                    </div>
                    <div class="form-group">
                            {{Form::label('cpassword', 'Confirm Password')}}
                            {{Form::text('cpassword', '', ['class' => 'form-control', 'placeholder' => 'Confirm New Password', 'required' => 'required'])}}
                        </div>
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::submit('Change', ['class' => 'btn btn-primary'])}}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection