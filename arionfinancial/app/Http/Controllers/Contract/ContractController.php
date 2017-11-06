<?php

namespace App\Http\Controllers\Contract;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contract\ContractRequest;
use App\Models\Contract\ContractModel;
use App\Architecture\Enum\Role\RoleEnum;
use App\Models\User\UserModel;
use Session;
use DB;
use Mail;

class ContractController extends Controller
{
    
    public function __construct() {
        $ID = Session::get('UserID');
        $data = DB::table('tbluser')->where('UserID', $ID)->first();
        View::share('User', $data);

    }
    
    public function Contracts($CustomerID) { 
        $Customer = UserModel::where("UserID", $CustomerID)->first();
        $Contracts = ContractModel::with('Customer')->where("CustomerID", $CustomerID)->get();
        return View("Contracts.List", ['Contracts' => $Contracts, "Customer" => $Customer]);
    }
    
    public function Contract($ContractID) {
        
  
        
        $Contract = ContractModel
                ::where('ContractID', $ContractID)
                ->first();

                $Users = UserModel::where("WhoCreated", Session::get('UserID'))->get();
 
        
        return View("Contracts.Edit", ['Contract' => $Contract, "Users" => $Users]);
    }
    
    public function AddContract($CustomerID) {

        $UserID = Session::get('UserID');
        $customers = DB::table('tbluser')->where('WhoCreated',$UserID)->get();
        return View("Contracts.Add",  ['contractType' => 'leasing'])->with('customers',$customers);
    }
    public function addLeasing($CustomerID) {

        $UserID = Session::get('UserID');
        $customers = DB::table('tbluser')->where('WhoCreated',$UserID)->get();
        return View("Contracts.Add", ['contractType' => 'leasing'])->with('customers',$customers);
    }
    public function addFinancing($CustomerID) {

        $UserID = Session::get('UserID');
        $customers = DB::table('tbluser')->where('WhoCreated',$UserID)->get();
        return View("Contracts.Add", ['contractType' => 'financing'])->with('customers',$customers);
    }
    
    public function EditContract(ContractRequest $request) {
        $Contract = ContractModel
                    ::where("ContractID", $request["ContractID"])
                    ->first();

        $time = strtotime($request["DateofContract"]);
        $DateofContractformat = date('Y-m-d', $time);
        
        $time = strtotime($request["PaymentDueDate"]);
        $PaymentDueDateformat = date('Y-m-d', $time);
        
        if($Contract != null) {
            $Contract->Name              =   $request["Name"];
            $Contract->Address           =   $request["Address"];
            $Contract->FinanceAmount     =   $request["FinanceAmount"];
            $Contract->TimeFrame         =   $request["TimeFrame"];
            $Contract->APR               =   $request["APR"];
            $Contract->LateFees          =   $request["LateFees"];
            $Contract->DateofContract    =   $DateofContractformat;
            $Contract->MonthlyPayment    =   $request["MonthlyPayment"];
            $Contract->PaymentDueDate    =   $PaymentDueDateformat;
            $Contract->CustomerID        =   $request["CustomerID"];
            $Contract->save();
            return redirect()->route("Contracts", ["Customer" => $request["CustomerID"]]);
        }
    }
    
    public function SaveContract(ContractRequest $request) {
        
        $time = strtotime($request["DateofContract"]);
        $DateofContractformat = date('Y-m-d', $time);
        
        $time = strtotime($request["PaymentDueDate"]);
        $PaymentDueDateformat = date('Y-m-d', $time);
        
        $UserID = Session::get('UserID');
        $Contract = new ContractModel();
        $Contract->Name              =   $request["Name"];
        $Contract->Address           =   $request["Address"];
        $Contract->FinanceAmount     =   $request["FinanceAmount"];
        $Contract->TimeFrame         =   $request["TimeFrame"];
        $Contract->APR               =   $request["APR"];
        $Contract->DealerID          =   $UserID;
        $Contract->type              =   $request->type;

        $Contract->DateofContract    =   $DateofContractformat;
        $Contract->LateFees          =   $request["LateFees"];
        $Contract->MonthlyPayment    =   $request["MonthlyPayment"];
        $Contract->PaymentDueDate    =   $PaymentDueDateformat;
        $Contract->CustomerID        =   $request["CustomerID"];
        
        $Contract->save();
        
        return redirect()->route("add".$request->type, ["CustomerID" => $request["CustomerID"]]);
    }
    
    public function AccountDelete($id) {
        if(RoleEnum::Customer == \Auth::user()->RoleID || RoleEnum::Admin == \Auth::user()->RoleID) {
            abort(404);
        }
        
        $Contract = AccountsModel
                ::where('AccountID', $id)
                ->first();
        
        switch (\Auth::user()->RoleID) {
            case RoleEnum::Dealer:
                if($Contract->UserID != \Auth::user()->UserID) {
                    abort(404);
                }
            case RoleEnum::Customer:
                abort(404);
        }
        
        if($Contract != null) {
            $Contract->delete();
            return redirect()->route("Accounts");
        }
    }
    
    public function DownloadContract() 
    {
      if($_POST['check'] == "account")
      {
            $content = '<table width="680" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="background: #ffffff;  margin-left:-40px;">
        <tr>
            <td style="border-bottom:#0D565C 2px solid;"><h1>Arion Finacial</h1></td>
        </tr>
        <tr>
            <td style="padding: 20px;">
            <table width="640" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="background: #ffffff;">
            <tr>
                <td style = "width:10px;"> '.$_POST['value'].' </td>
            </tr>
            </table>
            </td>
        </tr>   
        </table>
        <div style="border-top:#0D565C 1px solid; padding-top: 5px; text-align: center; position: absolute; bottom: 5px; width: 100%"><span style="color: #555">Arion Finacial Inc. | Email: email@arionfinancial.com</span></div>';


       $pdf = \PDF::loadHtml($content);
       return $pdf->download('Contract_' . date('Y-m-d') . '_' . time() . '.pdf'); 
       $pdf = \PDF::loadHtml($_POST['value']);
       return $pdf->download('Contract_' . date('Y-m-d') . '_' . time() . '.pdf');
       }
       else
       {
        $send_email = $_POST['email'];
        if($send_email == "")
        {
            return Redirect()->back();
        }
         Mail::send('emails.check',['HTML'=>$_POST['value2']], function ($message) use ($send_email)
             {
            
              $message->from('email@arionfinancial.com', 'Arion Financial');
              $message->subject('Requested Document');
              $message->to($send_email);
               
             });

             return Redirect()->back(); 
       }     
    }


     public function EmailContract($ContractID) {
        
        

       
        $Contract = ContractModel
                    ::where("ContractID", $ContractID)
                    ->first();
        
        
        $pdf = \PDF::loadView('Contracts.DownloadContract', ["edde" => 123]);
        return $pdf->download('Contract_' . $Contract->ContractID . '_' . $Contract->Customer->UserName . '.pdf');
    }
}