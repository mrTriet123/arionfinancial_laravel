<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Architecture\Enum\Role\RoleEnum;
use App\Http\Requests\UserManagement\Auth\Register\RegisterRequest;
use \App\Notifications\RegisterNotification;
use Illuminate\Support\Str;
use Illuminate\Auth\Passwords\DatabaseTokenRepository;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\UserManagement\Auth\Register\AccountActivation\AccountActivationRequest;
use Illuminate\Foundation\Auth\RedirectsUsers;
use App\Models\User\UserModel;
use Session;
use DB;
use Mail;
use PDF;
use Hash;
use Auth;

class UserController extends Controller
{
    use RedirectsUsers;
    
    private $token;
    
    public function __construct() {
        $config = app()["config"]["auth.passwords.users"];
        $this->token = $this->createTokenRepository($config);
        $ID = Session::get('UserID');
        $data = DB::table('tbluser')->where('UserID', $ID)->first();
        View::share('User', $data);

    }

    public function getAccount() 
    {
      if(session::get('RoleID') == '2')
      { 
        $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
        $contracts_detail = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->first();
        $months_filter = 0;

        return View('User.account')->with('check',1)->with('contracts',$contracts);
      }
      elseif(session::get('RoleID') == '3')
      {
        $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
        $contracts_detail = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->first();
        $months_filter = 0;

        return View('User.account')->with('check',1)->with('contracts',$contracts);
      }  
    }
    
