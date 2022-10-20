<?php
    class ProcessOnUser{
        public static function addUser($user){
            $connection = ConnectToDatabase::getDatabase();

            $name = $user->__get("name");
            $family = $user->__get("family");
            $phone = $user->__get("phone");
            $email = $user->__get("email");
            $address = $user->__get("address");
            $username = $user->__get("username");
            $password = $user->__get("password");

            $query = "INSERT INTO Users
                    (name , 
                    family , 
                    phone , 
                    email , 
                    addresss , 
                    username , 
                    password) 

                VALUES 

                    ('$name' , 
                    '$family' , 
                    '$phone' , 
                    '$email' , 
                    '$address' , 
                    '$username' , 
                    '$password')";
            $connection->exec($query);
        }


        public static function validateUser($username , $password){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT *
                        FROM Users
                        WHERE username = '$username'";

            $result = $connection->query($query);
            $row = $result->fetch();

            if(!empty($row)){
                $user = new User($row["name"],
                                $row["family"],
                                $row["phone"],
                                $row["email"],
                                $row["address"],
                                $row["username"],
                                $row["password"]);
                $user->__set("id" , $row["user_id"]);
                $user->__set("status" , $row["status"]);
                return $user;
            }
        }

        public static function resetPassword($email , $phone){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT *
                        FROM Users
                        WHERE 
                        email = '$email'
                        AND
                        phone = '$phone'";

            $result = $connection->query($query);

            $result = $result->fetch();

            return $result;
        }

        public static function changePassword($user_id , $password){
            $connection = ConnectToDatabase::getDatabase();
            $query = "UPDATE Users
                        SET password = '$password'
                        WHERE user_id = '$user_id'";

            $connection->exec($query);

        }

        public static function checkForExistUsername(){
            $connection = ConnectToDatabase::getDatabase();
            $query = "SELECT *
                        FROM Users";
            $result = $connection->query($query);

            return $result;
        }

        public static function getUserInformationByUserId($user_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT *
                        FROM Users 
                        WHERE user_id = $user_id";
            $result = $connection->query($query);
            $row = $result->fetch();

            $user = new User($row["name"],
                            $row["family"],
                            $row["phone"],
                            $row["email"],
                            $row["address"],
                            $row["username"],
                            $row["password"]);
            $user->__set("id" , $row["user_id"]);
            $user->__set("status" , $row["status"]);

            return $user;
        }

        public static function updateUser($user){
            $id = $user->__get("id");
            $name = $user->__get("name");
            $family = $user->__get("family");
            $phone = $user->__get("phone");
            $email = $user->__get("email");
            $address = $user->__get("address");
            $status = $user->__get("status");

            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE `Users` SET 
                        name = '$name' ,
                        family = '$family' ,
                        phone = '$phone' ,
                        email = '$email' ,
                        address = '$address'
                        WHERE user_id = $id";
            $connection->exec($query);
        }

        public static function GetStatusDescription($user_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT Assignment.description
                    FROM Assignment
                    INNER JOIN Users ON
                        Users.status = Assignment.status_id
                        WHERE user_id = '$user_id'";
            $result = $connection->query($query);
            $row = $result->fetch();

            return $row;
        }
    }
?>