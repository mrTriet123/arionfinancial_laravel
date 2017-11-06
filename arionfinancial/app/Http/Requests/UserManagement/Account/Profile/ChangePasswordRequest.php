<?php

namespace App\Http\Requests\UserManagement\Account\Profile;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Request;

class ChangePasswordRequest extends Request 
{
    use ThrottlesLogins;
    
    public function wantsJson() {
        return true;
    }

    public function authorize() {
        return true;
    }

    public function rules() {
        
        
        return [
            'EmailAddress'              =>  'required',
            'Password'                  =>  'required',
            'NewPassword'               =>  'required|min:8|max:100|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed',
            "NewPassword_confirmation"  =>  'required|min:8|max:100|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/',
        ];
        
    }
    
    public function messages() {
        
        return [
            
            "EmailAddress.required"                =>  trans("login.RequiredEmailAddress"),
            "Password.required"                    =>  trans("login.RequiredPassword"),
            
            "NewPassword_confirmation.required"    =>  trans("ChangePassword.RequiredNewPasswordConfirmation"),
            "NewPassword_confirmation.min"         =>  trans("ChangePassword.MinNewPasswordConfirmation"),
            "NewPassword_confirmation.max"         =>  trans("ChangePassword.MaxNewPasswordConfirmation"),
            "NewPassword_confirmation.regex"       =>  trans("ChangePassword.RegexNewConfirmPassword"),
            
            "NewPassword.required"                 =>  trans("ChangePassword.RequiredNewPassword"),
            "NewPassword.min"                      =>  trans("ChangePassword.MinNewPassword"),
            "NewPassword.max"                      =>  trans("ChangePassword.MaxNewPassword"),
            "NewPassword.regex"                    =>  trans("ChangePassword.RegexNewPassword"),
            
        ];
        
    }
    
    public function getValidatorInstance() {
        $validator = parent::getValidatorInstance();
        $validator->after(function() use ($validator) {
            if($this["EmailAddress"] == \Auth::guard('api')->user()->UserName || $this["EmailAddress"] == \Auth::guard('api')->user()->EmailAddress) {
                $guard = \Auth::guard('web');
                $LoginResult = $guard->attempt(
                    $this->credentials($this), $this->has('remember')
                );
                if($LoginResult == null) {
                    $validator->errors()->add('Message', 
                        trans("login.InvalidLogin") . trans("auth.AttemptsPending", ["attempts" => $this->TotalLoginAttemptsLeft($this)]));
                }
            }
            else {
                $validator->errors()->add('Message', 
                        trans("login.InvalidLogin") . trans("auth.AttemptsPending", ["attempts" => $this->TotalLoginAttemptsLeft($this)]));
            }
        });
        return $validator;
    }
    
    private function credentials(Request $request)
    {
        $requestData = $request->only(
            'EmailAddress', 'Password'
        );
        
        return $requestData;
    }
}