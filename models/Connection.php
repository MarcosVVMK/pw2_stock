<?php



class Connection {

    private static $connection = null;
    private static $host =  "devilbox-mysql-1"; ##"10.5.10.10";
    private static $user = "root"; ##"desenv";
    private static $password = "";##"123456";
    private static $database = "pw2_2024_marcos_matos";
    private static $port = "3306";

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {


        if(self::$connection == null){
            try{

                self::$connection = new PDO("mysql:host=".self::$host.";port=".self::$port.";dbname=". self::$database, self::$user, self::$password);

            }catch (PDOException $e) {

                die("Erro ao conectar no banco de dados: " . $e->getMessage());

            }
        }

        return self::$connection;
    }

}
