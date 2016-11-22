<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Job;

use Log;

class Credential extends Model
{
    protected static function signin($data){

      $credential = [
          'email'    => $data['email'],
          'password' => $data['password']
      ];

      return $credential;
    }

    protected static function signup($data){

      $credential = [
          'name' => $data['nickname'],
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
          'sns_code' => $data['snsCode'],
          'country_id' => Country::where('name','=',$data['country'])->value('id'),
          'status' => 'inactive',
          'newsletter' => $data['newsletter']
      ];
      return $credential;

    }
}
