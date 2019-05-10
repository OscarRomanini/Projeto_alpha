<?php

class Sql extends PDO
{
    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host = 127.0.0.1;dbname=alpha","homestead", "secret");
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->connection->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array())
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    private function setParams($statement, $params = array())
    {
        foreach ($params as $key => $value){
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statment, $key, $value)
    {
        $statment->bindParam($key, $value);
    }

}