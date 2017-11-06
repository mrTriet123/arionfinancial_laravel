<?php

namespace App\Http\Requests\Docunments;

use App\Http\Requests\Request;

class ContractInforRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cash_price' => 'required|numeric',
            'fname' => 'required',
            'mailling' => 'required',
            'p_phone' => 'required',
            'email' => 'required|email',
            'num_pay' => 'required',
            'fpay' => 'required|date_format:m/d/Y',
            'lname' => 'required',
            'zipcode' => 'required',
            'confirm_email' => 'required|same:email',
            'birthday' => 'required|date_format:m/d/Y',
            'init_payment' => 'numeric',
            'cost_rental' => 'required|numeric',
            'tax_rate' => 'required|numeric',
            'payment_amount' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'tax_rate.required' => 'The field required',
            'tax_rate.numeric' => 'The field must be numeric',
            'cost_rental.required' => 'The field required',
            'cost_rental.numeric' => 'The field must be numeric',
            'cash_price.required' => 'The field required',
            'cash_price.required' => 'The field required',
            'cash_price.numeric' => 'The field must be a numeric',
            'fname.required' => 'The field required',
            'mailling.required' => 'The field required',
            'p_phone.required' => 'The field required',
            'email.required' => 'The field required',
            'email.email' => 'The field must be a valid email address.',
            'num_pay.required' => 'The field required',
            'fpay.required' => 'The field required',
            'fpay.date_format' => 'The field do not match format',
            'lname.required' => 'The field required',
            'zipcode.required' => 'The field required',
            'confirm_email.required' => 'The field required',
            'confirm_email.same' => 'The confirm email not match.',
            'birthday.required' => 'The field required',
            'birthday.date_format' => 'The field do not match format',
            'init_payment.numeric' => 'The field must be a numeric',
            'payment_amount.numeric' => 'The field must be a numeric',
        ];
    }
}
