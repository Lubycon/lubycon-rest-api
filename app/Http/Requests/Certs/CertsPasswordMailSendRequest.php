<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class CertsPasswordMailSendRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $requiredRule = [
            'email' => 'email|required'
        ];
        return $requiredRule;
    }
}
