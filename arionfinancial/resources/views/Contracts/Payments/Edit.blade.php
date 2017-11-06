@extends('layouts.Authorized')

@section('content')
@section('title', "Update Contract")

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2>Update Payment for {!! $Payment->Contract->Customer->UserName !!}</h2>
              <div class="clearfix"></div>
              <a href="{!! route('Payments', ['CustomerID' => $Payment->Contract->ContractID]) !!}"><button class='btn btn-primary'>Back to Payments</button></a>
            </div>
            <div class="x_content">
                <br />
                {!! Form::open(array('files'=>true, 'method' => 'POST', 'route' => array('EditPayment'), 'class' => "form-horizontal form-label-left", 'id' => "ViewProfileForm")) !!}
                    {{ Form::hidden('PaymentID', $Payment->PaymentID) }}
                    {{ Form::hidden('ContractID', $Payment->Contract->ContractID) }}
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Source
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="PaymentSourceID">
                                @foreach($PaymentSources as $PaymentSource)
                                    @if($Payment->PaymentSourceID == $PaymentSource->PaymentSourceID)
                                        <option select value="{!! $PaymentSource->PaymentSourceID !!}">{!! $PaymentSource->PaymentSource !!}</option>
                                    @else
                                        <option value="{!! $PaymentSource->PaymentSourceID !!}">{!! $PaymentSource->PaymentSource !!}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Amount 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('PaymentAmount', $Payment->PaymentAmount, array('class' => 'form-control col-md-7 col-xs-12')) !!}
                            @if ($errors->has('PaymentAmount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('PaymentAmount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date of Payment
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::text('PaymentDate', $Payment->PaymentDate, array('class' => 'form-control col-md-7 col-xs-12', 'placeholder' =>  'Please enter date in format: YYYY-MM-DD')) !!}
                            @if ($errors->has('PaymentDate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('PaymentDate') }}</strong>
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
