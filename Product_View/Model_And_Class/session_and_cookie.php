<?php
    class SessionAndCookie{
        private $time , 
                $path;

        public function __construct($time , $path){
            $this->time = $time;
            $this->path = $path;
        }

        public function __set($element , $value){
            $this->$element = $value;
        }

        public function __get($element){
            return $this->$element;
        }
    }
?>