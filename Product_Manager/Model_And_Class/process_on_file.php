<?php
    class ProcessOnUploadingImage{
        
        private static $file_array = array();
        private static $file_source;

        public static function uploadProductsImage($files){

            if(is_array($files["name"])){
                for($i = 0; $i < 3; $i++){
                    $name = $files["name"][$i];
                    $target = "../../Images/$name";
                    $source = $files["tmp_name"][$i];
                    move_uploaded_file($source , $target);
                    self::$file_array[] = $target;
                }
                return self::$file_array;
            }else{
                $name = $files["name"];
                $target = "../../Images/$name";
                $source = $files["tmp_name"];
                move_uploaded_file($source , $target);
                self::$file_source = $target;
                return self::$file_source;
            }
        }
        
        public static function deleteProductImage($path){
            unlink($path);
        }
    }
?>