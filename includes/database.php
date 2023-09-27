<?php

namespace Includes;

class DatabaseConnection {

    private static DatabaseConnection $_instance;
    private string $host = 'mysql-devchirpchat.alwaysdata.net';
    private string $username = '327978_raph';
    private string $password = 'Raphael123!';
    private string $dbName = 'devchirpchat_db';
    private string $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db)  or die(mysqli_error($this->connection));
    }

    public static function getInstance(): DatabaseConnection
    {
        if(is_null(self::$_instance)) self::$_instance = new DatabaseConnection();

        return self::$_instance;
    }

    public function connect() : void {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbName) or die(mysqli_error($this->connection));
    }

    public function query($requete) {
        // Requête
        $result = mysqli_query($this->connection, $requete);
        if(!$result){
            return mysqli_error($this->connection);
        } else {
            return $result;
        }
    }

    public function getConnection(){
        // Reconnexion si la connexion est perdu
        if(!$this->connection->ping()) $this->connect();

        return $this->connection;
    }
}
