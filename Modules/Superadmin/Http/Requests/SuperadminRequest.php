<?php

namespace Modules\Superadmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class SuperadminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        $route_name = \Request::route()->getName();

        if($route_name == 'superadmin-create-post')
        {
            $rules = [
                        'name' => ['required'],
                        'email' => ['required','email'],
                        'password' => ['required','min:3'],
                        'temporary_address' => ['required'],
                        'contact' => ['required'],
                        
                     ];

        }

        if($route_name == 'superadmin-login-post')
        {
            $rules = [                        
                        'email' => ['required','email'],
                        'password' => ['required','min:3'],
                                            
                     ];

        }


        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    

   
}
