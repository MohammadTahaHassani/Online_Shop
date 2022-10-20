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
        <input type="hidden" name="action" value="recycle_password">

        <label>Email : </label>
        <input type="text" name="email">

        <br>

        <label>Phone Number : </label>
        <input type="text" name="phone">

        <br>

        <input type="submit" value="Login">
    </form>
</body>
</html>