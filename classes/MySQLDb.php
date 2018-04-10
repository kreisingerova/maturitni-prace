<?php

class MySQLDb
{
    const DB_SERVER = 'localhost';
    const DB_NAME = 'mp';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    private $con;
    private static $instance;
    
    private function __construct(){
       
    }
    
    public static function queryString($queryString) {
        $result = self::getInstance()->getConnection()->query($queryString);
        return $result;
    }
    private function connect() {
      $this->con = @mysqli_connect(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
       
      mysqli_set_charset($this->con , "utf8");
      
        if (!$this->con) {
            echo "Error: " . mysqli_connect_error();
            exit();
        }
        //echo 'Connected to MySQL';
   
    }
    private static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new MySQLDb();
            self::$instance->connect();
        }
        return self::$instance;
    }
    private function getConnection() {
        return $this->con;
    }
}

