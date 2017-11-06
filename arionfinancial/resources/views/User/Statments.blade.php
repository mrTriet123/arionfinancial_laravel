@extends('layouts.Authorized')

@section('content')
@section('title', "Statements")




  <div class="row"> 
<div class="col-md-2" align="right" style="padding-top: 5px"><strong>Currently Viewing</strong>  </div>
<div class="col-md-4">
<form action="" method="">
        <select class="form-control" name="contract" id="contract_select">
        <option>Select a Contract</option>  
          @foreach($contracts as $contract)
            <?php
             if(isset($Detail))
             {
              if($contract->ContractID == $Detail->ContractID)
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
        $date1 = $contract->DateofContract;
        $date2 = date('Y-m-d');

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
      ?>
            <option {{ $select }} value="{{ $contract->ContractID }}-{{$diff}}">{{ $contract->Name }}</option>
          @endforeach
        </select>  
        <!-- <input type="hidden" value="{{ csrf_token() }}" name="_token"> -->
</div>
<div class="col-md-4"> 
  <select class="form-control" name="months" id="month_select">
        <option value="all">Select an option</option>  
         <option value="0">All</option>
         <?php 
          for ($i=1; $i < 13; $i++) 
          { 
            if($i == $months_filter)
              {
                 $select = "selected";
              }
              else
              {
                $select = "";
              }
               echo '<option value = "'.$i.'">'.date("Y,F",strtotime("-1 Months" , strtotime(date('Y-m-d')))).' | '.date("Y,F",strtotime(-($i+1)."Months" , strtotime(date('Y-m-d')))).' ( Past '.$i.' Month )</option>';  
          }
         ?>
        </select> 

  

 </div>
<div class="col-md-2"><input name="filter" value="Filter" class="btn btn-primary" id="statement_submit" type="button"></div>
  </div>  

</form>
<div id="showStatements">
  
</div>
@section('internalScript')
  <script type="text/javascript">

    $('#statement_submit').click(function(e){
      e.preventDefault();
      var contractSelec = $( "#contract_select" ).val();
      var monthSelect = $( "#month_select" ).val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
        'type' : 'POST',
        'url' : 'post-statements',
        'data' : {
          contract : contractSelec,
          months : monthSelect
        },
        success: function(data){
          $('#showStatements').html(data);
        }
      });
    });


    $(document).ready(function() {
      var selectedValue ="{{$ContractID}}-{{$diffs}}";
      // document.querySelector('#contract_select [value="'+selectedValue+'"]').selected = true;
      $("#contract_select > option[value=" + selectedValue + "]").prop("selected",true);
      if(document.getElementById('contract_select').value == selectedValue) {
        document.querySelector('#month_select [value="0"]').selected = true;
        var contractSelec = $( "#contract_select" ).val();
        var monthSelect = $( "#month_select" ).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
          'type' : 'POST',
          'url' : 'post-statements',
          'data' : {
            contract : contractSelec,
            months : monthSelect
          },
          success: function(data){
            $('#showStatements').html(data);
          }
        });
      }
    });
  </script>
@endsection
@endsection