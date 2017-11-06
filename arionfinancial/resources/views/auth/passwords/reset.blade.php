@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('EmailAddress') ? ' has-error' : '' }}">
                            <label for="EmailAddress" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="EmailAddress" type="EmailAddress" class="form-control" name="EmailAddress" value="{{ $EmailAddress or old('EmailAddress') }}" required autofocus>

                                @if ($errors->has('EmailAddress'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('EmailAddress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Password') ? ' has-error' : '' }}">
                            <label for="Password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="Password" class="form-control" name="Password" required>

                                @if ($errors->has('Password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="Password_confirmation" required>

                                @if ($errors->has('Password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
