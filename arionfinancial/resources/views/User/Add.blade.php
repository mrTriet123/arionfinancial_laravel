@extends('layouts.Authorized')

@section('content')
@section('title', 'Add')

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2> <?php 
          if($RoleID == 1)
          { 
            echo 'My Dealers'; 
          }
          elseif($RoleID  == 2)
          { 
            echo 'My Customer'; 
          } 
          ?></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                {!! Form::open(array('files'=>true, 'method' => 'POST', 'route' => array('SaveUser'), 'class' => "form-horizontal form-label-left", 'id' => "ViewProfileForm")) !!}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">UserName 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('UserName', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('UserName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('UserName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-Mail Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('EmailAddress', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('EmailAddress'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('EmailAddress') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::password('Password', array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirm Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::password('Password_confirmation', array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Phone">Account # 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Phone',null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('account'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('acount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('FirstName', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('LastName', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button class="btn btn-primary" type="reset">Reset</button>                            
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
