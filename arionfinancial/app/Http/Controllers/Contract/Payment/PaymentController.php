<?php

namespace App\Http\Controllers\Contract\Payment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contract\Payment\PaymentRequest;
use App\Models\Contract\ContractModel;
use App\Architecture\Enum\Role\RoleEnum;
use App\Models\Contract\Payment\Source\PaymentSourceModel;
use App\Models\Contract\Payment\PaymentModel;
use App\Models\User\UserModel;
use Session;

class PaymentController extends Controller
{
    
    public function __construct() {

    }
    
    public function Payments($ContractID) {

        $id = session::get('RoleID');
        $User = UserModel::where('UserID', $id)->first();
        $Contract = ContractModel::where("ContractID", $ContractID)->first();
        
        $formula = [
            'DPR'   =>  $Contract->APR/365,
            
        ];
        
        $Payments = $Contract->Payments;
        return View("Contracts.Payments.List", [
            'Payments'  =>  $Payments, 
            "Customer"  =>  $Contract->Customer, 
            "Contract"  =>  $Contract,
            "Formula"   =>  $formula,
            'User' => $User
        ]);
    }
    
    public function deletePayments($id){
        $model = PaymentModel::where("PaymentID", $id)->first();

        $model->delete();
        return back();
    }
    public function Payment($PaymentID) {
        $Payment = PaymentModel
                ::where('PaymentID', $PaymentID)
                ->first();
     
        $PaymentSources = PaymentSourceModel::all();
        
        return View("Contracts.Payments.Edit", ['Payment' => $Payment, "PaymentSources" => $PaymentSources]);
    }
    
    public function AddPayment($ContractID) {
        
        
        $Contract = ContractModel::where("ContractID", $ContractID)->first();
        
        
        $PaymentSources = PaymentSourceModel::all();
        
        return View("Contracts.Payments.Add", ["Contract" => $Contract, "PaymentSources" => $PaymentSources]);
    }
    
    public function EditPayment(PaymentRequest $request) {
   
        
        $Contract = ContractModel::where("ContractID", $request["ContractID"])->first();
        
       
        $Payment = PaymentModel
                    ::where("PaymentID", $request["PaymentID"])
                    ->first();
       
        $time = strtotime($request["PaymentDate"]);
        $PaymentDateformat = date('Y-m-d', $time);
        
        if($Payment != null) {
            $Payment->PaymentSourceID   =   $request["PaymentSourceID"];
            $Payment->PaymentAmount     =   $request["PaymentAmount"];
            $Payment->PaymentDate       =   $PaymentDateformat;
            $Payment->ContractID        =   $request["ContractID"];
            $Payment->save();
            return redirect()->route("Payments", ["ContractID" => $request["ContractID"]]);
        }
    }
    
    public function SavePayment(PaymentRequest $request) {

        
        $Contract = ContractModel::where("ContractID", $request["ContractID"])->first();
        
        $time = strtotime($request["PaymentDate"]);
        $PaymentDateformat = date('Y-m-d', $time);
        
        $Payment = new PaymentModel();
        $Payment->PaymentSourceID   =   $request["PaymentSourceID"];
        $Payment->PaymentAmount     =   $request["PaymentAmount"];
        $Payment->PaymentDate       =   $request['PaymentDate'];
        $Payment->ContractID        =   $request["ContractID"];
        $Payment->save();
        
        return redirect()->route("Payments", ["ContractID" => $request["ContractID"]]);
    }
    
    public function AccountDelete($id) {
        $Payment = AccountsModel
                ::where('AccountID', $id)
                ->first();
        
        switch (\Auth::user()->RoleID) {
            case RoleEnum::Dealer:
                if($Payment->UserID != \Auth::user()->UserID) {
                    abort(404);
                }
            case RoleEnum::Customer:
                abort(404);
        }
        
        if($Payment != null) {
            $Payment->delete();
            return redirect()->route("Accounts");
        }
    }
}