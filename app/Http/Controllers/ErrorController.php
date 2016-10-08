<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public $errors = [
        "0010" => "Login Failure",
        "0011" => "Login is required",
        "0012" => "No permission",
        "0013" => "Verification code not match",
        "0014" => "Not verified signup user",
        "0020" => "Key generation failed",
        "0030" => "Data type does not match",
        "0040" => "Exceeded capacity",
        "0041" => "The file is not supported",
        "0042" => "Upload Failed(communication error with contents server)",
        "0050" => "Sent mail Failure",
        "0060" => "Sign up Failure",
        "0061" => "Redundant data",
        "0062" => "Data does not exist",
        "9999" => "Unknown Error"
    ];
}
