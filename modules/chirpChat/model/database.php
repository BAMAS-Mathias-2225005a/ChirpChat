<?php

namespace ChirpChat\Model;

class Database {

    private static $_instance = null;
    private string $host = 'mysql-devchirpchat.alwaysdata.net';
    private string $username = '327978_raph';
    private string $password = 'Raphael123!';
    private string $dbName = 'devchirpchat_db';
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = new \PDO('mysql:host=mysql-devchirpchat.alwaysdata.net;dbname=devchirpchat_db;charset=utf8', $this->username, $this->password)  or die(mysqli_error($this->connection));
    }

    public static function getInstance(): Database
    {
        if(is_null(self::$_instance)) self::$_instance = new Database();

        return self::$_instance;
    }

    public function connect() : void {
        $this->connection = new \PDO($this->host, $this->username, $this->password, $this->dbName) or die(mysqli_error($this->connection));
    }

    public function getConnection(){
        // TODO Reconnexion si la connexion est perdu
        //Sif(!$this->connection->) $this->connect();

        return $this->connection;
    }
}
