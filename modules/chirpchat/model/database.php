<?php

namespace Chirpchat\Model;
require_once 'dbCredentials.php';
class Database {

    private static $_instance = null;
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = new \PDO('mysql:host='.HOST.';dbname='.DBNAME, USERNAME, PASSWORD)  or die(mysqli_error($this->connection));
    }

    public static function getInstance(): Database
    {
        if(is_null(self::$_instance)) self::$_instance = new Database();

        return self::$_instance;
    }

    public function connect() : void {
        $this->connection = new \PDO(HOST, USERNAME, PASSWORD, DBNAME) or die(mysqli_error($this->connection));
    }

    public function getConnection(){
        // TODO Reconnexion si la connexion est perdu
        //Sif(!$this->connection->) $this->connect();

        return $this->connection;
    }
}
