<?php

namespace App\Database;
use \PDO;
use \PDOException;

class Database{


    const HOST = '127.0.0.1';
    const NAME = 'simple_api';
    const USER = 'root';
    const PASS = 'secret';


    //nome da tabela a ser enviada
    private $table;

    //instancia de conexão
    private $connection;


    /**
     * @return mixed
     */
    public function __construct($table){
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            die('ERROR '.$e->getMessage());
        }
    }

    /**
     * Seleciona dados no banco
     * @param $where
     */
    public function select($where, $fields = '*'){
        $where =  strlen($where) ? ' WHERE '. $where : '';

        $query = 'SELECT ' . $fields . ' FROM '.$this->table . $where;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function insert($data){
        $values = array_values($data);
        $fields=array_keys($data);
        $fields = implode(',', $fields);
        $query = 'INSERT INTO '.$this->table .' ('.$fields.') VALUES (:name, :email, :password)';
        $stmt = $this->connection->prepare($query);
        $stmt->execute($data);

        return $stmt;
    }

    public function update($where, $data){

        $where = 'WHERE '.$where;
        $query = 'UPDATE '.$this->table. ' SET name=:name, email=:email, password=:password '.$where;
        //var_dump($query);
        $stmt = $this->connection->prepare($query);
        $stmt->execute($data);
        return $stmt;
    }

    public function delete($where){
        $where = 'WHERE '.$where;
        $query = 'DELETE FROM '.$this->table.' '.$where;
        var_dump($query);

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }


}
