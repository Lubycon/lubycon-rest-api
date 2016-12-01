<?php

namespace App\Http\Requests\Comment;

use App\Http\Requests\Request;
use Log;

class CommentUploadRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $requiredRule = [
            'content' => 'required'
        ];

        return $requiredRule;
    }
}
