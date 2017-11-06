<?php

namespace App\Http\Requests\UserManagement\Auth\Register\AccountActivation;
use App\Http\Requests\Request;

class AccountActivationRequest extends Request
{
    
    public function authorize() {
        return true;
    }

    public function rules() {
        
        return [
            'EmailAddress' =>  'required',
            'Password'     =>  'required',
            'token'        =>  'required'
        ];
    }
    
    public function messages() {
        return [
            "EmailAddress.required"             =>  trans("register.RequiredEmailAddress"),
            "Password.required"                 =>  trans("register.RequiredPassword"),
            "token.required"                    =>  trans("resetpassword.RequiredToken"),
        ];
    }
    
    protected function getValidatorInstance()
    {   
        return parent::getValidatorInstance()->after(function($validator){
            // Call the after method of the FormRequest (see below)
            $this->after($validator);
        });
    }
    
    public function after($validator)
    {
        if(!$this->guard()->attempt(
            $this->credentials($this), $this->has('remember')
        )) {
            $validator->errors()->add('EmailAddress', 'Invalid credentials!'); 
        }
    }
    
    protected function credentials(Request $request)
    {
        $Data = $request->only("EmailAddress", 'Password');
        return $Data;
    }
    
    protected function guard()
    {
        return \Auth::guard();
    }
    
}