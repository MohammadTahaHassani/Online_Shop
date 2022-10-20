<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>
        <?php echo $product["name"];?>
    </h2>

   
    <form action="index.php" method="post">
        <input type="hidden" name="action" 
            value="edit_product_information">

        <input type="hidden" name="product_id" 
            value="<?php echo $product_id ?>">

        <label>Category : </label>
        <select name="category_id">
            <?php foreach($categories as $category):?>
                <?php if($category["category_id"] == $current_category_id):?>
                    <option selected="selected" value="<?php echo $category["category_id"]?>">
                        <?php echo $category["category_name"]?>
                    </option>
                <?php else:?>
                    <option value="<?php echo $category["category_id"]?>">
                        <?php echo $category["category_name"]?>
                    </option>
                <?php endif;?>
            <?php endforeach;?>
        </select>

        <br><br>
        
        <?php foreach($product as $key => $information):?>
            <?php if($key != "id" &&
                    $key != "category" &&
                    $key != "image_path" &&
                    $key != "image_1" &&
                    $key != "image_2" &&
                    $key != "image_3"):?>

                        <label><?php echo ucfirst($key)?> : </label>

                        <?php if($key == "description"):?>
                            
                            <textarea name="<?php echo $key?>" cols="30" rows="10"><?php echo$information ?></textarea>
                        
                        <?php else:?>
                            <input type="text" name="<?php echo $key?>" 
                                value="<?php echo $information?>">

                        <?php endif;?>

                        <br><br>
            <?php endif;?>
        <?php endforeach;?>

        <input type="submit" value="Edit Product">
    </form>

    <br>
        <hr><!-- -------------------- -->
    <br>

    <?php foreach($product as $key => $information):?>
        <form action="index.php" method="POST">
            <?php if($key == "image_path" ||
                        $key == "image_1" ||
                        $key == "image_2"  ||
                        $key == "image_3") :?>
                            <table>
                                <tr>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="<?php echo $information?>">
                                    </td>

                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="action" value="edit_image_form">
                                            
                                            <input type="hidden" name="image_column_name" 
                                                value="<?php echo $key?>">

                                            <input type="hidden" name="product_id" 
                                                value="<?php echo $product_id ?>">

                                            <input type="hidden" name="image_path" 
                                                value="<?php echo $information;?>">


                                            <input type="submit" value="Edit">

                                        </form>
                                    </td>
                                        <!-- -------------------- -->
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="action" value="delete_image">
                                            
                                            <input type="hidden" name="product_id" 
                                                value="<?php echo $product_id ?>">

                                            <input type="hidden" name="image_column_name" 
                                                value="<?php echo $key?>">

                                            <input type="hidden" name="image_path" 
                                                value="<?php echo $information;?>">

                                            <input type="submit" value="Delete">

                                        </form>
                                    </td>
                                </tr>
                            </table>

            <?php endif;?>
        <?php endforeach;?>

        <br><br>

        
        
    </form>

</body>
</html>