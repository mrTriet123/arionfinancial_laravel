@extends('layouts.Authorized')

@section('content')
@section('title', "Profile")

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2>Update Profile</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                {!! Form::open(array('files'=>true, 'method' => 'POST', 'route' => array('UpdateProfile'), 'class' => "form-horizontal form-label-left", 'id' => "ViewProfileForm")) !!}
<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">UserName 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('UserName', $User->UserName, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                    </div>
                
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-Mail Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('EmailAddress', $User->EmailAddress, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('EmailAddress'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('EmailAddress') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CompanyName">Company Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('CompanyName', $User->CompanyName, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('CompanyName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('CompanyName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('FirstName', $User->FirstName, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('FirstName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('FirstName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('LastName', $User->LastName, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('LastName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('LastName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Address">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Address', $User->Address, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="City">City 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('City', $User->City, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('City'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('City') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="State">State 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('State', $User->State, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('State'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('State') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Zip">Zip 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Zip', $User->Zip, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Zip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Zip') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Fax">Fax 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Fax', $User->Fax, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Fax'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Fax') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Phone">Phone 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Phone', $User->Phone, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Password" class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" type="password" class="form-control" name="Password">

                            @if ($errors->has('Password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password-confirm" type="password" class="form-control" name="Password_confirmation">
                            @if ($errors->has('Password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profile Picture 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="file" name="profile" class="form-control">
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
