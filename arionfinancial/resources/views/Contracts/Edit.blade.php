@extends('layouts.Authorized')

@section('content')
@section('title', "Update Contract")

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2>Update Contract for {!! $Contract->Customer->UserName !!}</h2>
              <div class="clearfix"></div>
              <a href="{!! route('Contracts', ['CustomerID' => $Contract->CustomerID]) !!}"><button class='btn btn-primary'>Back to Contracts</button></a>
            </div>
            <div class="x_content">
                <br />
                
                {!! Form::open(array('files'=>true, 'method' => 'POST', 'route' => array('EditContract'), 'class' => "form-horizontal form-label-left", 'id' => "ViewProfileForm")) !!}
                    {{ Form::hidden('CustomerID', $Contract->CustomerID) }}
                    {{ Form::hidden('ContractID', $Contract->ContractID) }}
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Name', $Contract->Name, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('Name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('Name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('Address', $Contract->Address, array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
                            {!! Form::text('FinanceAmount', $Contract->FinanceAmount, array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
                            {!! Form::text('TimeFrame', $Contract->TimeFrame, array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
                            {!! Form::text('APR', $Contract->APR, array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
                            {!! Form::text('LateFees', $Contract->LateFees, array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
                            {!! Form::text('DateofContract', $Contract->DateofContract, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' =>  'Please enter date in format: YYYY-MM-DD')) !!}
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
                            {!! Form::text('MonthlyPayment', $Contract->MonthlyPayment, array('class' => 'form-control col-md-7 col-xs-12')) !!}
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
                            {!! Form::text('PaymentDueDate', $Contract->PaymentDueDate, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' =>  'Please enter date in format: YYYY-MM-DD')) !!}
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
