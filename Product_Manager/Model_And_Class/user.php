<?php
    class User{
        private $user_id,
                $name,
                $family,
                $phone,
                $address,
                $email,
                $username,
                $status;
        public function __construct($name,
                                        $family,
                                        $phone,
                                        $address,
                                        $email){
            $this->name = $name;
            $this->family = $family;
            $this->phone = $phone;
            $this->address = $address;
            $this->email = $email;
        }

        public function __set($element, $value){
            $this->$element = $value;
        }
        public function __get($element){
            return $this->$element;
        }
    }
?>