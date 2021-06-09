<?php

namespace App\Http\Controllers;
use App\Database\Models\User;
class UserController
{
    public function get($id=null){
        if($id){
            return User::getUser($id);
        }
        else{
            return User::getAllUsers();
        }
    }

    public function post(){
        $data = $this->getJson();
        if($data === null){

            $data = $_POST;
        }
        return User::insertUser($data);
    }

    public function put($id){
        $data = $this->getJson();
        if($data===null){
            $data = $_POST;
        }
        return User::updateUser($id, $data);
    }

    public function delete($id){
        return User::deleteUser($id);
    }

    private function getJson()
    {
        $rawData = file_get_contents("php://input");

        // this returns null if
        // not valid json
        return json_decode($rawData,1);
    }
}
