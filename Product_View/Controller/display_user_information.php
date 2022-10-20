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
        foreach($_SESSION["user"] as $key => $information){
            if($key != "status"){
                echo ucfirst($key) . "=> $information <br><br>";
            }else{
                echo ucfirst($key) . "=>". ProcessOnUser::GetStatusDescription($information)["description"] . "<br><br>";

            }
        }
    ?>

    <hr>

    <a href="index.php?action=update_user_information_form&
            user_id=<?php echo $_SESSION["user"]["id"];?>">Update Information</a>

    <br><br>
    
</body>
</html>