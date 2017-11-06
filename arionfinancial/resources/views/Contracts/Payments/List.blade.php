@extends('layouts.Authorized')

@section('content')
@section('title', "Payments")

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
              @if(Session::get('RoleID') == 2)
            <a href="{!! route('AddPayment', ['ContractID' => $Contract->ContractID]) !!}"><button class='btn btn-primary'>Add Payment</button></a>
            <a href="{!! route('Contracts', ['ContractID' => $Contract->CustomerID]) !!}"><button class='btn btn-primary'>Back to Contracts</button></a>
            @endif
<!--             <a href="{!! route('DownloadContract', ['ContractID' => $Contract->ContractID]) !!}"><button class='btn btn-primary'>Download Ledger</button></a>
            <a href="{!! route('EmailContract', ['ContractID' => $Contract->ContractID]) !!}"><button class='btn btn-primary'>Email Ledger</button></a> -->
            <div class="clearfix"></div>
            <h2>Total amount received in this contract: $<b>{!! $Payments->sum('PaymentAmount') !!}</b></h2>
            <div class="clearfix"></div>
            <h2>Payments history from the Customer: {!! $Customer->UserName !!}</h2>
            <div class="clearfix"></div>
            DPR(365/{!! $Contract->APR !!}): <b>{!! $Formula['DPR'] !!}</b>
            <div class="clearfix"></div>
            Total Amount(Finance Amount): $<b>{!! $Contract->FinanceAmount !!}</b>
            <div class="clearfix"></div>
            Balance = Financial Amount - Sum of amount paid. {!!$Contract->FinanceAmount !!} - {!! $Payments->sum('PaymentAmount') !!} = {!! $Contract->FinanceAmount - $Payments->sum('PaymentAmount') !!}
                <div class="clearfix"></div>
            Interest = Balance(total - sum of amount paid) * DPR * Days of Month <b>{!! $Contract->FinanceAmount - $Payments->sum('PaymentAmount') !!}  * {!! $Formula['DPR'] !!} * {!! date('t') !!} = {!! $Contract->FinanceAmount - $Payments->sum('PaymentAmount') * date('t') !!}</b>
            <div class="clearfix"></div>
            Amount due = Financial Amount({!! $Contract->FinanceAmount !!}) - (sum of payments)({!! $Payments->sum('PaymentAmount') !!}) + interest({!! $Contract->FinanceAmount - $Payments->sum('PaymentAmount') * date('t') !!}).
            <div class="clearfix"></div>
        </div>
        <div class="x_content" id = "data">
          
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Payment Amount</th>
                        <th>Date of Payment</th>
                        <th>Payment Source</th>
                         @if(Session::get('RoleID') == 2)
                        <th>Edit</th>
                        <th>Delete</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @foreach($Payments as $Payment)
                        <tr>
                            <td>{!! $Payment->PaymentAmount !!}</td>
                            <td>{!! $Payment->PaymentDate !!}</td>
                            <td>{!! $Payment->PaymentSource != null ? $Payment->PaymentSource->PaymentSource: '-' !!}</td>
                            @if(Session::get('RoleID') == 2)
                            <td><a href="{!! URL('Payment', ['PaymentID' => $Payment->PaymentID]) !!}">Edit</a></td>
                            @endif
                            @if(Session::get('RoleID') == 2)
                            <td>
                                {{ Form::open(['route' => ['deletePayments',  $Payment->PaymentID], 'method' => 'delete']) }}
                                <button type="submit" class='btn btn-link' style="padding: 0px; text-decoration: none; color: #23527c;">Delete</button>
                                {{ Form::close() }}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection