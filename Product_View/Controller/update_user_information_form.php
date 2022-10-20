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

    <form action="index.php" method="post">
        <input type="hidden" name="action"
            value="update_user_information">

        <input type="hidden" name="user_id"
            value="<?php echo $user_id?>">

        <label>Name : </label>
        <input type="text" name="name"
            value="<?php echo $user_information->__get("name")?>">

        <br><br>

        <label>Family : </label>
        <input type="text" name="family"
            value="<?php echo $user_information->__get("family")?>">

        <br><br>

        <label>Phone : </label>
        <input type="text" name="phone"
            value="<?php echo $user_information->__get("phone")?>">

        <br><br>

        <label>Email : </label>
        <input type="text" name="email"
            value="<?php echo $user_information->__get("email")?>">

        <br><br>

        <label>Address : </label>
        <input type="text" name="address"
            value="<?php echo $user_information->__get("address")?>">

        <br><br>

        <input type="submit" value="Update">

    </form>
</body>
</html>