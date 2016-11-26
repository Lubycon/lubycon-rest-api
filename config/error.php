<?php
return [
    // custom error exception
    "0010" => (object)array(
        "httpCode" => 403,
        "customCode" => "0010",
        "msg" => "Login Failure"
    ),
    "0011" => (object)array(
        "httpCode" => 403,
        "customCode" => "0011",
        "msg" => "Login is required"
    ),
    "0012" => (object)array(
        "httpCode" => 403,
        "customCode" => "0012",
        "msg" => "No permission"
    ),
    "0013" => (object)array(
        "httpCode" => 403,
        "customCode" => "0013",
        "msg" => "Verification code not match"
    ),
    "0014" => (object)array(
        "httpCode" => 403,
        "customCode" => "0014",
        "msg" => "Not verified signup user"
    ),
    "0015" => (object)array(
        "httpCode" => 422,
        "customCode" => "0015",
        "msg" => "Data Validation Fail"
    ),
    "0020" => (object)array(
        "httpCode" => 403,
        "customCode" => "0020",
        "msg" => "Key generation failed"
    ),
    "0030" => (object)array(
        "httpCode" => 403,
        "customCode" => "0030",
        "msg" => "Data type does not match"
    ),
    "0040" => (object)array(
        "httpCode" => 403,
        "customCode" => "0040",
        "msg" => "Exceeded capacity"
    ),
    "0041" => (object)array(
        "httpCode" => 403,
        "customCode" => "0041",
        "msg" => "The file is not supported"
    ),
    "0042" => (object)array(
        "httpCode" => 403,
        "customCode" => "0042",
        "msg" => "Upload Failed(communication error with contents server)"
    ),
    "0050" => (object)array(
        "httpCode" => 403,
        "customCode" => "0050",
        "msg" => "Sent mail Failure"
    ),
    "0060" => (object)array(
        "httpCode" => 403,
        "customCode" => "0060",
        "msg" => "Sign up Failure"
    ),
    "0061" => (object)array(
        "httpCode" => 403,
        "customCode" => "0061",
        "msg" => "Redundant data"
    ),
    "0062" => (object)array(
        "httpCode" => 403,
        "customCode" => "0062",
        "msg" => "Data does not exist"
    ),

    // natural http exception
    "0070" => (object)array(
        "httpCode" => 403,
        "customCode" => "0070",
        "msg" => "Not Found Http Exception"
    ),
    "0071" => (object)array(
        "httpCode" => 403,
        "customCode" => "0071",
        "msg" => "Conflict Http Exception"
    ),
    "0072" => (object)array(
        "httpCode" => 403,
        "customCode" => "0072",
        "msg" => "Bad Request Http Exception"
    ),
    "0073" => (object)array(
        "httpCode" => 403,
        "customCode" => "0073",
        "msg" => "Fatal Error, Call Backend Engineer"
    ),
    "0074" => (object)array(
        "httpCode" => 403,
        "customCode" => "0074",
        "msg" => "Method Not Found Http Exception"
    ),
    "0075" => (object)array(
        "httpCode" => 403,
        "customCode" => "0075",
        "msg" => "Service Unavailable Http Exception"
    ),
    "0076" => (object)array(
        "httpCode" => 403,
        "customCode" => "0076",
        "msg" => "Too Many Requests Http Exception"
    ),
    "0077" => (object)array(
        "httpCode" => 403,
        "customCode" => "0077",
        "msg" => "Unauthorized Http Exception"
    ),
    "9999" => (object)array(
        "httpCode" => 403,
        "customCode" => "9999",
        "msg" => "Unknown Error"
    ),
];
