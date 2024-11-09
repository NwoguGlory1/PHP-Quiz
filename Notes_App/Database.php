<?php

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {  
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        //$this assigns the PDO statement returned by query to $statement
        $this->statement->execute($params);
    
        return $this; //refers to the current instance of Database
    }

    public function find()
    {
        return $this->statement->fetch(); // Fetch a single result as an object
    }


    public function findAll()
    {
        return $this->statement->fetchAll();
    }

    public function findorFail()
    {
        $result = $this-> find();

        if (! $result) {
            abort();
        }
        return $result;
    }  
}
