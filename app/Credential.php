<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\Job;

class Credential extends Model
{
    protected static function signIn($data){

      $credential = [
          'email'    => $data['email'],
          'password' => $data['password']
      ];

      return $credential;
    }

    protected static function signUp($data){

      $credential = [
          'name' => $data['nickname'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'sns_code' => 0,
          'country_id' => Country::where('name','=',$data['country'])->value('id'),
          'is_active' => 'inactive',
          'is_accept_terms' => '111',
          //'is_accept_terms' => $data['newletter'].'11',
      ];

      return $credential;

    }
}
