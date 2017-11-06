<?php

namespace App\Http\Requests\UserManagement\Auth\Login;

use App\Http\Requests\Request;

class LoginRequest extends Request
{
    
    public function authorize() {
        return true;
    }

    public function rules() {

        return [
            'EmailAddress' =>  'required',
            'Password'     =>  'required',
        ];
    }
    
    public function messages() {
        return [
            "EmailAddress.required" =>  "Please enter email Address",
            "Password.required"     =>  "Please enter password",
        ];
    }
    
}