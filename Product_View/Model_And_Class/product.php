<?php
    class Product{
        private $id ,
                $category ,
                $name ,
                $description ,
                $price ,
                $image_alt ,
                $image_path ,
                $image_1 ,
                $image_2 ,
                $image_3;

        public function __construct($category , 
                                    $name , 
                                    $description , 
                                    $price , 
                                    $image_alt , 
                                    $image_path , 
                                    $image_1 , 
                                    $image_2 , 
                                    $image_3){

            $this->category = $category;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->image_alt = $image_alt;
            $this->image_path = $image_path;
            $this->image_1 = $image_1;
            $this->image_2 = $image_2;
            $this->image_3 = $image_3;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }

        public function getProductArray(){
            $product_array = array();
            foreach($this as $key => $value){
                $product_array[$key] = $value;
            }
            return $product_array;
        }
    }
?>