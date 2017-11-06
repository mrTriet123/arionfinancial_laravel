<?php

namespace App\Http\Requests\UserManagement\Account\Profile;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Request;
use Session;

class ProfileRequest extends Request
{
    use ThrottlesLogins;
    
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'EmailAddress'          =>  'required|email|min:8|max:35|unique:tbluser,EmailAddress,' . Session::get('UserID') . ",UserID",
            "FirstName"             =>  "required|regex:/^[A-Za-z]+$/|min:3|max:15",
            "LastName"              =>  "required|regex:/^[A-Za-z]+$/|min:1|max:20",
            'Password'              =>  'max:100|confirmed',
            'Password_confirmation' =>  'max:100|',
        ];
    }
    
    public function messages() {
        return [
            "EmailAddress.required" =>  trans("login.RequiredEmailAddress"),
            
            "FirstName.required"    =>  trans("Profile.RequiredFirstName"),
            "FirstName.min"         =>  trans("Profile.MinFirstName"),
            "FirstName.max"         =>  trans("Profile.MaxFirstName"),
            "FirstName.regex"       =>  trans("Profile.RegexFirstName"),
            
            "LastName.required"     =>  trans("Profile.RequiredLastName"),
            "LastName.min"          =>  trans("Profile.MinLastName"),
            "LastName.max"          =>  trans("Profile.MaxLastName"),
            "LastName.regex"        =>  trans("Profile.RegexLastName"),
            
        ];
    }
    
}