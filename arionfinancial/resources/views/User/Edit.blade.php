@extends('layouts.Authorized')

@section('content')
@section('title', 'Update Details' )

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
                {!! Form::open(array('files'=>true, 'method' => 'POST', 'route' => array('EditUser'), 'class' => "form-horizontal form-label-left", 'id' => "ViewProfileForm")) !!}
                    {{ Form::hidden('UserID', $User["UserID"]) }}
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">UserName 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('UserName', $User["UserName"], array('class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                    </div>
                
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-Mail Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('EmailAddress', $User["EmailAddress"], array('class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('FirstName', $User["FirstName"], array('class' => 'form-control col-md-7 col-xs-12')) !!}
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Last Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('LastName', $User["LastName"], array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
