<?php
    class Comment{
        private $comment,
                $product_id,
                $user_id;
        public function __construct($comment,
                                    $product_id,
                                    $user_id){
            $this->comment = $comment;
            $this->product_id = $product_id;
            $this->user_id = $user_id;
        }

        public function __set($element , $value){
            $this->$element = $value;
        }

        public function __get($element){
            return $this->$element;
        }
    }

?>