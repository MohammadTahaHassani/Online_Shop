<?php 
    class Button{
        public static function buttons($button_array){
            foreach($button_array as $name => $url){
                self::showButtons($url , $name);
            }
        }

        private static function showButtons($url , $name){
            echo "<a href='$url'>$name</a><br>";
        }

        public static function appendButton(&$button_array , $buttons){
            $values = func_get_args();
            array_shift($values);
            foreach($values as $url => $value){
                foreach($buttons as $name => $url){
                    $button_array[$name] = $url;
                }
            }
        }
    }
?>
