<?php
    class ProcessOnCategory{
        public static function getCategoryInformation($category_id){

            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT * 
                        FROM Categories 
                        WHERE category_id = '$category_id'";

            $result = $connection->query($query);

            $information = $result->fetch();

            $category = new Category($information["category_id"],
                                    $information["category_name"]);

            return $category;
        }

        public static function getAllCategories(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * 
                        FROM Categories";

            $result = $connection->query($query);

            return $result;
        }
    }
?>