<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Abort;

class AuthSigninRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required',
            'password' => 'required',
            'snsCode' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }

    // OPTIONAL OVERRIDE
    public function forbiddenResponse()
    {
        Abort::Error('0043');
    }

    // OPTIONAL OVERRIDE
    public function response(array $errors)
    {
        Abort::Error('0052',$errors);
    }
}
