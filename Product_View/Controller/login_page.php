<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php if(!empty($error_message)){
        foreach($error_message as $error){
            echo "<p>$error</p>";
        }
    }?>
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="login">
        <label>Username</label>
        <input type="text" name="username"
            value="<?php if(isset($username)) echo $username;?>">

        <br>

        <label>Password</label>
        <input type="password" name="password">

        <br>

        <input type="submit" value="Login">
    </form>

    <a href="index.php?action=singup_form">Register New User</a>
    <br><br>
    <a href="index.php?action=reset_password">Forget Password</a>
</body>
</html>