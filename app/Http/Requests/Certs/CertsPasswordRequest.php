<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class CertsPasswordRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $requiredRule = [
            'password' => 'required'
        ];
        return $requiredRule;
    }
}
