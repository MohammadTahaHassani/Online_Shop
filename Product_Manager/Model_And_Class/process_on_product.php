<?php
    class ProcessOnProduct{
        public static function getProductByCategory($category_id){
            $connection = ConnectToDatabase::getDatabase();

            $category = ProcessOnCategoy::getCategoryInformation($category_id);

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
                $product->__set("last_edit" , $information["last_edit"]);

                $products[] = $product;
            }
            return $products;
        }

        public static function getProduct($product_id){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT *
                        FROM Products
                        WHERE product_id = '$product_id'";

            $result = $connection->query($query);
            $information = $result->fetch();

            $category =  ProcessOnCategoy::getCategoryInformation($information["category_id"]);

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

        public static function addNewProduct($product){
            $connection = ConnectToDatabase::getDatabase();

            $category_id = $product->__get("category")->__get("id");
            $name = $product->__get("name");
            $description = $product->__get("description");
            $price = $product->__get("price");
            $image_alt = $product->__get("image_alt");
            $main_image_path = $product->__get("image_path");
            $image_1_path = $product->__get("image_1");
            $image_2_path = $product->__get("image_2");
            $image_3_path = $product->__get("image_3");

            $query = "
                    INSERT INTO Products(category_id , name , description , price , image_alt , image_path , image_1 , image_2 , image_3) 
                    VALUES
                        ('$category_id' , 
                        '$name' , 
                        '$description' , 
                        '$price' , 
                        '$image_alt' , 
                        '$main_image_path' , 
                        '$image_1_path' , 
                        '$image_2_path' , 
                        '$image_3_path')";
            $connection->exec($query);
        }

        public static function deleteProduct($product_id){
            $connection = ConnectToDatabase::getDatabase();
            $query = "DELETE FROM Products
                        WHERE product_id = $product_id";
            $connection->exec($query);
        }
        public static function ediImage($product_id , $image_column_name , $new_image_path = null){
            $connection = ConnectToDatabase::getDatabase();
            if($new_image_path != null){
                $query = "UPDATE Products
                            SET `$image_column_name` = '$new_image_path'
                            WHERE product_id = '$product_id'";
            }else{
                $query = "UPDATE Products
                            SET `$image_column_name` = ''
                            WHERE product_id = '$product_id'";
            }
            $connection->exec($query);
        }

        public static function editProduct($product){
            $connection = ConnectToDatabase::getDatabase();
            $category_id = $product->__get("category")->__get("id");
            $product_id = $product->__get("id");
            $product_name = $product->__get("name");
            $description = $product->__get("description");
            $price = $product->__get("price");
            $image_alt = $product->__get("image_alt");

            $query = "UPDATE Products 
                        SET 
                        category_id = '$category_id',
                        name = '$product_name' ,
                        description = '$description',
                        price = '$price',
                        image_alt = '$image_alt'
                        WHERE product_id = '$product_id'";
            $connection->exec($query);
        }

        public static function searchProduct($search_text){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT * 
                        FROM Products
                        WHERE
                        product_id LIKE '%$search_text%'
                        OR
                        name LIKE '%$search_text%'
                        OR
                        description LIKE '%$search_text%'
                        OR
                        category_id LIKE '%$search_text%'";
            $result = $connection->query($query);
            
            $products = array();
            
            foreach($result as $information){
                $category = ProcessOnCategoy::getCategoryInformation($information["category_id"]);
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
                $product->__set("last_edit" , $information["last_edit"]);

                $products[] = $product;
            }
            return $products;
        }
    }

?>