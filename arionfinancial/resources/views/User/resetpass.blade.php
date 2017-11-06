
@extends('layouts.app')

@section('content')
@section('title', "Reset")
    <div class="container" id="reset-password">
        
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {!! session()->get('success') !!}
                    </div>
                @endif
                
               <form id="login-form-wrap"  action="{{ url('reset') }}" method="post">

                    <h4>Forgot Password</h4>
                    <p>Please Enter your email to reset your password.</p>

                    @if(session()->has('errors'))
                        <div class="alert alert-danger">
                            {{ session()->get('errors') }}
                        </div>
                    @endif

                    <p class="form-row form-row-first">
                        <label for="username">Email Address<span class="required">*</span>
                        </label>
                        <input type="text" id="username" name="username" class="input-text" required="">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    </p>

                    <div class="clear"></div>
                    <p class="form-row wrap-sub-reset">
                        <input type="submit" value="Continue" name="reset" class="button">
                        <a href="/">Cancel</a>
                    </p>

                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
