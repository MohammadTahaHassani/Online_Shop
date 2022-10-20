<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(!empty($error_message_form_elements)){
            foreach($error_message_form_elements as $error){
                echo "<p>$error</p><br>";
            }
        }
    ?>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="singup">

        <label>Name</label>
        <input type="text" name="name"
            <?php if(isset($name)):?>
                value="<?php echo $name?>">
            <?php endif;?>

        <br><br>

        <label>Family</label>
        <input type="text" name="family"
            <?php if(isset($family)):?>
                value="<?php echo $family?>">
            <?php endif;?>

        <br><br>

        <label>Phone</label>
        <input type="text" name="phone"
            <?php if(isset($phone)):?>
                value="<?php echo $phone?>">
            <?php endif;?>
            
        <br><br>

        <label>Email</label>
        <input type="text" name="email"
            <?php if(isset($email)):?>
                value="<?php echo $email?>">
            <?php endif;?>
        
        <br><br>

        <label>Address</label>
        <input type="text" name="address"
            <?php if(isset($address)):?>
                value="<?php echo $address?>">
            <?php endif;?>
            
        <br><br>

        <label>Username</label>
        <input type="text" name="username"
            <?php if(isset($username)):?>
                value="<?php echo $username?>">
            <?php endif;?>

        <br><br>

        <label>Password</label>
        <input type="password" name="password"
            <?php if(isset($password)):?>
                value="<?php echo $password?>">
            <?php endif;?>


        <br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>