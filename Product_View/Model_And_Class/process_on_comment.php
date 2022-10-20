<?php
    class ProcessOnComment{
        public static function addComment($comment_detail){
            $connection = ConnectToDatabase::getDatabase();

            $comment = $comment_detail->__get("comment");
            $product_id = $comment_detail->__get("product_id");
            $user_id = $comment_detail->__get("user_id");

            $query = "INSERT INTO `Comments`
                    (comment , product_id , user_id) 
                    VALUES 
                    ('$comment' , '$product_id' , $user_id)";
            $connection->exec($query);
        }

        public static function showComment($product_id){
            $connection = ConnectToDatabase::getDatabase();

            $query = "SELECT * FROM Comments
                    INNER JOIN Products ON
                        Comments.product_id = Products.product_id
                    INNER JOIN Users ON
                        Comments.user_id = Users.user_id
                    WHERE Comments.product_id = '$product_id'";
            $result = $connection->query($query);
            return $result;
        }
    }
?>