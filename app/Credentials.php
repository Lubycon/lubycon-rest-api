<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credentials extends Model
{
    protected function signin($data){

      $credentials = [
          'email'    => $data['email'],
          'password' => $data['password']
      ];

      return $credentials;
    }

    protected function signup($data){

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