    public function postAccount(Request $request)
    {
      // dd($request->all());
      if(isset($_POST['contract']) && $_POST['contract'] == 'all')
      {
        $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
        return View('User.account')->with('contracts',$contracts)->with('check','1');
      }

      if(isset($_POST['filter']))
      {
          if(session::get('RoleID') == '2')
          { 
            
            $value = explode("-", $_POST['contract']);
            $months = $value[1];
            $contractID = $value[0];
            $months_filter = 'all';
            $contracts_detail = DB::table('tblcontract')->where('ContractID',$contractID)->first();
            $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
            if($months_filter == 'all')
            {
              return View('User.Statments')
                ->with('check','filter')
                ->with('display','all')
                ->with('months_filter',0)
                ->with('count',$months)
                ->with('Detail',$contracts_detail)
                ->with('contracts',$contracts);
            }
            else
            {
              return View('User.Statments')
                ->with('check','filter')
                ->with('display','limited')
                ->with('count',$months)
                ->with('months_filter',$months_filter)
                ->with('Detail',$contracts_detail)
                ->with('contracts',$contracts);
            }
          }
        elseif(session::get('RoleID') == '3')
        {
          $value = explode("-", $_POST['contract']);
          $months = $value[1];
          $contractID = $value[0];
          $months_filter = 'all';
          $contracts_detail = DB::table('tblcontract')->where('ContractID',$contractID)->first();
          $contracts1 = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
          if($months_filter == 'all')
          {
            $total = 0;  
            $contracts = DB::table('tblcontract')->where('ContractID',$contractID)->where('CustomerID',session::get('UserID'))->first();
            $Date = $contracts->PaymentDueDate;
            $Date = explode("-",$Date);
            $billing_day = $Date[2];
            $Date = date("Y-m", strtotime("-1 months"));
            $Date = $Date."-".$billing_day;
            $Statement_date = $Date;  
            $first_contract_duedate = $contracts->PaymentDueDate;
            $date1 = $first_contract_duedate;
            $date2 = $Statement_date;
            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);
            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);      
            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            $payments_1 = DB::table('tblpayment')->where('ContractID',$contractID)->whereBetween('PaymentDate',array($first_contract_duedate,$Statement_date))->get();
            $late_fee = $diff - count($payments_1); 
            $late_fee = $late_fee * $contracts->LateFees;
            $DPR = ($contracts->APR)/100;
            $DPR = $DPR/365;
            $a_date = $Date;
            $a_date = date("t", strtotime($a_date));
            $DPR = $DPR * $a_date;
            $payments = DB::table('tblpayment')->where('ContractID',$contractID)->where('PaymentDate','<=',$Date)->get();

            $last_payment = DB::table('tblpayment')->where('ContractID',$contractID)->orderBy('created_at', 'desc')->first();

            if(!$last_payment){
              return View('User.account')
                  ->with('contracts',$contracts1)
                  ->with('neverPay', 1);
            }

            foreach ($payments as $key => $value) 
              {
                  $total = $value->PaymentAmount + $total;
              }
            $user = DB::table('tbluser')->where('UserID',$contracts->CustomerID)->first();
            $dealer = DB::table('tbluser')->where('UserID',$contracts->DealerID)->first();

            return View('User.account')
                      ->with('contracts',$contracts1)
                      ->with('Customer',$user)
                      ->with('Dealer',$dealer)
                      ->with('Customer',$user)
                      ->with('original_date',$Date)
                      ->with('total',$total)
                      ->with('contract',$contracts)
                      ->with('late_fee',$late_fee)
                      ->with('DPR',$DPR)
                      ->with('Billing_Date',date($Date, strtotime("+1 months")))
                      ->with('last',$last_payment->PaymentDate)
                      ->with('Detail',$contracts_detail);
              //return View('User.account')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count',$months)->;
            }
            else
            {
              return View('User.account')
                ->with('check','filter')
                ->with('display','limited')
                ->with('count',$months)
                ->with('months_filter',$months_filter)
                ->with('Detail',$contracts_detail)
                ->with('contracts',$contracts);
            }
        }
      }
      // else
      // {
      //   if(session::get('RoleID') == '2')
      //   { 
      //     $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
      //     $contracts_detail = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->first();
      //     $months_filter = 0;

      //     return View('User.account')->with('check',1)->with('contracts',$contracts);
      //   }
      //   elseif(session::get('RoleID') == '3')
      //   {
      //     $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
      //     $contracts_detail = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->first();
      //     $months_filter = 0;

      //     return View('User.account')->with('check',1)->with('contracts',$contracts);
      //   }   
      // } 
    }

    public function getViewAccount(){
      if(session::get('RoleID') == '2')
      { 
        $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
        $contracts_detail = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->first();
        $months_filter = 0;

        return View('User.view-account')->with('check',1)->with('contracts',$contracts);
      }
      elseif(session::get('RoleID') == '3')
      {
        $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
        $contracts_detail = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->first();
        $months_filter = 0;

        foreach ($contracts as $contract) {
          # code...
          $payments = DB::table('tblpayment')->where('ContractID',$contract->ContractID)->orderBy('PaymentDate', 'desc')->get();
          if (!empty($payments)) {
            # code...
            return View('User.view-account')->with('check',1)->with('contracts',$contracts)->with('ContractID',$contract->ContractID);
            break;
          }
        }
        
      } 
    }

    public function postViewAccount(Request $request){

      $payments = DB::table('tblpayment')->where('ContractID',$request['id'])->orderBy('PaymentDate', 'desc')->get();
      $contract = DB::table('tblcontract')->where('ContractID',$request['id'])->first();
      // echo "Start <br/>"; echo '<pre>'; print_r($next_date);echo '</pre>';exit("End Data");

      if(!empty($payments) && session::get('RoleID') == '3'){
        $total = 0;
        $date = [];
        foreach ($payments as $key => $value) {
          # code...
          $get_val = $value->PaymentAmount;
          $total += $get_val;
          $date[] = $value->PaymentDate;
        }
        $next_date = max($date);
        $finance_amount = $contract->FinanceAmount;
        $balance = $finance_amount - $total;
 
        $contracts = DB::table('tblcontract')->where('ContractID',$request['id'])->where('CustomerID',session::get('UserID'))->first();

        $Date = $contracts->PaymentDueDate;
        $Date = explode("-",$Date);
        $billing_day = $Date[2];
        $Date = date("Y-m", strtotime("+1 months"));
        $Date = $Date."-".$billing_day;
        $Statement_date = $Date;
        $date_next = explode('-',$Statement_date);
        $date_month = $date_next[1] + 1;
        $first_contract_duedate = $contracts->PaymentDueDate;
        $date1 = $first_contract_duedate;
        $date2 = $Statement_date;
        $date3 = $date_next[0]."-".$date_month."-".$billing_day;
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        $ts3 = strtotime($date3);
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        $year3 = date('Y', $ts3);
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        $month3 = date('m', $ts3);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        $diff_next = (($year3 - $year1) * 12) + ($month3 - $month1);

        $payments_1 = DB::table('tblpayment')->where('ContractID',$request['id'])->whereBetween('PaymentDate',array($first_contract_duedate,$Statement_date))->get();
        $payments_next = DB::table('tblpayment')->where('ContractID',$request['id'])->whereBetween('PaymentDate',array($first_contract_duedate,$date3))->get();

        $late_fee = $diff - count($payments_1); 
        $late_fee = $late_fee * $contracts->LateFees;
        $late_fee_next = $diff_next - count($payments_next); 
        $late_fee_next = $late_fee_next * $contracts->LateFees;

        $DPR = ($contracts->APR)/100;
        $DPR = $DPR/365;
        $a_date = $Date;
        $a_date = date("t", strtotime($a_date));
        $DPR = $DPR * $a_date;

        $DPR_next = ($contracts->APR)/100;
        $DPR_next = $DPR_next/365;
        $a_date_next = $date3;
        $a_date_next = date("t", strtotime($a_date_next));
        $DPR_next = $DPR_next * $a_date_next;

        $payments = DB::table('tblpayment')->where('ContractID',$request['id'])->where('PaymentDate','<=',$Date)->get();
        $last_payment = DB::table('tblpayment')->where('ContractID',$request['id'])->where('PaymentDate', $next_date)->first();

        $user = DB::table('tbluser')->where('UserID',$contracts->CustomerID)->first();
        $dealer = DB::table('tbluser')->where('UserID',$contracts->DealerID)->first();

        $PR = round($contract->FinanceAmount + $late_fee + ($contract->FinanceAmount * $DPR) - $total,2);
        $interest = round($PR * $DPR,2);
        $minimum_pay = round(($PR + $interest - $total)/$contract->TimeFrame, 2);

        $PR_next = round($contract->FinanceAmount + $late_fee_next + ($contract->FinanceAmount * $DPR_next) - $total,2);
        $interest_next = round($PR_next * $DPR_next,2);
        $minimum_pay_next = round(($PR_next + $interest_next - $total)/$contract->TimeFrame, 2);

        $last_pay = $last_payment->PaymentAmount;
        $id_pay = $last_payment->ContractID;

        return view('User.ajax-view-infor',compact('payments','contract','balance','minimum_pay','date2','last_pay','date3','minimum_pay_next','id_pay'));
      }else{
        return response()->json([
            'result' => 0,
        ],200);
      }
    }


    public function resend($email)
    {
      $requests = UserModel::where('EmailAddress', '=', $email)->first();
      if ($requests) 
       {
         $HashPass = str_replace("/","",$requests->Password);
         Mail::queue('emails.welcome',['name' => $requests->UserName,'username' => $email, 'password' => $HashPass], function ($message) use ($email)
           {
          
             $message->from('email@arionfinancial.com', 'Arion Financial');
              $message->subject('Welcome to Arion Financial');
              $message->to($email);
             
           }); 

          return redirect()->back()->with('login', 'We have sent you an email. Please Activate you account and Get Started!');
       }
       else
       {
        return Redirect::back()->with('errors','Email do not Exits');
       }
    } 

    public function PDF($DATA)
    {
      $pdf = PDF::loadHTML($DATA);
      return $pdf->download('invoice.pdf');
    }
    public function Statments()
    {
     if(isset($_POST['filter']))
     {
      if(session::get('RoleID') == '2')
       { 
        dd($_POST['contract']);
       $value = explode("-", $_POST['contract']);
       $months_filter = $_POST['months'];
       $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
       if(isset($value[1]) && isset($value[0]))
       {
       $months = $value[1];
       $contractID = $value[0];
       $contracts_detail = DB::table('tblcontract')->where('ContractID',$contractID)->first();
       }
       else
       {
         return View('User.Statments')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count','')->with('contracts',$contracts);
       }
       if($months_filter == 'all')
       {
        // dd('1');
         return View('User.Statments')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count',$months)->with('Detail',$contracts_detail)->with('contracts',$contracts);
       }
       else
       {

         return View('User.Statments')->with('check','filter')->with('display','limited')->with('count',$months)->with('months_filter',$months_filter)->with('Detail',$contracts_detail)->with('contracts',$contracts);
       }
      }
      elseif(session::get('RoleID') == '3')
      {
       $value = explode("-", $_POST['contract']);
      //  dd($value);
       $months_filter = $_POST['months'];
       $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
       if(isset($value[1]) && isset($value[0]))
       {
       $months = $value[1];
       $contractID = $value[0];
       $contracts_detail = DB::table('tblcontract')->where('ContractID',$contractID)->first();
       }
       else
       {
         return View('User.Statments')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count','')->with('contracts',$contracts);
       }

       if($months_filter == 'all')
       {
        //  dd($months);
         return View('User.Statments')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count',$months)->with('Detail',$contracts_detail)->with('contracts',$contracts);
       }
       else
       {
        //  dd($months_filter);
         return View('User.Statments')
          ->with('check','filter')
          ->with('display','limited')
          ->with('count',$months)
          ->with('months_filter',$months_filter)
          ->with('Detail',$contracts_detail)
          ->with('contracts',$contracts);
       }
      }
     }  
     else
     {
       if(session::get('RoleID') == '2')
       { 
         $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
         
         $contracts_detail = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->first();
         $months_filter = 0;

         return View('User.Statments')->with('contracts',$contracts)->with('display','none')->with('months_filter',$months_filter)->with('count',0);
       }
       elseif(session::get('RoleID') == '3')
       {
         $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
         $contracts_detail = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->first();
         $months_filter = 0;

         return View('User.Statments')->with('contracts',$contracts)->with('display','none')->with('months_filter',$months_filter)->with('count',0);
       }   
     } 
    }

    public function getStatments(){
      if(session::get('RoleID') == '2')
       { 
         $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
         $contracts_detail = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->first();
         $months_filter = 0;

         foreach ($contracts as $contract) {
           # code...
            $date1 = $contract->DateofContract;
            $date2 = date('Y-m-d');

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diffs = (($year2 - $year1) * 12) + ($month2 - $month1);
            if(!empty($diffs)){
              return View('User.Statments')->with('contracts',$contracts)->with('display','none')->with('months_filter',$months_filter)->with('count',0)->with('ContractID',$contracts_detail->ContractID)->with('diffs',$diffs);
              break;
            }  
          }
          
       }
       elseif(session::get('RoleID') == '3')
       {
         $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
         $contracts_detail = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->first();
         $months_filter = 0;

         foreach ($contracts as $contract) {
           # code...
            $date1 = $contract->DateofContract;
            $date2 = date('Y-m-d');

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diffs = (($year2 - $year1) * 12) + ($month2 - $month1);
            if(!empty($diffs)){
              return View('User.Statments')->with('contracts',$contracts)->with('display','none')->with('months_filter',$months_filter)->with('count',0)->with('ContractID',$contracts_detail->ContractID)->with('diffs',$diffs);
              break;
            }  
          }
       }   
    }

    public function postStatments(Request $request){
      if(session::get('RoleID') == '2')
      { 
       $value = explode("-", $_POST['contract']);
       $months_filter = $_POST['months'];
       $contracts = DB::table('tblcontract')->where('DealerID',session::get('UserID'))->get();
       if(isset($value[1]) && isset($value[0]))
         {
           $months = $value[1];
           $contractID = $value[0];
           $contracts_detail = DB::table('tblcontract')->where('ContractID',$contractID)->first();
         }
       else
         {
           return View('User.ajax-statements')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count','')->with('contracts',$contracts)->with('diff',$value[1]);
         }
       if($months_filter == 'all')
         {
          // dd('1');
           return View('User.ajax-statements')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count',$months)->with('Detail',$contracts_detail)->with('contracts',$contracts)->with('diff',$value[1]);
         }
       else
         {

           return View('User.ajax-statements')->with('check','filter')->with('display','limited')->with('count',$months)->with('months_filter',$months_filter)->with('Detail',$contracts_detail)->with('contracts',$contracts)->with('diff',$value[1]);
         }
      }
      elseif(session::get('RoleID') == '3')
      {
       $value = explode("-", $_POST['contract']);
      //  dd($value);
       $months_filter = $_POST['months'];
       $contracts = DB::table('tblcontract')->where('CustomerID',session::get('UserID'))->get();
       if(isset($value[1]) && isset($value[0]))
       {
         $months = $value[1];
         $contractID = $value[0];
         $contracts_detail = DB::table('tblcontract')->where('ContractID',$contractID)->first();
       }
       else
       {
         return View('User.ajax-statements')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count','')->with('contracts',$contracts)->with('diff',$value[1]);
       }

       if($months_filter == 'all')
       {
        //  dd($months);
         return View('User.ajax-statements')->with('check','filter')->with('display','all')->with('months_filter',0)->with('count',$months)->with('Detail',$contracts_detail)->with('contracts',$contracts)->with('diff',$value[1]);
       }
        else
        {
        //  dd($months_filter);
         return View('User.ajax-statements')
          ->with('check','filter')
          ->with('display','limited')
          ->with('count',$months)
          ->with('months_filter',$months_filter)
          ->with('Detail',$contracts_detail)
          ->with('contracts',$contracts)
          ->with('diff',$value[1]);
        }
      }
    }

    public function DetailStatment($ID,$Date)
    {  
      if(session::get('RoleID') == '2')
       {
         $total = 0;
         $emailuser = DB::table('tbluser')->where('UserID',session::get('UserID'))->first();  
         $contracts = DB::table('tblcontract')->where('ContractID',$ID)->where('DealerID',session::get('UserID'))->first();
         // $user_cont = DB::table('tbluser')->where('UserID',$contracts->CustomerID)->first(); 
         $Statement_date = $Date;  
         $first_contract_duedate = $contracts->PaymentDueDate;
         $date1 = $first_contract_duedate;
         $date2 = $Statement_date;
         $ts1 = strtotime($date1);
         $ts2 = strtotime($date2);
         $year1 = date('Y', $ts1);
         $year2 = date('Y', $ts2);
         $month1 = date('m', $ts1);
         $month2 = date('m', $ts2);      
         $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
         $payments_1 = DB::table('tblpayment')->where('ContractID',$ID)->whereBetween('PaymentDate',array($first_contract_duedate,$Statement_date))->get();
         $late_fee = $diff - count($payments_1); 
         $late_fee = $late_fee * $contracts->LateFees;
         $DPR = ($contracts->APR)/100;
         $DPR = $DPR/365;
         $a_date = $Date;
         $a_date = date("t", strtotime($a_date));
         $DPR = $DPR * $a_date;
         $payments = DB::table('tblpayment')->where('ContractID',$ID)->where('PaymentDate','<=',$Date)->get();
         foreach ($payments as $key => $value) 
          {
              $total = $value->PaymentAmount + $total;
          }
         $user = DB::table('tbluser')->where('UserID',$contracts->CustomerID)->first();
         $dealer = DB::table('tbluser')->where('UserID',$contracts->DealerID)->first();
         return View('User.DetailStatment')->with('contracts',$contracts)->with('Dealer',$dealer)->with('Customer',$user)->with('emailuser',$emailuser)->with('original_date',$Date)->with('total',$total)->with('late_fee',$late_fee)->with('DPR',$DPR);
       }
       elseif(session::get('RoleID') == '3')
       {
         $total = 0;
         $emailuser = DB::table('tbluser')->where('UserID',session::get('UserID'))->first();      
         $contracts = DB::table('tblcontract')->where('ContractID',$ID)->where('CustomerID',session::get('UserID'))->first();
         $Statement_date = $Date;  
         $first_contract_duedate = $contracts->PaymentDueDate;
         $date1 = $first_contract_duedate;
         $date2 = $Statement_date;
         $ts1 = strtotime($date1);
         $ts2 = strtotime($date2);
         $year1 = date('Y', $ts1);
         $year2 = date('Y', $ts2);
         $month1 = date('m', $ts1);
         $month2 = date('m', $ts2);      
         $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
         $payments_1 = DB::table('tblpayment')->where('ContractID',$ID)->whereBetween('PaymentDate',array($first_contract_duedate,$Statement_date))->get();
         $late_fee = $diff - count($payments_1); 
         $late_fee = $late_fee * $contracts->LateFees;
         $DPR = ($contracts->APR)/100;
         $DPR = $DPR/365;
         $a_date = $Date;
         $a_date = date("t", strtotime($a_date));
         $DPR = $DPR * $a_date;
         $payments = DB::table('tblpayment')->where('ContractID',$ID)->where('PaymentDate','<=',$Date)->get();
         foreach ($payments as $key => $value) 
          {
              $total = $value->PaymentAmount + $total;
          }
         $user = DB::table('tbluser')->where('UserID',$contracts->CustomerID)->first();
         $dealer = DB::table('tbluser')->where('UserID',$contracts->DealerID)->first();
         return View('User.DetailStatment')->with('contracts',$contracts)->with('Dealer',$dealer)->with('Customer',$user)->with('emailuser',$emailuser)->with('original_date',$Date)->with('total',$total)->with('late_fee',$late_fee)->with('DPR',$DPR);
    }
       } 
      

      
    public function Users() {
        if(session::get('RoleID') == '1' )
        {
           $Users = DB::table('tbluser')->where('RoleID',2)->get();
        }
        elseif(session::get('RoleID') == '2')
        {
          $Users = DB::table('tbluser')->where('RoleID',3)->where('WhoCreated',Session::get('UserID'))->get();
        }
        elseif(session::get('RoleID') == '3')
        {
          $authUser = DB::table('tbluser')->where('UserID',Session::get('UserID'))->first();
          $Users = DB::table('tbluser')->where('RoleID',2)->where('UserID', $authUser->WhoCreated)->get();
        }
        return View("User.List", ['Users' => $Users , 'RoleID' => session::get('RoleID')]);
    }
    
    public function User($id) {
        $User = UserModel::where('UserID', $id)->where('WhoCreated',Session::get('UserID'))->first();
        if($User != null) {
            return View("User.Edit", ['User' => $User , 'RoleID' => session::get('RoleID')]);
        }
    }
    
    public function AddUser() {
         $RoleID = session::get('RoleID');
         if($RoleID == '3')
            {
              return Redirect("/");
            }   
        return View("User.Add")->with('RoleID',$RoleID);;
    }
    
    public function EditUser(Request $request) {
          $RoleID = session::get('RoleID');
        if($RoleID == '3')
            {
              return Redirect("/");
            }         

        $User = UserModel::where("UserID", $request["UserID"])->first();
        
        if($User != null) {
            $User->UserName = $request["UserName"];
            $User->EmailAddress = $request["EmailAddress"];
            $User->FirstName = $request["FirstName"];
            $User->LastName = $request["LastName"];
            $User->Profile = 'user.png';
            $User->save();
            return redirect()->route("Users");
        }
    }
    
    public function activate($credentials)
      {
      $array = explode(":", $credentials);
      $HashPass = $array[1];
      $Data = UserModel::where('UserName', $array[0])->first();
      if($Data)
      {
        $send_email = $Data->EmailAddress;
        $Data = $Data->Password;
        $Data = str_replace("/", "", $Data);
        if($Data == $array[1])
        {
            if(UserModel::where('UserName' , '=' ,$array[0])->update(['IsActive' => 1]))
            {
            Mail::queue('emails.activate',['name' => $array[0]], function ($message) use ($send_email)
             {
            
              $message->from('email@arionfinancial.com', 'Arion Financial');
              $message->subject('Welcome to Arion Financial');
              $message->to($send_email);
               
             }); 
         

         return redirect('/login')->with('success', 'We are glad to have you onboard with Arion Financial, Please Login to proceed');
          }
          else
          {
             return redirect('/');
          }
        }
        else
        {
          return redirect('/');
        }
      } 
      else
      {
        return redirect('/');
      }
    
    }
      public function logout()
    {
      Session::flush();
      return redirect('/');
    }

      public function resetpass()
    {
      if(isset($_POST['reset']))
       {
        $username = $_POST['username'];
        $results = UserModel::where('EmailAddress','=',$username)->first();
        if($results)
        {
          $send_email = $results->EmailAddress;
          $password = $results->Password;
          $username = $results->UserName;
          $HashPass = str_replace("/","",$password);
          Mail::queue('emails.reset',['email' => $send_email,'username' => $username, 'password' => $HashPass], function ($message) use ($send_email)
           {
             $message->from('email@arionfinancial.com', 'Arion Financial');
             $message->subject('Password Reset Request');
             $message->to($send_email);   
           }); 

        return redirect('/reset')->with('success', 'We have sent you a email, Please check your email to reset your password.');

        }
        else
        {
          return redirect('/reset')->with('errors', 'Invalid Email, We do not have any member registered with that Email.');
        }
       }
    }

     public function resetpass_email($credentials)
      {
        $array = explode(":", $credentials);
        $HashPass = $array[1];
        $Data = UserModel::where('UserName', $array[0])->first();
        if($Data)
        { 
          $send_email = $Data->EmailAddress;
          $Data = $Data->Password;
          $Data = str_replace("/", "", $Data);
          if($Data == $array[1])
          {
              $origin = str_random(8);
              $hashed_random_password = Hash::make($origin);
              if(UserModel::where('UserName' , '=' ,$array[0])->update(['Password' => $hashed_random_password]))
                 {
                    Mail::queue('emails.newpass',['email' => $send_email,'password' => $origin], function ($message) use ($send_email)
                    {
                           $message->from('email@arionfinancial.com', 'Arion Financial');
                           $message->subject('New Password');
                           $message->to($send_email);
                           
                         }); 
             return redirect('/login')->with('login', 'Check your email and Login with your new password');
          }
          else
          {
            return redirect('/');
          }
        }
        else
        {
            return redirect('/');
        }
      }
      else
      {
        return redirect('/');
      } 
    }
    public function SaveUser(RegisterRequest $request) {
        $RoleID = session::get('RoleID');
           
        if($RoleID == 1)
        {
            $Role = '2';
        }
        else
        {
            $Role = '3';
        }
        $HashPass =  bcrypt($request["Password"]);
        $user = new UserModel();
        $user->UserName     =   $request["UserName"];
        $user->EmailAddress =   $request["EmailAddress"];
        $user->FirstName    =   $request["FirstName"];
        $user->LastName     =   $request["LastName"];
        $user->Password     =   $HashPass;
        $user->RoleID       =   $Role;
        $user->WhoCreated   =   session::get('UserID');
        $user->save();
        $HashPass = str_replace("/","",$HashPass);
        $send_email = $request['EmailAddress'];
        Mail::queue('emails.welcome',['name' => $request->UserName,'password' => $HashPass], function ($message) use ($send_email)
        {
          
             $message->from('email@arionfinancial.com', 'Arion Financial');
             $message->subject('Welcome to Arion Financial');
             $message->to($send_email);
             
        }); 
        return redirect()->route("Users");
    }
    
    private function createTokenRepository(array $config)
    {
        $key = app()["config"]['app.key'];

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        $connection = isset($config['connection']) ? $config['connection'] : null;

        return new DatabaseTokenRepository(
            app()['db']->connection($connection),
            app()['hash'],
            $config['table'],
            $key,
            "Registeration",
            $config['expire']
        );
    }
    
    public function UserDelete($id) {
        $RoleID = session::get('RoleID');
       if($RoleID == '3')
            {
              return Redirect("/");
            } 
         
        $User = UserModel
                ::where('UserID', $id)
                ->first();        
        
        if($User != null) {
            $User->delete();
            return redirect()->route("Users");
        }
    }
    
    public function ActivateAccountForm($token) {
        return View("User.ActivateAccount", ["token" => $token]);
    }
    public function ActivateAccount(AccountActivationRequest $request) {
        $response = $this->broker()->ActivateAccount(
            $this->credentials($request), function ($user) {
                $user->forceFill([
                    'IsActive'          => true,
                    'remember_token'    => Str::random(60),
                ])->save();
            }
        );
        return $response == "ActivateAccount.AccountActivated"
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request, $response);
    }
    
    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
                            ->with('status', trans($response));
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
                    ->withInput($request->only('EmailAddress'))
                    ->withErrors(['EmailAddress' => trans($response)]);
    }
    
    protected function credentials(Request $request)
    {
        return $request->only(
            'EmailAddress', 'Password', 'token'
        );
    }

    public function broker()
    {
        return Password::broker();
    }


}