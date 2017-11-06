<?php

namespace App\Http\Requests\Contract;

use App\Http\Requests\Request;

class ContractRequest extends Request
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'Name'           => "max:25",
            "Address"        => "max:50",
            "FinanceAmount"  => "numeric",
            'TimeFrame'      => 'max:100',
            'APR'            => 'numeric',
            'DateofContract' => 'date',
            'MonthlyPayment' => 'numeric',
            'PaymentDueDate' => 'date',
            'CustomerID'     => 'required|numeric|min:1',
            "LateFees"       => 'numeric',
        ];
    }
}