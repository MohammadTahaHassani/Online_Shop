<?php
    class ProcessOnComment{
        public static function showComment(){
            $connection = ConnectToDatabase::getDatabase();


            $query = "SELECT Comments.comment_id,
                                Comments.comment,
                                Comments.comment_date,
                                Products.product_id,
                                Products.name AS product_name,
                                Users.user_id,
                                Users.name AS user_name,
                                Users.phone AS user_phone
                        FROM Comments
                    INNER JOIN Products ON
                        Comments.product_id = Products.product_id
                    INNER JOIN Users ON
                        Comments.user_id = Users.user_id";
            $result = $connection->query($query);

            $comments = array();

            foreach($result as $information){
                $comment = new Comment($information["comment_id"],
                                        $information["comment"],
                                        $information["comment_date"],
                                        $information["product_id"],
                                        $information["product_name"],
                                        $information["user_id"],
                                        $information["user_name"],
                                        $information["user_phone"]);
                $comments[] = $comment;
            }
            return $comments;
        }

        public static function ProcessOnComment($comment_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "DELETE FROM Comments 
                        WHERE comment_id = $comment_id";
            $connection->exec($query);

        }
    }
?>