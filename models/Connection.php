<?php



class Connection {

    private static $connection = null;
    private static $host =  "127.0.0.1"; ##"10.5.10.10";
    private static $user = "root"; ##"desenv";
    private static $password = "root";##"123456";
    private static $database = "pw2_2024_stock";
    private static $port = "3306";

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
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
