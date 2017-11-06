<?php

namespace App\Http\Requests\UserManagement\Auth\ForgotPassword\ResetPassword;
use App\Http\Requests\Request;

class ResetPasswordRequest extends Request
{
    
    public function authorize() {
        return true;
    }

    public function rules() {
        
        return [
            'EmailAddress'          =>  'required',
            'Password'              =>  'required|min:8|max:100|confirmed',
            'Password_confirmation' =>  'required|min:8|max:100',
            'token'                 =>  'required'
        ];
    }
    
    public function messages() {
        return [
            "Password.required"                 =>  trans("register.RequiredPassword"),
            "Password.min"                      =>  trans("register.MinPassword"),
            "Password.max"                      =>  trans("register.MaxPassword"),
            "Password.regex"                    =>  trans("register.RegexPassword"),
            
            "Password_confirmation.required"    =>  trans("register.RequiredPasswordConfirmation"),
            "Password_confirmation.min"         =>  trans("register.MinPasswordConfirmation"),
            "Password_confirmation.max"         =>  trans("register.MaxPasswordConfirmation"),
            "Password_confirmation.regex"       =>  trans("register.RegexConfirmPassword"),
            
            "EmailAddress.required"             =>  trans("register.RequiredEmailAddress"),
            
            "token.required"                    =>  trans("resetpassword.RequiredToken"),
        ];
    }
}