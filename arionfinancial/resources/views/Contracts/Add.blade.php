@extends('layouts.Authorized')

@section('content')
@section('title', "Create Account")




<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <?php
            $count = count($errors->all());
            if($count > 0)
            {
                echo '<div class="alert alert-danger">';
                foreach ($errors->all() as $value) 
                {
                    echo $value."<br>";
                }
                echo '</div>';
            } 
        ?>
        <div class="x_panel">
            <div class="x_title">
              <h2><?php if($contractType === 'leasing') echo 'Leasing'; else echo 'Financing'; ?></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                {!! Form::open(array('method' => 'POST', 'route' => array('SaveContract'), 'class' => "form-horizontal form-label-left")) !!}
                    <input type="hidden" name="type" value="{{$contractType}}">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Name', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Customer 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="CustomerID" class="form-control">
                           <option value="">Select a Customer</option>
                               @foreach($customers as $customer)
                                  <option value="{{ $customer->UserID }}">{{ $customer->UserName }}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Address', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Finance Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('FinanceAmount', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('FinanceAmount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('FinanceAmount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TimeFrame
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('TimeFrame', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('TimeFrame'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('TimeFrame') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">APR
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('APR', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('APR'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('APR') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Late Fees
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('LateFees', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('LateFees'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('LateFees') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date of Contract
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::date('DateofContract', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' =>  'Please enter date in format: YYYY-MM-DD')) !!}
                            @if ($errors->has('DateofContract'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('DateofContract') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Monthly Payment
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('MonthlyPayment', null, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('MonthlyPayment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('MonthlyPayment') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Due Date
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::date('PaymentDueDate', null, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' =>  'Please enter date in format: YYYY-MM-DD')) !!}
                            @if ($errors->has('PaymentDueDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('PaymentDueDate') }}</strong>
                                </span>
                            @endif
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
