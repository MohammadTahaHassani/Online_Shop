<?php
    include("../Model_And_Class/database.php");
    include("../Model_And_Class/product.php");
    include("../Model_And_Class/category.php");
    include("../Model_And_Class/user.php");
    include("../Model_And_Class/order.php");
    include("../Model_And_Class/comment.php");
    include("../Model_And_Class/process_on_category.php");
    include("../Model_And_Class/process_on_product.php");
    include("../Model_And_Class/process_on_user.php");
    include("../Model_And_Class/process_on_session_and_cookie.php");
    include("../Model_And_Class/process_on_order.php");
    include("../Model_And_Class/process_on_comment.php");
    include("../Model_And_Class/session_and_cookie.php");
    include("../Model_And_Class/button.php");
    include("../../Patterns/pattern.php");

    // ------------------------------

    $session_information = new SessionAndCookie((7 * 24 * 60 * 60 ) , "/");
    ProcessOnSessionAndCookie::startSessionAndCookie($session_information);

    // ------------------------------ Buttons ------------------------------

    $buttons = ["home" => "index.php",
                "Login" => "index.php?action=login_page"
            ];
    if(isset($_SESSION["user"])){
        array_pop($buttons);
        $new_button = array("User Information" => "index.php?action=display_user_information" ,
                            "Logout" => "index.php?action=logout");
        Button::appendButton($buttons , $new_button);
    }
    if(isset($_SESSION["card"])){
        $new_button = array("Card View" => "index.php?action=view_card");
        Button::appendButton($buttons , $new_button);
    }

    $new_button = array("Order View" => "index.php?action=view_order");
    Button::appendButton($buttons , $new_button);

    if(isset($_SESSION["user"])){
        if($_SESSION["user"]["status"] == 2){
            $new_button = array("Admin Panel" => "../../Panel/panel.php");
            Button::appendButton($buttons , $new_button);
        }
    }

    Button::buttons($buttons);
    
    echo "<hr>";

    // ------------------------------ Select Action ------------------------------

    if(isset($_POST["action"])){
        $action = $_POST["action"];
    }else if(isset($_GET["action"])){
        $action = $_GET["action"];
    }else{
        $action = "product_view_list";
    }

    // ------------------------------ Product Section ------------------------------

    if($action == "product_view_list"){

        if(isset($_POST["category_id"])){
            $category_id = $_POST["category_id"];
        }else if(isset($_GET["action"])){
            $category_id = $_GET["category_id"];
        }else{
            $category_id = 1;
        }

        $categories = ProcessOnCategory::getAllCategories();
        
        $category_name = ProcessOnCategory::getCategoryInformation($category_id)->__get("name");
        
        $products = ProcessOnProduct::getProductByCategotyId($category_id);

        include("view_product_list.php");
    }

    else if($action == "product_search"){
        $serach_text = $_POST["serach_text"];
        $products = ProcessOnProduct::productSearch($serach_text);
        $categories = ProcessOnCategory::getAllCategories();
        
        $category_name = "Search Base";

        include("view_product_list.php");
    }

    // ------------------------------

    else if($action == "view_product_detail"){
        $product_id = $_GET["product_id"];
        $product = ProcessOnProduct::getProductDetail($product_id);
        if(isset($_GET["error_message"])){
            $error_message = $_GET["error_message"];
        }
        $comments = ProcessOnComment::showComment($product_id);
        include("view_product_detail.php");
    }

    // ------------------------------

    else if($action == "add_comment"){
        $product_id = $_POST["product_id"];
        $user_id = $_SESSION["user"]["id"];
        $comment_text = $_POST["comment_text"];

        $coment = new Comment($comment_text,
                            $product_id,
                            $user_id);
        ProcessOnComment::addComment($coment);
        header("Location: index.php?action=view_product_detail&product_id=$product_id");
    }

    // ------------------------------ User Section ------------------------------

    else if($action == "login_page"){
        include("login_page.php");
    }

    // ------------------------------

    else if($action == "login"){
        if(!empty($_POST["username"]) && !empty($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user = ProcessOnUser::validateUser($username , $password);

            if(!empty($user)){
                if(password_verify($password , $user->__get("password"))){

                    if(!isset($_SESSION)){
                        $session_information = new SessionAndCookie((7 * 24 * 60 * 60 ) , "/");
                        ProcessOnSessionAndCookie::startSessionAndCookie($session_information);   
                    }
                    
                    ProcessOnSessionAndCookie::setUserSession($user);
                    
                    include("display_user_information.php");
                }else{
                    $error_message[] = "Invalid Password";
                    include("login_page.php");
                }
            }else{
                $error_message[] = "Invalid Username";
                include("login_page.php");
            }
        }else{
            $error_message[] = "Form Can Not Be Empty";
            include("login_page.php");
        }
    }

    // ------------------------------

    else if($action == "display_user_information"){
        include("display_user_information.php");
    }

    // ------------------------------

    else if($action == "logout"){
        ProcessOnSessionAndCookie::finfishSessionAndCookie();
        header("Location: index.php");
    }

    // ------------------------------

    else if($action == "singup_form"){
        include("singup_form.php");
    }

    // ------------------------------

    else if($action == "singup"){
        $error_message_form_elements = array();
        if(isset($_POST["name"]) &&
            isset($_POST["family"]) &&
            isset($_POST["phone"]) &&
            isset($_POST["email"]) &&
            isset($_POST["address"]) &&
            isset($_POST["username"]) &&
            isset($_POST["password"])){

                $name = $_POST["name"];
                $family = $_POST["family"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $address = $_POST["address"];
                $username = $_POST["username"];
                $password = $_POST["password"];

                if(!preg_match($name_pattern , $name)){
                    $error_message_form_elements[] = "Enter Correct Name";
                }
                if(!preg_match($family_pattern , $family)){
                    $error_message_form_elements[] = "Enter Correct Family";
                }
                if(!preg_match($phone_pattern , $phone)){
                    $error_message_form_elements[] = "Enter Correct Phone";
                }
                if(!preg_match($email_pattern , $email)){
                    $error_message_form_elements[] = "Enter Correct Email";
                }
                if(!preg_match($address_pattern , $address)){
                    $error_message_form_elements[] = "Enter Correct Address";
                }
                if(!preg_match($username_pattern , $username)){
                    $error_message_form_elements[] = "Enter Correct Username";
                }
                if(!preg_match($password_pattern , $password)){
                    $error_message_form_elements[] = "Enter Correct Password";
                }

                $users_list = ProcessOnUser::checkForExistUsername();
                foreach($users_list as $user){
                    if($username == $user["username"]){
                        $error_message_form_elements[] = "Username Already Exist";
                    }
                }

                if(!empty($error_message_form_elements)){
                    include("singup_form.php");
                }else{
                    $user = new User($name,
                                    $family,
                                    $phone,
                                    $email,
                                    $address,
                                    $username,
                                    password_hash($password , PASSWORD_DEFAULT));

                    ProcessOnUser::addUser($user);

                    include("login_page.php");
                }
        }
    }

    // ------------------------------

    else if($action == "reset_password"){
        include("pre_process_reset_password_form.php");
    }

    // ------------------------------

    else if($action == "recycle_password"){
        if(!empty($_POST["email"]) && !empty($_POST["phone"])){
            $email = $_POST["email"];
            $phone = $_POST["phone"];

            $user = ProcessOnUser::resetPassword($email , $phone);

            if(empty($user)){
                $error_message[] = "Email Or Phone Is Invalid";
                include("pre_process_reset_password_form.php");
            }else{
                $user_id =  $user["user_id"];
                include("reset_password_form.php");
            }

        }else{
            $error_message[] = "Form Can Not Be Empty";
            include("pre_process_reset_password_form.php");
        }
    }

    // ------------------------------

    else if($action == "new_password"){
        if(!empty($_POST["password"])){
            $password = $_POST["password"];

            if(!preg_match($password_pattern , $password)){
                $error_message[] = "Enter Correct Password";
                include("reset_password_form.php");
            }else{
                $password = password_hash($password , PASSWORD_DEFAULT);
                $user_id = $_POST["user_id"];
                ProcessOnUser::changePassword($user_id , $password);
                include("login_page.php");
            }
        }else{
            $error_message[] = "Form Can Not Be Empty";
            include("reset_password_form.php");
        }
    }

    // ------------------------------

    else if($action == "update_user_information_form"){
        $user_id = $_GET["user_id"];
        $user_information = ProcessOnUser::getUserInformationByUserId($user_id);
        include("update_user_information_form.php");
    }

    // ------------------------------

    else if($action == "update_user_information"){
        if(isset($_POST["name"]) &&
            isset($_POST["family"]) &&
            isset($_POST["phone"]) &&
            isset($_POST["email"]) &&
            isset($_POST["address"])){

                $name = $_POST["name"];
                $family = $_POST["family"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $address = $_POST["address"];
                $user_id = $_POST["user_id"];

                $user = new User($name ,
                                $family,
                                $phone,
                                $email,
                                $address,
                                null,
                                null);
                $user->__set("id" , $user_id);
                ProcessOnUser::updateUser($user);

                ProcessOnSessionAndCookie::setUserSession($user);

                include("display_user_information.php");
            }else{
                $error_message[] = "Elements Can Not Be Empty";
                include("update_user_information_form.php");
            }
    }

    // ------------------------------ Card Section ------------------------------

    else if($action == "add_to_card"){
        if(isset($_SESSION["user"])){
            $product_id = $_POST["product_id"];
            $product_name = $_POST["product_name"];
            $product_price = $_POST["product_price"];
            $category_id = $_POST["category_id"];
            $category = ProcessOnCategory::getCategoryInformation($category_id);
            $user_id = $_SESSION["user"]["id"];
            $count = $_POST["product_count"];
    
            $product = new product($category ,
                                    $product_name,
                                    null,
                                    $product_price,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null);
            $product->__set("id" , $product_id);
            ProcessOnSessionAndCookie::addProductToCard($product , $user_id , $count);
            
            include("view_card.php");
        }else{
            include("login_page.php");
        }
    }

    // ------------------------------

    else if($action == "view_card"){
        include("view_card.php");
    }

    // ------------------------------
    
    else if($action == "update_product_count"){
        $product_id = $_POST["product_id"];
        $new_count = $_POST["count"];
        $user_id = $_SESSION["user"]["id"];
        ProcessOnSessionAndCookie::updateProductCard($product_id , $user_id , $new_count);
        include("view_card.php");
    }

    // ------------------------------

    else if($action == "delete_product_from_card"){
        $product_id = $_POST["product_id"];
        $user_id = $_SESSION["user"]["id"];
        ProcessOnSessionAndCookie::deleteProductFromCard($product_id , $user_id);
        include("view_card.php");
    }

    // ------------------------------ Order Section ------------------------------

    else if($action == "register_order"){
        $user_id = $_SESSION["user"]["id"];

        $order_array = array();
        foreach($_SESSION["card"][$user_id] as $key => $value){
            foreach($value as $element){
                $order_array[] = $element;
            }

            $order_information = new RegisterOrder($user_id ,
                                                    $key ,
                                                    $order_array[3] ,
                                                    null ,
                                                    null);
            ProcessOnOrder::registerOrder($order_information);
            $orders = ProcessOnOrder::showOrders();
            unset($_SESSION["card"][$user_id]);
            include("display_order.php");
        }
    }

    // ------------------------------

    else if($action == "view_order"){
        $user_id = $_SESSION["user"]["id"];
        $orders = ProcessOnOrder::showOrders($user_id);
        include("display_order.php");
    }

    // ------------------------------

    else if($action == "cancel_order"){
        $order_id = $_POST["order_id"];
        ProcessOnOrder::cancelOrder($order_id);
        $orders = ProcessOnOrder::showOrders();
        include("display_order.php");
    }
?>