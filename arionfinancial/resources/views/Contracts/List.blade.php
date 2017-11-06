@extends('layouts.Authorized')

@section('content')
@section('title', "My Contracts")

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Contracts with Customer: {!! $Customer->UserName !!}</h2>
            <div class="clearfix"></div>
            @if(Session::get('RoleID') == 2)
            <a href="{!! route('addleasing', ['CustomerID' => $Customer->UserID]) !!}"><button class='btn btn-primary'>Add a Contract</button></a>
            <a href="{!! route('Users') !!}"><button class='btn btn-primary'>Back to Users</button></a>
            @endif
        </div>
        <div class="x_content">
          
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Finance Amount</th>
                        <th>Date of Contract</th>
                        <th>Recurring Payment</th>
                        <th>Time Frame</th>
                        <th>APR</th>
                        <th>Edit</th>
                        <th>Ledger</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($Contracts as $Contract)
                        <tr>
                            <td>{!! $Contract->Name !!}</td>
                            <td>{!! $Contract->type !!}</td>
                            <td>{!! $Contract->FinanceAmount !!}</td>
                            <td>{!! (new Datetime($Contract->DateofContract))->format('M j, Y') !!}</td>
                            <td>{!! $Contract->MonthlyPayment !!}</td>
                            <td>{!! $Contract->TimeFrame !!}</td>
                            <td>{!! $Contract->APR !!}</td>
                            <td><a href="{!! URL('Contract', ['ContractID' => $Contract->ContractID]) !!}">Edit</a></td>
                            <td><a href="{!! route('Payments', ['ContractID' => $Contract->ContractID]) !!}">View Ledger</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection