<?php

class dbConfig
{
    protected $pdo = null;
    public static function connect()
    {
        //Enter your database connection details here.
        $host = 'localhost'; //HOST NAME.
        $db_name = 'lb_product_manage'; //Database Name
        $db_username = 'root'; //Database Username
        $db_password = ''; //Database Password


        try {
            $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $db_username, $db_password);
        } catch (PDOException $e) {
            exit('Error Connecting To DataBase');
        }
        return $pdo;
    }
}
?>