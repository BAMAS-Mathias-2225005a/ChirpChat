<?php

namespace Chirpchat\Model;

class Database {

    private static $_instance = null;
    private $dbAccess;
    private string $host = 'mysql-devchirpchat.alwaysdata.net';
    private string $username = '327978_raph';
    private string $password = 'Raphael123!';
    private string $dbName = 'devchirpchat_db';
    private \PDO $connection;

    public function __construct()
    {
        $this->dbAccess = parse_ini_file('_assets\cred\db.ini');
        $this->connection = new \PDO($this->dbAccess['dsn'], $this->dbAccess['username'], $this->dbAccess['password'])  or die(mysqli_error($this->connection));
    }

    public static function getInstance(): Database
    {
        if(is_null(self::$_instance)) self::$_instance = new Database();

        return self::$_instance;
    }

    public function connect() : void {
        $this->connection = new \PDO($this->dbAccess['dsn'], $this->dbAccess['username'], $this->dbAccess['password']) or die(mysqli_error($this->connection));
    }

    public function getConnection(){
        // TODO Reconnexion si la connexion est perdu
        //Sif(!$this->connection->) $this->connect();

        return $this->connection;
    }
}
