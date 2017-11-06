@extends('layouts.Authorized')
@section('title', "Leasing")
@section('content')
    {!! Form::open(array(
        'method' => 'POST', 
        'route' => array('contract-infor'), 
        'class' => "form-horizontal row dcmt",
        'id' => 'contract-form'))
    !!}
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label " for="test">Cash Price of Property
                    </label>
                    <div>
                        {!! Form::text('cash_price', null, array('class' => 'form-control', 'placeholder' => '$')) !!}
                        @if ($errors->has('cash_price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cash_price') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label " for="test">Description of Property
                    </label>
                    <div>
                        {!! Form::text('description', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label " for="test">Cost of Rental
                    </label>
                    <div>
                        {!! Form::text('cost_rental', null, array('class' => 'form-control', 'placeholder' => '')) !!}
                        @if ($errors->has('cost_rental'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cost_rental') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label " for="test">Customer name
                    </label>
                    <div>
                        {!! Form::select('customer', $customerName, null, ['class' => 'form-control']); !!}
                        @if ($errors->has('customer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('customer') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <div class="row clearfix">
                    <div class="col-xs-9">
                        <div class="form-group">
                            <label class="control-label " for="test">First Name
                            </label>
                            <div>
                                {!! Form::text('fname', null, array('class' => 'form-control')) !!}
                                @if ($errors->has('fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label class="control-label " for="test">Middle
                            </label>
                            <div>
                                {!! Form::text('mname', null, array('class' => 'form-control')) !!}
                                @if ($errors->has('mname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                


                <div class="form-group">
                    <label class="control-label " for="test">Mailling Address
                    </label>
                    <div>
                        {!! Form::text('mailling', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('mailling'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mailling') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Primary Phone Number
                    </label>
                    <div>
                        {!! Form::text('p_phone', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('p_phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('p_phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Email Address
                    </label>
                    <div>
                        {!! Form::text('email', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Number of payments
                    </label>
                    <div>
                        <?php $numpay = []; for($key = 1; $key <= 60; $key ++){ $numpay[$key] = $key; }   ?>
                        {!! Form::select('num_pay', $numpay, null, array('class' => 'form-control')) !!}
                        @if ($errors->has('num_pay'))
                            <span class="help-block">
                                <strong>{{ $errors->first('num_pay') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Date of Birth MM/DD/YYYY
                    </label>
                    <div>
                        {!! Form::text('birthday', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('birthday'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">First payment date MM/DD/YYYY
                    </label>
                    <div>
                        {!! Form::text('fpay', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('fpay'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fpay') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label " for="test">Tax rate(%)
                    </label>
                    <div>
                        {!! Form::text('tax_rate', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('tax_rate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tax_rate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label " for="test">Last Name
                    </label>
                    <div>
                        {!! Form::text('lname', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('lname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label " for="test">Apt #
                            </label>
                            <div>
                                {!! Form::text('apt', null, array('class' => 'form-control')) !!}
                                @if ($errors->has('apt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label class="control-label " for="test">Zip Code
                            </label>
                            <div>
                                {!! Form::text('zipcode', null, array('class' => 'form-control')) !!}
                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label " for="test">Additional Phone Number
                    </label>
                    <div>
                        {!! Form::text('add_phone', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('add_phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('add_phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Confirm Email Address
                    </label>
                    <div>
                        {!! Form::text('confirm_email', null, array('class' => 'form-control')) !!}
                        @if ($errors->has('confirm_email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirm_email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Select terms of payment
                    </label>
                    <div>
                        <?php $termOfPay = ['weekly' => 'Weekly', 'bi-weekly' => 'Bi-weekly', 'monthly' => 'Monthly'];  ?>
                        {!! Form::select('term_of_pay', $termOfPay, null, array('class' => 'form-control')) !!}
                        @if ($errors->has('term_of_pay'))
                            <span class="help-block">
                                <strong>{{ $errors->first('term_of_pay') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label " for="test">Recurring payment amount
                    </label>
                    <div>
                        {!! Form::text('payment_amount', null, array('class' => 'form-control', 'placeholder' => '$')) !!}
                        @if ($errors->has('payment_amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment_amount') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label " for="test">Initial payment
                    </label>
                    <div>
                        {!! Form::text('init_payment', null, array('class' => 'form-control', 'placeholder' => '$')) !!}
                        @if ($errors->has('init_payment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('init_payment') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <input id="btnSave" type="hidden" name='save' value="Save" />
                <input type="submit" class="btn btn-success" value="Save" name="sub" onclick="saveFunction('Save');"/>
                <input class="btn btn-primary" type="submit" value="Print" name="sub" onclick="saveFunction('Print');"/>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
@section('internalScript')
    <script type="text/javascript">
        $(document).ready(function(){
            var formSubmit = false;
            $('input[name="birthday"], input[name="fpay"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
            });
        });
        var saveFunction = function(type) {
            $('#btnSave').val(type);
            $('input[name="sub"]').prop('disabled', true);
            $('#contract-form').submit();
        }
    </script>
@endsection