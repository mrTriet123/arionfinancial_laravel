<?php

namespace App\Http\Requests\Contract\Payment;

use App\Http\Requests\Request;

class PaymentRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'PaymentAmount'     =>  'numeric',
            'PaymentDate'       =>  'date',
            'ContractID'        =>  'required|numeric|min:1',
            'PaymentSourceID'   =>  'required|numeric|min:1',
        ];
    }
}