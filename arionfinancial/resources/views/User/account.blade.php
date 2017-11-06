@extends('layouts.Authorized')

@section('content')
@section('title', "Statement Detail")

@if(isset($check))
<div class="clearfix" style="display: inline-block; width: 100%;">
  <h5>Select a Contract to Open Current Accounts</h5>
  <div style="display:flex;">
  <strong style="line-height: 34px; margin-right: 10px;">Currently Viewing</strong>
    <form action="{{ url('Account') }}" method="POST" style="display: flex;">
        <div style="width: 200px;">
            <select class="form-control" name="contract">
            <option value = "all">Select a Contract</option>  
                  @foreach($contracts as $contractv)
                    <?php
                    if(isset($Detail))
                    {
                      if($contractv->ContractID == $Detail->ContractID)
                      {
                        $select = "selected";
                      }
                      else
                      {
                        $select = "";
                      }
                    }
                    else
                    {
                      $select = "";
                    }
              $date1 = $contractv->DateofContract;
              $date2 = date('Y-m-d');

              $ts1 = strtotime($date1);
              $ts2 = strtotime($date2);

              $year1 = date('Y', $ts1);
              $year2 = date('Y', $ts2);

              $month1 = date('m', $ts1);
              $month2 = date('m', $ts2);

              $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
              ?>
            <option {{ $select }} value="{{ $contractv->ContractID }}-{{ $diff }}">{{ $contractv->Name }}</option>
              @endforeach
            </select>  
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
        </div>
      <input type="submit" name="filter" value="Filter" class="btn btn-primary" style="margin-left: 20px;">
    </form>
  </div>
  <hr>
</div>
@else
<div class="clearfix" style="display: inline-block; width: 100%;">
  <h5>Select a Contract to Open Current Accounts</h5>
  <div style="display:flex;">
  <strong style="line-height: 34px; margin-right: 10px;">Currently Viewing</strong>
  <div style="width: 200px;">
    <form action="{{ url('Account') }}" method="POST">
            <select class="form-control" name="contract">
              <option value = "all">Select a Contract</option>  
                  @foreach($contracts as $contractv)
                    <?php
                    if(isset($Detail))
                    {
                      if($contractv->ContractID == $Detail->ContractID)
                      {
                        $select = "selected";
                      }
                      else
                      {
                        $select = "";
                      }
                    }
                    else
                    {
                      $select = "";
                    }
                    $date1 = $contractv->DateofContract;
                    $date2 = date('Y-m-d');

                    $ts1 = strtotime($date1);
                    $ts2 = strtotime($date2);

                    $year1 = date('Y', $ts1);
                    $year2 = date('Y', $ts2);

                    $month1 = date('m', $ts1);
                    $month2 = date('m', $ts2);

                  $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                  ?>
              <option {{ $select }} value="{{ $contractv->ContractID }}-{{ $diff }}">{{ $contractv->Name }}</option>
                @endforeach
            </select>  
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
    </div>
    <input type="submit" name="filter" value="Filter" class="btn btn-primary" style="margin-left: 20px;">
    </form>
  </div>
  <hr>
</div>
  @if(isset($neverPay))
    <div>
      You haven't pay any the payment on systems.
    </div>
  @else
    <?php $PR = round($contract->FinanceAmount + $late_fee + ($contract->FinanceAmount * $DPR) - $total,2); ?>
    <div id = "PDF">
      <div class="clearfix"></div>
      <h5 class="text-center">The activity displayed may not match your billing statements and may not reflect recent transactions.</h5>
      <div class="container">

      <h2 class="account">Account Information</h2>
      <hr style="border: 1px solid grey;">
      <div class="row">
        <div class="col-md-6">
          <label>Credit Limit</label>
        </div>
        <div class="col-md-6">
          <label>${{ $contract->FinanceAmount }}</label>
        </div>
      </div>

    <!-- <div class="row">
      <div class="col-md-6">
        <label>Available To Spend</label>
      </div>
      <div class="col-md-6">
        <label>$0</label>
      </div>
    </div> -->

    <div class="row">
      <div class="col-md-6">
        <label>Total Fees Late Charged YTD</label>
      </div>
      <div class="col-md-6">
        <label>${{ $late_fee }}</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <label>Total interest Charged YTD</label>
      </div>
      <?php $interest = round($PR * $DPR,2); ?> 
      <div class="col-md-6">
        <label>$<?php echo $interest ?></label>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <label>Next Statement Date</label>
      </div>
      <div class="col-md-6">
        <label>{{ $Billing_Date }}</label>
      </div>
    </div>

    <!-- <h2 class="account">Recent Activity</h2>
    <hr style="border: 1px solid grey;">
    <div class="row">
      <div class="col-md-6">
        <label>Last Statement Balance</label>
      </div>
      <div class="col-md-6">
        <label>${{ $PR }}</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <label>New Purchases</label>
      </div>
      <div class="col-md-6">
        <label>$0</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <label>Current Balance</label>
      </div>
      <div class="col-md-6">
        <label>${{ $PR + $interest - $total }}</label>
      </div>
    </div> -->



    <h2 class="account">Payments</h2>
    <hr style="border: 1px solid grey;">
    <div class="row">
      <div class="col-md-6">
        <label>Last Payments Date</label>
      </div>
      <div class="col-md-6">
        <label>{{ $last }}</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <label>Last Payments Due Date</label>
      </div>
      <div class="col-md-6">
        <label>{{ $original_date }}</label>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <label>Total Minimum Payment Due</label>
      </div>
      <div class="col-md-6">
        <label>${{ round(($PR + $interest - $total)/$contract->TimeFrame, 2)   }}</label>
      </div>
    </div>
  </div>
  </div>
  <div class="x_title" style="display: flex; border-bottom: none; border-top: solid 1px #e6e9ed; margin-top: 20px; padding-top: 15px;">
    <form name="Form1" action="{{ url('/DownloadContract') }}" method="POST">
      <a href="#"><button class='btn btn-primary' onclick="GenerateURL()">Download</button></a>
      <input type="hidden"  id="value1" name="value" value = "Default">
      <input type="hidden" name="check" value = "account">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    <form name="Form2" action="{{ url('/DownloadContract') }}" method="POST">
      <input type="hidden" name="email" value="<?php  if(isset($Customer->EmailAddress)){ echo $Customer->EmailAddress; }  ?>">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="check" value = "email">
      <a href="#"><button class='btn btn-primary' onclick="GenerateURL1()">Email</button></a>
      <input type="hidden" id="value2" name="value2" value = "Default">
    </form>
  </div>
  @endif
@endif

<script type="text/javascript">
  function GenerateURL()
  {
    var str = document.getElementById('PDF').innerHTML;
    document.getElementById('value1').value = str;
    document.getElementById('Form1').submit();   
    //window.location.href = '<?php echo url("/") ?>'+'/DownloadContract/|'+str+'|'; 
    //alert(url);
  }
  function GenerateURL1()
  {
    var str = document.getElementById('PDF').innerHTML;
    document.getElementById('value2').value = str;
    document.getElementById('Form2').submit();   
    //window.location.href = '<?php echo url("/") ?>'+'/DownloadContract/|'+str+'|'; 
    //alert(url);
  }
</script>
@endsection