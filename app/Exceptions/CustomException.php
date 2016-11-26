<?php

namespace App\Exceptions;

class CustomException extends \Symfony\Component\HttpKernel\Exception\HttpException
{
    public function __construct($httpCode,$customCode,\Exception $previous = null,$code = 0)
    {
        parent::__construct($httpCode, $customCode, $previous, array(), $code);
    }
}
