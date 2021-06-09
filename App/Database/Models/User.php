<?php

namespace App\Database\Models;
use PDO;
use App\Database\Database;

class User
{
    private static $table = 'users';


    public static function getUser($id){
        $id = 'id='.$id;
        $result =  (new Database(self::$table))->select($id);
        if($result->rowCount() > 0){
           return $result->fetch(\PDO::FETCH_ASSOC);

       }
    }

    public static function getAllUsers(){
        $result =(new Database(self::$table))->select(null);
        if($result->rowCount()>0){
            return $result->fetchAll(PDO::FETCH_ASSOC);

        }
    }


    public static function insertUser($data){
        $result = (new Database(self::$table))->insert($data);
        if($result->rowCount()>0){
            return 'Usuário inserido com sucesso';
        }

    }

    public static function updateUser($id, $data){
        $id = 'id='.$id;
        $result = (new Database(self::$table))->update($id, $data);
        if($result->rowCount()>0){
            return 'Usuário atualizado com sucesso';
        }

    }

    public static function deleteUser($id){
        $id = 'id= '.$id;
        $result = (new Database(self::$table))->delete($id);
        if($result->rowCount()>0){
            return 'Usuário removido com sucesso';
        }
    }
}
