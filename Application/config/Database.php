<?php

class Database 
{
    // Prisijungimas 
    private $host = "localhost";
    private $dbName = "App";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function getConnection()
    {
        $this->conn = null; 

        try
        {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->username, $this->password);
            // echo "Connected";
        } catch(PDOException $e){
            echo "Connection failed: ".$e->getMessage();
        }

        return $this->conn;
    }
}
