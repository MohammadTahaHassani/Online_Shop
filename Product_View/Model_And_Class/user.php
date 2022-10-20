<?php
    class User{
        private $id , 
                $name , 
                $family , 
                $phone , 
                $email , 
                $address , 
                $username , 
                $password ,
                $status;

        public function __construct($name , 
                                    $family , 
                                    $phone , 
                                    $email , 
                                    $address , 
                                    $username , 
                                    $password){
            $this->name = $name;
            $this->family = $family;
            $this->phone = $phone;
            $this->email = $email;
            $this->address = $address;
            $this->username = $username;
            $this->password = $password;
        }
        
        public function __set($element , $value){
            $this->$element = $value;
        }

        public function __get($element){
            return $this->$element;
        }
    }
?>