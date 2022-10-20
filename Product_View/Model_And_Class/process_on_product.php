<?php
    class ProcessOnProduct{
        public static function getProductByCategotyId($category_id){
            $connection = ConnectToDatabase::getDatabase();

            $category = ProcessOnCategory::getCategoryInformation($category_id);

            $query = "SELECT * 
                        FROM Products
                        WHERE category_id = '$category_id'";

            $result = $connection->query($query);

            $products = array();

            foreach($result as $information){
                $product = new Product($category,
                                        $information["name"],
                                        $information["description"],
                                        $information["price"],
                                        $information["image_alt"],
                                        $information["image_path"],
                                        $information["image_1"],
                                        $information["image_2"],
                                        $information["image_3"]);
                $product->__set("id" , $information["product_id"]);

                $products[] = $product;
            }
            return $products;
        }

        public static function getProductDetail($product_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT *
                        FROM Products 
                        WHERE product_id = '$product_id'";
            $result = $connection->query($query);

            $information = $result->fetch();

            $category = ProcessOnCategory::getCategoryInformation($information["category_id"]);

            $product = new Product($category,
                                    $information["name"],
                                    $information["description"],
                                    $information["price"],
                                    $information["image_alt"],
                                    $information["image_path"],
                                    $information["image_1"],
                                    $information["image_2"],
                                    $information["image_3"]);
                $product->__set("id" , $information["product_id"]);

                return $product;
        }

        public static function productSearch($search_text){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Products
                        WHERE
                        product_id LIKE '%$search_text%' 
                        OR
                        name LIKE '%$search_text%'
                        OR
                        category_id LIKE '%$search_text%'
                        OR
                        description LIKE '%$search_text%'";

            $result = $connection->query($query);

            $products = array();

            foreach($result as $information){
                $category = ProcessOnCategory::getCategoryInformation($information["category_id"]);
                $product = new Product($category,
                                        $information["name"],
                                        $information["description"],
                                        $information["price"],
                                        $information["image_alt"],
                                        $information["image_path"],
                                        $information["image_1"],
                                        $information["image_2"],
                                        $information["image_3"]);
                $product->__set("id" , $information["product_id"]);
                $products[] = $product;
            }

            return $products;
        }
    }
?>