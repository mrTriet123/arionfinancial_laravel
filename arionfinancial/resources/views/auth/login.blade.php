@extends('layouts.app')

@section('content')
@section('title', "Login")


<div class="container">

@if(session()->has('login'))
    <div class="alert alert-success">
        {!! session()->get('login') !!}
    </div>
@endif


 @if(session()->has('errors'))
    <div class="alert alert-danger">
        {!! session()->get('errors') !!}
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {!! session()->get('success') !!}
    </div>
@endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    @if ( session()->has('UpdateProfile') )
                        <div class="alert alert-success alert-dismissable">{{ session()->get('UpdateProfile') }}</div>
                    @endif
                    {!! Form::open(array('method' => 'POST', 'action' => array('Account\ProfileController@postlogin'), 'class' => "form-horizontal form-label-left")) !!}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="EmailAddress" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                {!! Form::text('EmailAddress', null, array('class' => 'form-control', 'required' => "required", 'placeholder' => "UserName or Email Address")) !!}
    
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <label for="Password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                {!! Form::password('Password',
                                array('class' => 'form-control', 'required' => "required", 
                                            'placeholder' => "Password please")) !!}
                
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a href="{!! URL('/reset') !!}">
                                    <button type="button" class="btn btn-primary">
                                        Forgot Password
                                    </button>
                                </a>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
