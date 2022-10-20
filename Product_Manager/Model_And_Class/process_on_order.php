<?php
    class ProcessOnOrder{
        public static function showOrders(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT `Order`.order_id ,
                        Users.user_id,
                        Users.name AS user_name,
                        Users.family AS user_family,
                        Users.phone AS user_phone,
                        Users.address AS user_address,
                        Products.product_id,
                        Products.name AS product_name,
                        Products.price AS product_price,
                        Products.category_id,
                        `Order`.count AS count,
                        `Order`.date AS date,
                        `Order`.status AS status
                    From `Order`
                    INNER Join Products ON
                        `Order`.`product_id` = Products.product_id
                    JOIN `Users` ON
                        Users.user_id = `Order`.`user_id`";

            $result = $connection->query($query);
            $result = $result->fetchAll();

            $orders = array();
            foreach($result as $information){
                $order = new Order($information["order_id"],
                                    $information["user_id"],
                                    $information["user_name"],
                                    $information["user_family"],
                                    $information["user_phone"],
                                    $information["user_address"],
                                    $information["product_id"],
                                    $information["product_name"],
                                    $information["product_price"],
                                    $information["category_id"],
                                    $information["count"],
                                    $information["date"],
                                    $information["status"]);
                $orders[] = $order;
            }

            return $orders;
        }

        public static function searchOrder($search_text){

            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT `Order`.order_id ,
                        Users.user_id,
                        Users.name AS user_name,
                        Users.family AS user_family,
                        Users.phone AS user_phone,
                        Users.address AS user_address,
                        Products.product_id,
                        Products.name AS product_name,
                        Products.price AS product_price,
                        Products.category_id,
                        `Order`.count AS count,
                        `Order`.date AS date,
                        `Order`.status AS status
                    From `Order`
                    INNER Join Products ON
                        `Order`.`product_id` = Products.product_id
                    JOIN `Users` ON
                        Users.user_id = `Order`.`user_id`
                    WHERE 
                        Users.user_id LIKE '%$search_text%'
                        OR
                        Users.name LIKE '%$search_text%'
                        OR
                        Users.family LIKE '%$search_text%'
                        OR
                        Products.product_id LIKE '%$search_text%'
                        OR
                        `Order`.order_id LIKE '%$search_text%'
                        OR
                        Products.name LIKE '%$search_text%'";

            $result = $connection->query($query);
            $result = $result->fetchAll();

            $orders = array();
            foreach($result as $information){
                $order = new Order($information["order_id"],
                                    $information["user_id"],
                                    $information["user_name"],
                                    $information["user_family"],
                                    $information["user_phone"],
                                    $information["user_address"],
                                    $information["product_id"],
                                    $information["product_name"],
                                    $information["product_price"],
                                    $information["category_id"],
                                    $information["count"],
                                    $information["date"],
                                    $information["status"]);
                $orders[] = $order;
            }

            return $orders;

        }
        public static function changeOrderStatus($order_status , $order_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE `Order`
                        SET status = '$order_status'
                        WHERE order_id = $order_id";
            $connection->exec($query);
        }
    }
?>