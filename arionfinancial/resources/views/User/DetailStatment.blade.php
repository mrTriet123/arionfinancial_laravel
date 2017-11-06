@extends('layouts.Authorized')

@section('content')
@section('title', "Statement Detail")

<style type="text/css">
	@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>

<div class="x_title">
              <h2>Statement Details For: {{ $contracts->Name }}</h2>
              <div class="clearfix"></div>
              <form name="Form1" action="{{ url('/DownloadContract') }}" method="POST">
              <a href="#"><button class='btn btn-primary' onclick="GenerateURL()">Download</button></a>
              <input type="hidden"  id="value1" name="value" value = "Default">
              <input type="hidden" name="check" value = "account">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              </form>

              <form name="Form2" action="{{ url('/DownloadContract') }}" method="POST">
              <input type="hidden" name="email" value="<?php  if(isset($emailuser->EmailAddress)){ echo $emailuser->EmailAddress; }  ?>">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="check" value = "email">
              <a href="#"><button class='btn btn-primary' onclick="GenerateURL1()">Email</button></a>
              <input type="hidden" id="value2" name="value2" value = "Default">
            </div>
            </form>

<div id="PDF">
<div class="row">

	<div class="col-md-6">
    @if($Customer->Profile == "")
    <img src="{{ url('public/upload/') }}/user.png" width="90" height="90">
    @else
    <img src="{{ url('public/upload/') }}/normal_{{$Customer->Profile }}" width="90" height="90">
    @endif
	</div>
	<div class="col-md-6" style="padding-top: 20px;">
		<label>Customer Name: {{ $Customer->FirstName }}  {{ $Customer->LastName }} </label><br>	
		<label>Account Number: {{ $Customer->account }}</label><br>	
		<label>Statement Closing Date: {{ $original_date }}</label>
	</div>
	
</div>



<div class="row">	
 <div class="col-md-6" style="border: 1px solid black;  padding-top: 0px; ">	
  <div class="row" style="background-color: gray;color:white; ">	
 <h2><center>Summary of Account Activity</center></h2>
  </div>
   <div class="row">	

      <div class="col-sm-6"><strong>Previous Balance</strong></div>
      <?php $PR = round($contracts->FinanceAmount + $late_fee + ($contracts->FinanceAmount * $DPR) - $total,2); ?>
      <div class="col-sm-6">${{ $PR }}</div>
   </div>	

   <div class="row">	

      <div class="col-sm-6"><strong>New Purchaes	</strong></div>
      <div class="col-sm-6">$0.00</div>
   </div>	


   <div class="row">	

      <div class="col-sm-6"><strong>Payments</strong></div>
      <div class="col-sm-6">${{ $total }}.00</div>
   </div>	

    <div class="row">	

      <div class="col-sm-6"><strong>Late Fees </strong></div>
      <div class="col-sm-6">${{ $late_fee }}.00</div>
   </div>


   <div class="row">	

      <div class="col-sm-6"><strong>Credits,Fees & Adjustments(net)</strong></div>
      <div class="col-sm-6">$0.00</div>
   </div>	



   <div class="row">	
      <div class="col-sm-6"><strong>Interest Charges(net)</strong></div>
      <?php $interest = round($PR * $DPR,2); ?>
      <div class="col-sm-6"><?php echo $interest ?></div>
   </div>

   <hr>	
 <div class="row">	

      <div class="col-sm-6"><strong>New Balance</strong></div>
      <div class="col-sm-6"><strong>${{ $PR + $interest - $total }}</strong></div>
   </div>	
		
 </div>

  <div class="col-md-6" style="border: 1px solid black; border-left: 0px; padding-top: 0px;">	
  <div class="row" style="background-color: gray;color:white;">	
 <h2><center>Payment Information</center></h2>
  </div>
  <div class="row" style="height: 41px;">	

      <div class="col-sm-6"><strong>New Balance</strong></div>
      <div class="col-sm-6"><strong>${{ $PR + $interest - $total }}</strong></div>
   </div>

   <div class="row">	

      <div class="col-sm-6"><strong>Total minimum Payment Due</strong></div>
      @if($contracts->TimeFrame == 0)
      <div class="col-sm-6"><strong>${{ round(($PR + $interest - $total), 2) }}</strong></div>
      @else
      <div class="col-sm-6"><strong>${{ round(($PR + $interest - $total)/$contracts->TimeFrame, 2) }}</strong></div>
      @endif
   </div>

   <div class="row">	

      <div class="col-sm-6"><strong>Payment Due Date</strong></div>
      <div class="col-sm-6"><strong>{{ $original_date }}</strong></div>
   </div>
   <br>
   <br>
   <strong>	Late Payment Warning:</strong>If we do not recevie your total minimum payment due by the payment due date <br> listed above, you may have to pay a late fee up to ${{ $total }}.00 Monthly.	
 </div>
 
</div>
</div>

<center><strong>Enclose this coupon with your check</strong></center>
</div>
<br>	

<div class="row">	

<div class="col-md-4">	

  @if($Customer->Profile == "")
  <img src="{{ url('public/upload/') }}/user.png" width="90" height="90">
  @else
  <img src="{{ url('public/upload/') }}/normal_{{$Customer->Profile }}" width="90" height="90">
  @endif

</div>
<div class="col-md-8">	

<table class="table table-bordered">
    <thead>
      <tr>
        <th>Total minimum <br>	 payment due</th>
        <th>Payment Due Date</th>
        <th>New Balance</th>
        <th>Account Number</th>
      </tr>
    </thead>
    <tbody>
      
      
      <tr>
        <td>${{ round(($PR + $interest - $total)/$contracts->TimeFrame, 2) }}</td>
        <td>{{ $original_date }}</td>
        <td>${{ $PR + $interest - $total }}</td>
        <td>{{ $Dealer->account }}</td>
      </tr>
    </tbody>
  </table>
<p class="row" style="border: 1px solid black;"><strong style="font-size: 20px; margin-top: -20px;">	
<div class="col-xs-6" style="border: 0px solid black;">Payment Enclosed:</strong>	<span style="font-size: 20px;">${{ round(($PR + $interest - $total)/$contracts->TimeFrame, 2) }}</span>	</div>
<div class="col-xs-6">	
 <box class="box"></box>	&nbsp;
  <box class="box"></box>	&nbsp;
   <box class="box"></box>	&nbsp;
    <box class="box"></box>	&nbsp;
     <box class="box"></box> <box class="dot">.</box>
      <box class="box"></box> 	&nbsp;<box class="box"></box>

</div>



   </p>
</div>
</div>


<div class="row">	

 <div class="col-md-6">	

<h2>{{ $Customer->FirstName }}  {{ $Customer->LastName }}<br>	<font size="2"> {{ $Customer->Address }} </font></h2>	
 </div>
 <div class="col-md-6">
<h2>Make Payment to: {{ $Dealer->FirstName }}  {{ $Dealer->LastName }}<strong><font size="2"> {{ $Dealer->Address }} </font></strong></h2>

 	</div>

</div>

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