<?php
    class Database{
        private static $host = "localhost";
        private static $database_name = "Shop";
        protected static $username = "root";
        protected static $password = "";
        protected static $connection;

        protected static function getDatabaseSourceName(){
            $database_source_name = "mysql:host=".self::$host.";dbname=".self::$database_name;
            return $database_source_name;
        }
    }
    class ConnectToDatabase extends Database{

        public static function getDatabase(){
            if(!isset(self::$connection)){
                try{
                    self::$connection = new PDO(self::getDatabaseSourceName() , 
                                                self::$username , 
                                                self::$password);
                }catch(PDOException $except) {
                    $error_message = $except->getMessage();
                    include("../View/error_logs.php");
                    exit;
                }
            }
            return self::$connection;
        }
    }
?>