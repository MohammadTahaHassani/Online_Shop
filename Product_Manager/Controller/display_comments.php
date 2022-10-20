<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
        <th>Comment Id</th>
        <th>Comment</th>
        <th>Comment Date</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>User Id</th>
        <th>User Name</th>
        <th>User Phone</th>
        <th>Action</th>
        <?php foreach($comments as $comment):?>
            <tr>
                <td>
                    <?php echo $comment->__get("comment_id")?>
                </td>
                <td>
                    <?php echo $comment->__get("comment")?>
                </td>
                <td>
                    <?php echo $comment->__get("comment_date")?>
                </td>
                <td>
                    <?php echo $comment->__get("product_id")?>
                </td>
                <td>
                    <?php echo $comment->__get("product_name")?>
                </td>
                <td>
                    <?php echo $comment->__get("user_id")?>
                </td>
                <td>
                    <?php echo $comment->__get("user_name")?>
                </td>
                <td>
                    <?php echo $comment->__get("user_phone")?>
                </td>

                <td>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="delete_comment">

                        <input type="hidden" name="comment_id"
                            value="<?php echo $comment->__get("comment_id")?>">

                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>