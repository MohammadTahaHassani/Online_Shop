<?php
    class Database{
        private static $host_name = "localhost";
        private static $database = "Shop";
        protected static $username = "root";
        protected static $password = "";
        protected static $connection;

        protected static function getDatabaseSourceName(){
            $data_source_name = "mysql:host=".self::$host_name.";dbname=".self::$database;
            return $data_source_name;
        }
    }
    class ConnectToDatabase extends Database{
        public static function getDatabase(){
            if(!isset(self::$connection)){
                try{
                    self::$connection = new PDO(self::getDatabaseSourceName() , 
                                                self::$username , 
                                                self::$password);
                }catch (PDOException $e){
                    $error_message = $e->getMessage();
                    include("../View/error_logs.php");
                    exit;
                }
            }
            return self::$connection;
        }
    }
?>