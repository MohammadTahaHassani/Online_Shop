<?php
    class Category{
        private $id , $name;

        public function __construct($id , $name) {
            $this->name = $name;
            $this->id = $id;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>