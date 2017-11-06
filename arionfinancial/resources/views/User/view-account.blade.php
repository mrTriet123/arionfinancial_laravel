@extends('layouts.Authorized')

@section('content')
@section('title', "Statement Detail")

<div class="clearfix" style="display: inline-block; width: 100%;">
  <h5>Select a Contract to Open Current Accounts</h5>
  <div style="display:flex;">
  <strong style="line-height: 34px; margin-right: 10px;">Accounts</strong>
  <div style="width: 200px;">
    <form action="">
        <select class="form-control" name="contract" id="contract_payment">
          <option value = "all">Select a Contract</option>  
          @foreach($contracts as $contractv)
          <option value="{{ $contractv->ContractID }}">{{ $contractv->Name }}</option>
          @endforeach
        </select>  
    </div>
    <input type="submit" name="filter" value="Filter" id="sub_filter" class="btn btn-primary" style="margin-left: 20px;">
    </form>
  </div>
  <hr>
</div>
<div id="PDF"></div>
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
@section('internalScript')
  <script type="text/javascript">

    $(document).ready(function() {
      var selectedValue = {{$ContractID}};
      document.querySelector('#contract_payment [value="' + selectedValue + '"]').selected = true;
      if(document.getElementById('contract_payment').value == selectedValue) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          'type' : 'POST',
          'url' : 'view-accounts',
          'data' : {
            id : selectedValue,
          },
          success: function(data){
            if (data.result == 0) {
              $('#PDF').html("You haven't pay any the payment on systems.");
            }else{
              $('#PDF').html(data);
            }
            
          }
        });
      }
    });


    // var getId = $(this).find(":selected").val();
    $('#sub_filter').click(function(e){
      e.preventDefault();
        var ddl = document.getElementById("contract_payment");
        var selectedValue = ddl.options[ddl.selectedIndex].value;
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        'type' : 'POST',
        'url' : 'view-accounts',
        'data' : {
          id : selectedValue,
        },
        success: function(data){
          if (data.result == 0) {
            $('#PDF').html("You haven't pay any the payment on systems.");
          }else{
            $('#PDF').html(data);
          }
          
        }
      });
    });
  </script>
@endsection
@endsection