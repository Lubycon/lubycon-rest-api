<?php
namespace App\Traits;

use App\User;

trait GetUserModelTrait{
    function getUserByToken($request){
        $token = $this->getTokenByRequest($request);
        $userId = $this->findUserIdByToken($token);
        $user = $this->getUserModel($userId);

        return $user;
    }
    function findUserIdByToken($token){
        $tokenData = (object)array(
            "device" => substr($token, 0, 1),
            "token" => substr($token, 1, 30),
            "id" => substr($token, 31),
        );

        return $tokenData->id;
    }
    function getUserModel($userId){
        $user = User::findOrFail($userId);
        return $user;
    }
    function getTokenByRequest($request){
        return $request->header('X-lubycon-token');
    }
}
?>
