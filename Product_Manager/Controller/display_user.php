<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="search_user">
        <input type="text" name="user_search_text">
        <input type="submit" value="Search">
    </form>

    <hr>

    <table>
        <th>User Id</th>
        <th>Name</th>
        <th>Family</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Email</th>
        <th>Username</th>
        <th>Status</th>
        <th>Action</th>

        <?php foreach($users as $user):?>            
            <tr>
                <td>
                    <?php echo $user->__get("user_id");?>
                </td>
                <td>
                    <?php echo $user->__get("name");?>
                </td>
                <td>
                    <?php echo $user->__get("family");?>
                </td>
                <td>
                    <?php echo $user->__get("phone");?>
                </td>
                <td>
                    <?php echo $user->__get("address");?>
                </td>
                <td>
                    <?php echo $user->__get("email");?>
                </td>
                <td>
                    <?php echo $user->__get("username");?>
                </td>
                <td>
                    <?php echo $user->__get("status");?>
                </td>

                <td>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="change_user_post">

                        <input type="hidden" name="user_id" 
                            value="<?php echo $user->__get("user_id");?>">

                        <select name="user_post">
                            <?php if($user->__get("status") == 1):?>
                                <option selected="selecte" value="1">User</option>
                                <option value="2">Admin</option>

                            <?php else:?>
                                <option value="1">User</option>
                                <option selected="selecte" value="2">Admin</option>
                            <?php endif;?>
                        </select>

                        <input type="submit" value="Change Post">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>