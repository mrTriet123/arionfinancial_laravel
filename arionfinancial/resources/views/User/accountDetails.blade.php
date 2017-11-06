@extends('layouts.Authorized')

@section('content')
@section('title', "Financial")
<div>
  <h1>Account Details</h1>
</div>
<div>
  <p>The activity displayed may not match your billing statements and may not reflect recent transactions</p>
</div>
<div class="row">
  <div><p><b>Account Information</b></p></div>
  <hr>
  <div class="col-md-6">
    <p>Purchase Amount</p>
    <p>Total Fees Charged YTD</p>
    <p>Total Interest Charged YTD</p>
    <p>Next Statement Date</p>
  </div>
  <div class="col-md-6">
    <p>$</p>
    <p>$</p>
    <p>$</p>
    <p>$</p>
  </div>
</div>
<div class="row">
  <div><p><b>Payments</b></p></div>
  <hr>
  <div class="col-md-6">
    <p>Last Payment Date</p>
    <p>Last Payment Due Date</p>
    <p>Next Payment Due Date</p>
    <p>Total Minimum Payment Due</p>
  </div>
  <div class="col-md-6">
    <p>$</p>
    <p>$</p>
    <p>$</p>
    <p>$</p>
  </div>
</div>
@endsection