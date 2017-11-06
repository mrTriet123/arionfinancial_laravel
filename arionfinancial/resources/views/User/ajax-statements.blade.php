<?php
if($count == 0)
{
  echo "<br><br><center><strong>Statements are generated on your Billing Dates,Currently no Statements were Found<br><font size = '3'>Filter Your Results</font></center></strong>";
}
else
{
$bit = 0; 
$counter = 1;
     if($display == 'all' || $display == 'limited')
     {
      echo '
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Receive</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>
    ';
      for ($i=1; $i <= $count; $i++) 
      { 
         if($months_filter != 0)
         {
           for ($i=1; $i <= $months_filter; $i++) 
           { 
            $month = date("Y,F",strtotime(+($diff-$i)."Months" , strtotime($Detail->PaymentDueDate)));
            $date = date("Y-m-d",strtotime(+($diff-$i)."Months" , strtotime($Detail->PaymentDueDate)));
            echo '<tr>
            <td>'.$date.'</td>
                <td><a href = "'.url('Detail-Statement/').'/'.$Detail->ContractID.'/'.$date.'">'.$month.'-Statement</a></td>
          </tr>';
           }
           break;
         }
          $arr_date = explode('-', $Detail->PaymentDueDate);
          $str_date_y = (string)$arr_date[0];
          $str_date_m = (string)$arr_date[1];

            $month = date("Y,F",strtotime(+$i."Months" , strtotime($Detail->PaymentDueDate)));
            $date = date("Y-m",strtotime(+$i."Months" ,strtotime($str_date_y."-".$str_date_m)));
            // $date_2 = date("Y-m", strtotime(+$i."Months" , strtotime($Detail->PaymentDueDate)));
          $a_date = date("t", strtotime($date));
          if ( $arr_date[2] < $a_date) {
            echo '
        <tr>
          <td>'.$date."-".$arr_date[2].'</td>
          <td><a href = "'.url('Detail-Statement/').'/'.$Detail->ContractID.'/'.$date.'">'.$month.'-Statement</a></td>
        </tr>';
          }else{
            echo '
          <tr>
            <td>'.$date."-".$a_date.'</td>
            <td><a href = "'.url('Detail-Statement/').'/'.$Detail->ContractID.'/'.$date.'">'.$month.'-Statement</a></td>
          </tr>';
          }

          // echo "Start <br/>"; echo '<pre>'; print_r($a_date);echo '</pre>';exit("End Data");
      }
       //$counter = $counter + 1;
     }
     else
     {
      echo "<br><br><center><strong>Oops , Nothing to Display</center></strong>";
     }
 }
    ?>
    </tbody>
  </table>
