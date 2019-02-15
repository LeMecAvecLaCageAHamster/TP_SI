<?php

// TODO : Move it to a safer place
define('SQL_DSN', 'mysql:dbname=tpsi;host=localhost:8889');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', 'root');

class BDD extends PDO
{
 
    private static $_instance;
 
    // Constructeur : héritage public obligatoire par héritage de PDO
    public function __construct() {}
 
    //Singleton
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            try {
                self::$_instance = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
            } catch (PDOException $e) {
                echo $e;
            }
        }
        return self::$_instance;
    }
}