<?php
    class ProcessOnUser{
        public static function showUsers(){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Users
                        INNER JOIN Assignment
                        WHERE
                        Users.status = Assignment.status_id";

            $result = $connection->query($query);
            $result = $result->fetchAll();

            $users = array();
            foreach($result as $information){
                $user = new User($information["name"],
                                    $information["family"],
                                    $information["phone"],
                                    $information["address"],
                                    $information["email"]);
                $user->__set("user_id" , $information["user_id"]);
                $user->__set("username" , $information["username"]);
                $user->__set("status" , $information["status"]);

                $users[] = $user;
            }
            return $users;
        }

        public static function changePost($user_id , $post){
            $connection = ConnectToDatabase::getDatabase();

            $query = "UPDATE Users
                        SET status = $post
                        WHERE user_id = '$user_id'";
            
            $connection -> exec($query);

        }

        public static function searchUser($text){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * From Users
                        WHERE 
                        name LIKE '%$text%' 
                        OR
                        family LIKE '%$text%' 
                        OR
                        phone LIKE '%$text%' 
                        OR
                        email LIKE '%$text%'
                        OR
                        username LIKE '%$text%'";

            $result = $connection->query($query);
            $result = $result->fetchAll();

            $users = array();
            foreach($result as $information){
                $user = new User($information["name"],
                                    $information["family"],
                                    $information["phone"],
                                    $information["address"],
                                    $information["email"]);
                $user->__set("user_id" , $information["user_id"]);
                $user->__set("username" , $information["username"]);
                $user->__set("status" , $information["status"]);

                $users[] = $user;
            }
            return $users;
        }
    }

?>