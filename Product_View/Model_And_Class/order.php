<?php
    class RegisterOrder{

        private $user_id ,
                $product_id ,
                $count ,
                $date ,
                $status;


        public function __construct($user_id , 
                                    $product_id , 
                                    $count , 
                                    $date , 
                                    $status){

                $this->user_id = $user_id;
                $this->product_id = $product_id;
                $this->count = $count;
                $this->date = $date;
                $this->status = $status;
        }

        public function __set($element , $value){
            $this->$element = $value;
        }

        public function __get($element){
            return $this->$element;
        }
    }
?>