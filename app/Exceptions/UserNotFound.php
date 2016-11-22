<?php

namespace App\Exceptions;
class UserNotFound extends CustomException
{
    public function __construct()
    {
        $message = $this->create(func_get_args());
        parent::__construct($message);
    }
}
