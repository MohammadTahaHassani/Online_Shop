<?php
    class Comment{
        private $comment_id,
                $comment,
                $comment_date,
                $product_id,
                $product_name,
                $user_id,
                $user_name,
                $user_phone;
        public function __construct($comment_id,
                                    $comment,
                                    $comment_date,
                                    $product_id,
                                    $product_name,
                                    $user_id,
                                    $user_name,
                                    $user_phone){
            $this->comment_id = $comment_id;
            $this->comment = $comment;
            $this->comment = $comment_date;
            $this->product_id = $product_id;
            $this->product_name = $product_name;
            $this->user_id = $user_id;
            $this->user_name = $user_name;
            $this->user_phone = $user_phone;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>