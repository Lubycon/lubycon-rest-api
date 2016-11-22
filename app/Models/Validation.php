<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Validation extends Model
{
    # For Valdation Rules
    # and excute validate

    public static function validater($data, $rules){
      return Validator::make($data, $rules);
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
}
