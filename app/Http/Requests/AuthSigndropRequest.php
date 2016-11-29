<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\User;

class AuthSignupRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $requiredRule = [
            'reasonCode' => 'required',
            'reason' => 'max:255'
        ];

        return $requiredRule;
    }
}
