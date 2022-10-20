<?php
    class Order{
        private $order_id ,
                $user_id,
                $user_name,
                $user_family,
                $user_phone,
                $user_address,
                $product_id,
                $product_name,
                $product_category,
                $count,
                $date,
                $status;
        public function __construct($order_id ,
                                    $user_id,
                                    $user_name,
                                    $user_family,
                                    $user_phone,
                                    $user_address,
                                    $product_id,
                                    $product_name,
                                    $product_price,
                                    $product_category,
                                    $count,
                                    $date,
                                    $status){
                $this->order_id = $order_id;
                $this->user_id = $user_id;
                $this->user_name = $user_name;
                $this->user_family = $user_family;
                $this->user_phone = $user_phone;
                $this->user_phone = $user_address;
                $this->product_id = $product_id;
                $this->product_name = $product_name;
                $this->product_price = $product_price;
                $this->product_category = $product_category;
                $this->count = $count;
                $this->date = $date;
                $this->status = $status;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>