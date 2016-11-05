<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected function signIn($data){

      $credentials = [
          'email'    => $data['email'],
          'password' => $data['password']
      ];

      return $credentials;
    }

    protected function signUp($data){

      $credentials = [
          'name' => $data['nickname'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'sns_code' => 0,
          'country' => $this->countryDataEncode($data['country']),
          'is_active' => 'inactive',
          'is_accept_terms' => '111',
          //'is_accept_terms' => $data['newletter'].'11',
      ];

      return $credentials;

    }
}
