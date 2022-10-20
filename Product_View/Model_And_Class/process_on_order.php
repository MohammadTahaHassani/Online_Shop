<?php
    class ProcessOnOrder{
        public static function registerOrder($product_detail){

            $connection = ConnectToDatabase::getDatabase();

            $user_id = $product_detail->__get("user_id");
            $product_id = $product_detail->__get("product_id");
            $count = $product_detail->__get("count");

            $query = "INSERT INTO `Order`
                        (user_id , product_id , count) 
                        VALUES
                            ('$user_id' , '$product_id' , '$count')";

            $connection->exec($query);
        }

        public static function showOrders($user_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT *
                        FROM `Order`
                        INNER JOIN Products ON
                        `Order`.product_id = Products.product_id
                        WHERE user_id = $user_id";
            $result = $connection->query($query);
            $result = $result->fetchAll();
            return $result;
        }

        public static function cancelOrder($order_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE `Order` 
                SET status = 'Cancel' 
                WHERE order_id = '$order_id'";
            $connection->exec($query);
        }
    }
?>