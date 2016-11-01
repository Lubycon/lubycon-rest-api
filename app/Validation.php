<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Validation extends Model
{
    # For Valdation Rules
    # and excute validate

    protected function validate($data, $rules){
      return Validator::make($data, $rules);
    }

    # for app/Http/Controller/Auth/AuthController.php file
    public function auth($data){
      $rules = [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6',
          //'password' => 'required|confirmed|min:6',
      ];
      return $this->validate($data, $rules);
    }
}
