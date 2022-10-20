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
        if(!empty($error_message)){
            echo $error_message;
        }
    ?>
    <h2><?php echo $product->__get("name")?></h2>

    <ul>
        <li>
            Main Image : 
            <img src="<?php echo $product->__get("image_path")?>"
                    alt="<?php echo $product->__get("image_alt")?>">
        </li>
    </ul>

    <ul>
        <li>
            Image 1 : 
            <img src="<?php echo $product->__get("image_1")?>">
        </li>

        <li>
            Image 2 : 
            <img src="<?php echo $product->__get("image_2")?>">
        </li>

        <li>
            Image 3 : 
            <img src="<?php echo $product->__get("image_3")?>">
        </li>
    </ul>

    <br>
    
    <h3>Description:</h3>
    <p>
        <?php echo $product->__get("description")?>
    </p>

    <h3>Price:</h3>
    <p>
        <?php echo $product->__get("price")?>
    </p>

    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="add_to_card">

        <input type="hidden" name="product_id" 
            value="<?php echo $product->__get("id")?>">

        <input type="hidden" name="category_id" 
            value="<?php echo $product->__get("category")->__get("id")?>">

        <input type="hidden" name="product_name" 
            value="<?php echo $product->__get("name")?>">

        <input type="hidden" name="product_price" 
            value="<?php echo $product->__get("price")?>">

        <label>Count : </label>
        <select name="product_count">
            <?php for ($i = 1; $i < 10; $i++):?>
                <option value="<?php echo $i?>">
                    <?php echo $i?>
                </option>
            <?php endfor;?>
        </select>

        <br>
        <br>

        <input type="submit" value="Add To Card">
    </form>

    <hr>
    
    <h2>Comments</h2>
    <table>
        <th>Name</th>
        <th>Date</th>
        <th>Comment</th>
        <?php foreach($comments as $comment):?>
            <tr>
                <td>
                    <?php echo $comment["name"];?>
                </td>
                <td>
                    <?php echo $comment["comment_date"];?>
                </td>
                <td>
                    <?php echo $comment["comment"];?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>


    <?php if(isset($_SESSION["user"])):?>
        <hr>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="add_comment">

            <input type="hidden" name="product_id"
                value="<?php echo $product->__get("id")?>">

            <label>Comment : </label>
            <input type="text" name="comment_text">

            <br>

            <input type="submit" value="Add">
        </form>
    <?php endif;?>

</body>
</html>