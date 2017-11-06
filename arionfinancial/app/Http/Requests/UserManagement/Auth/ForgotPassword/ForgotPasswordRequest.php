<?php

namespace App\Http\Requests\UserManagement\Auth\ForgotPassword;
use App\Http\Requests\Request;

class ForgotPasswordRequest extends Request
{
    
    public function authorize() {
        return true;
    }

    public function rules() {
        
        return [
            'EmailAddress'  => 'required|email',
        ];
    }
    
    public function messages() {
        return [
            "EmailAddress.required" =>  trans("forgotpassword.RequiredEmailAddress"),
            "EmailAddress.email"    =>  trans("forgotpassword.InvalidEmailAddress"),
        ];
    }
    
}