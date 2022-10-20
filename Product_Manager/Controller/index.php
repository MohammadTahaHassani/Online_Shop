<?php
    include("../Model_And_Class/database.php");
    include("../Model_And_Class/button.php");
    include("../Model_And_Class/category.php");
    include("../Model_And_Class/user.php");
    include("../Model_And_Class/order.php");
    include("../Model_And_Class/comment.php");
    include("../Model_And_Class/process_on_category.php");
    include("../Model_And_Class/product.php");
    include("../Model_And_Class/process_on_product.php");
    include("../Model_And_Class/process_on_file.php");
    include("../Model_And_Class/process_on_user.php");
    include("../Model_And_Class/process_on_order.php");
    include("../Model_And_Class/process_on_comment.php");

    // ------------------------------ Buttons ------------------------------

    $buttons = array("Home" => "index.php",
                "Add_Product" => "index.php?action=add_product_form" ,
                "Users" => "index.php?action=show_user",
                "Order" => "index.php?action=show_orders",
                "Comments" => "index.php?action=show_comments");

    ProcessOnButton::getButtons($buttons);

    echo "<hr>";

    // ------------------------------ Select Action ------------------------------

    if(isset($_POST["action"])){
        $action = $_POST["action"];
    }else if(isset($_GET["action"])){
        $action = $_GET["action"];
    }else{
        $action = "view_product";
    }

    // ------------------------------ Product Section ------------------------------

    if($action == "view_product"){
        $categories = ProcessOnCategoy::getAllCategories();

        if(isset($_GET["category_id"])){
            $category_id = $_GET["category_id"];
        }else{
            $category_id = 1;
        }

        $products = ProcessOnProduct::getProductByCategory($category_id);

        $cuurent_category_name = ProcessOnCategoy::getCategoryInformation($category_id);
        $category_name = $cuurent_category_name->__get("name");

        include("product_list.php");
    }

    // ------------------------------

    else if($action == "add_product_form"){
        $categories = ProcessOnCategoy::getAllCategories();
        include("add_product_form.php");
    }

    // ------------------------------

    elseif($action == "add_product"){

        $category_id = $_POST["category_id"];
        $category = ProcessOnCategoy::getCategoryInformation($category_id);

       if(isset($_FILES["product_image"]) &&
            isset($_FILES["main_image"]) &&
            isset($_POST["image_alt"]) && 
            isset($_POST["product_name"]) && 
            isset($_POST["description"]) && 
            isset($_POST["price"])){

                $product_images = $_FILES["product_image"];
                print_r($product_images);
                $main_image = $_FILES["main_image"];
                $image_alt = trim($_POST["image_alt"]);
                $product_name = trim($_POST["product_name"]);
                $description = trim($_POST["description"]);
                $price = trim($_POST["price"]);

                $product_images_array = ProcessOnUploadingImage::uploadProductsImage($product_images);
                $product_image_path_1 = $product_images_array[0];
                $product_image_path_2 = $product_images_array[1];
                $product_image_path_3 = $product_images_array[2];

                $main_image = ProcessOnUploadingImage::uploadProductsImage($main_image);
                $main_image_path = $main_image;

                $product = new Product($category,
                                        $product_name,
                                        $description,
                                        $price,
                                        $image_alt,
                                        $main_image_path,
                                        $product_image_path_1,
                                        $product_image_path_2,
                                        $product_image_path_3);

                ProcessOnProduct::addNewProduct($product);

                header("Location: .?category_id=$category_id");
        }else{
            $error_message = "Fields Can Not Be Empty Please Try Again";
        }
    }

    // ------------------------------

    else if($action == "delete_product"){
        $category_id = $_POST["category_id"];
        $product_id = $_POST["product_id"];
        foreach($_POST["images"] as $image){
            unlink($image);
        }
        ProcessOnProduct::deleteProduct($product_id);
        header("Location: .?category_id=$category_id");
    }

    // ------------------------------

    else if($action == "watch_product_detail"){
        if(isset($_POST["product_id"])){
            $product_id = $_POST["product_id"];
        }else if(isset($_GET["product_id"])){
            $product_id = $_GET["product_id"];
        }

        $product = ProcessOnProduct::getProduct($product_id)->getProductArray();

        $current_category_name = $product["category"]->__get("name");
        $current_category_id = $product["category"]->__get("id");

        $categories = ProcessOnCategoy::getAllCategories();

        include("product_detail.php");
    }

    // ------------------------------

    else if($action == "edit_product_information"){
        $category_id = $_POST["category_id"];
        $category = ProcessOnCategoy::getCategoryInformation($category_id);
        
        $product_id = trim($_POST["product_id"]);
        $product_name = trim($_POST["name"]);
        $description = trim($_POST["description"]);
        $price = trim($_POST["price"]);
        $image_alt = trim($_POST["image_alt"]);
        $product = new Product($category ,
                            $product_name ,
                            $description,
                            $price,
                            $image_alt,
                            null,
                            null,
                            null,
                            null);
        $product->__set("id" , $product_id);
        ProcessOnProduct::editProduct($product);

        header("Location: .?action=watch_product_detail&product_id=$product_id");        
    }

    // ------------------------------

    else if($action == "edit_image_form"){
        $image_path = $_POST["image_path"];
        $product_id = $_POST["product_id"];
        $image_column_name = $_POST["image_column_name"];
        include("edit_image_form.php");
    }

    // ------------------------------

    else if($action == "edit_image"){
        $image_path = $_POST["image_path"];
        $product_id = $_POST["product_id"];
        $image_column_name = $_POST["image_column_name"];
        if(isset($_FILES["image"])){
            $image = $_FILES["image"];
            $new_image_path = ProcessOnUploadingImage::uploadProductsImage($image);

            ProcessOnProduct::ediImage($product_id , $image_column_name , $new_image_path);
            unlink($image_path);
        }
        header("Location: .?action=watch_product_detail&product_id=$product_id");
    }

    // ------------------------------

    else if($action == "delete_image"){
        $product_id = $_POST["product_id"];
        $image_column_name = $_POST["image_column_name"];
        $image_path = $_POST["image_path"];
        ProcessOnUploadingImage::deleteProductImage($image_path);
        ProcessOnProduct::ediImage($product_id , $image_column_name);
        header("Location: .?action=watch_product_detail&product_id=$product_id");
    }

    // ------------------------------

    else if($action == "search"){
        $search_text = $_POST["search_text"];
        $products = ProcessOnProduct::searchProduct($search_text);
        $categories = ProcessOnCategoy::getAllCategories();
        $category_name = "Search Base";
        include("product_list.php");
    }

    // ------------------------------ User Section ------------------------------

    else if($action == "show_user"){
        $users = ProcessOnUser::showUsers();
        include("display_user.php");
    }

    // ------------------------------

    else if($action == "change_user_post"){
        $user_id = $_POST["user_id"];
        $user_post = $_POST["user_post"];
        $users = ProcessOnUser::changePost($user_id , $user_post);
        $users = ProcessOnUser::showUsers();
        include("display_user.php");
    }

    // ------------------------------

    else if($action == "search_user"){
        $search_text = $_POST["user_search_text"];
        $users = ProcessOnUser::searchUser($search_text);
        include("display_user.php");
    }

    // ------------------------------ Order Section ------------------------------

    else if($action == "show_orders"){
        $orders = ProcessOnOrder::showOrders();
        include("display_order.php");
    }

    // ------------------------------

    else if($action == "order_search"){
        $search_text = $_POST["order_search_text"];
        $orders = ProcessOnOrder::searchOrder($search_text);
        include("display_order.php");
    }

    // ------------------------------

    else if($action == "change_order_status"){
        $order_id = $_POST["order_id"];
        $order_status = $_POST["order_status"];
        $orders = ProcessOnOrder::changeOrderStatus($order_status , $order_id);
        $orders = ProcessOnOrder::showOrders();
        include("display_order.php");
    }

    // ------------------------------ Comment Section ------------------------------

    else if($action == "show_comments"){
        $comments = ProcessOnComment::showComment();
        include("display_comments.php");
    }

    // ------------------------------

    else if($action == "delete_comment"){
        $comment_id = $_POST["comment_id"];
        ProcessOnComment::ProcessOnComment($comment_id);
        header("Location: index.php?action=show_comments");
    }
?>