<?php
    class ProcessOnSessionAndCookie{
        public static function startSessionAndCookie($session_information){

            $time = $session_information->__get("time");
            $path = $session_information->__get("path");

            session_set_cookie_params($time , $path);
            session_start();
        }

        public static function finfishSessionAndCookie(){
            $session_name = session_name();
            session_destroy();
            setcookie($session_name , "" , 0 , "/");

        }

        public static function setUserSession($user){
            $id = $user->__get("id");
            $name = $user->__get("name");
            $family = $user->__get("family");
            $phone = $user->__get("phone");
            $email = $user->__get("email");
            $address = $user->__get("address");
            $status = $user->__get("status");

            $user_informtion = array(
                                "id" => $id ,
                                "name" => $name ,
                                "family" => $family ,
                                "phone" => $phone ,
                                "email" => $email ,
                                "address" => $address,
                                "status" => $status
            );

            $_SESSION["user"] = $user_informtion;              
        }

        public static function addProductToCard($product , $user_id , $count){
            $product_id = $product->__get("id");
            $category = $product->__get("category")->__get("name");
            $product_name = $product->__get("name");
            $product_price = $product->__get("price");
            $total = $product_price * $count;

            $product_information = array("product_name" => $product_name,
                                        "category_name" => $category,
                                        "product_price" => $product_price,
                                        "product_count" => $count,
                                        "total" => $total);

            $_SESSION["card"]["$user_id"]["$product_id"] = $product_information;
        }

        public static function updateProductCard($product_id , $user_id , $new_count){
            $_SESSION["card"]["$user_id"]["$product_id"]["product_count"] = $new_count;
            $total = $_SESSION["card"]["$user_id"]["$product_id"]["product_price"] * $new_count;
            $_SESSION["card"]["$user_id"]["$product_id"]["total"] = $total;
        }

        public static function deleteProductFromCard($product_id , $user_id){
            unset($_SESSION["card"]["$user_id"]["$product_id"]);
            array_values($_SESSION["card"]);
        }

        public static function getSubTotal($user_id){
            $sub_total = 0;
            foreach($_SESSION["card"]["$user_id"] as $item){
                $sub_total += $item["total"];
            }
            return $sub_total;
        }
    }
?>