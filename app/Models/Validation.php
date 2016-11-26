<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Validation extends Model
{
    # For Valdation Rules
    # and excute validate

    public static function validater($data, $rules){
      $result = Validator::make($data, $rules);
      if($result->fails()){
        return response()->error([
            "code" => "0030",
            "devMsg" => $result->errors()
        ]);
      }
      return $result;
    }

    # for app/Http/Controller/Auth/AuthController.php file
    public static function auth($data){
      $rules = [
          'name' => 'required|max:255|unique:users',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6',
      ];
      return Validation::validater($data, $rules);
    }

    public static function upload($data){
      $rules = [
          'bucket'    =>    'required',
          'acl'       =>    'required',
          'path'      =>    'required',
          'files'      =>    'required | array',
      ];

      return Validation::validater($data, $rules);
    }

    public static function json($data){
      $rules = [
        'data'    =>    'required | json',
      ];

      return Validation::validater($data, $rules);
    }
}
