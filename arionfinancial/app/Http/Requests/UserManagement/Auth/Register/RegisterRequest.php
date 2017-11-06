<?php

namespace App\Http\Requests\UserManagement\Auth\Register;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    
    use ThrottlesLogins;
    
    public function authorize() {
        return true;
    }

    public function rules() {
        
        return [
            'EmailAddress'          =>  'required|email|min:8|max:35|unique:tbluser',
            'UserName'              =>  "required|min:6|max:20|unique:tbluser",
            'Password'              =>  'required|min:8|max:100|confirmed',
            'Password_confirmation' =>  'required|min:8|max:100|',
        ];
    }
    
    public function messages() {
        return [
            "EmailAddress.required"             =>  trans("register.RequiredEmailAddress"),
            "EmailAddress.min"                  =>  trans("register.MinEmailAddress"),
            "EmailAddress.max"                  =>  trans("register.MaxEmailAddress"),
            "EmailAddress.unique"               =>  trans("register.UniqueEmailAddress"),
            "EmailAddress.email"                =>  trans("register.InvalidEmailAddress"),
            
            "UserName.required"                 =>  trans("register.RequiredUserName"),
            "UserName.min"                      =>  trans("register.MinUserName"),
            "UserName.max"                      =>  trans("register.MaxUserName"),
            "UserName.unique"                   =>  trans("register.UniqueUserName"),
            
            "Password_confirmation.required"    =>  trans("register.RequiredPasswordConfirmation"),
            "Password_confirmation.min"         =>  trans("register.MinPasswordConfirmation"),
            "Password_confirmation.max"         =>  trans("register.MaxPasswordConfirmation"),
            "Password_confirmation.regex"       =>  trans("register.RegexConfirmPassword"),
            
            "Password.required"                 =>  trans("login.RequiredPassword"),
            "Password.min"                      =>  trans("register.MinPassword"),
            "Password.max"                      =>  trans("register.MaxPassword"),
            "Password.regex"                    =>  trans("register.RegexPassword"),
        ];
    }
}