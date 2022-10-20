<?php
    class ProcessOnButton{
        public static function getButtons($buttons){
            foreach($buttons as $name => $url){
                self::displayButton($name , $url);
            }
        }
        private static function displayButton($name , $url){
            echo "<a href='$url'>$name</a> <br>";
        }

    }
?>