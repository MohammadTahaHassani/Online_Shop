<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add_product">

        <label>Category :</label>
        <select name="category_id">
            <?php foreach($categories as $category):?>
                <option value="<?php echo $category["category_id"]?>">
                    <?php echo $category["category_name"]?>
                </option>
            <?php endforeach;?>
        </select>

        <br>

        <label>Main Image :</label>
        <input type="file" name="main_image">
        <br>
        
        <label>Image Alt :</label>
        <input type="text" name="image_alt">

        <br>

        <label>Image1 :</label>
        <input type="file" name="product_image[]">

        <br>

        <label>Image2 :</label>
        <input type="file" name="product_image[]">
        
        <br>

        <label>Image3 :</label>
        <input type="file" name="product_image[]">

        <br>

        <label>Product Name :</label>
        <input type="text" name="product_name">
        
        <br>

        <label>Description :</label>
        <textarea name="description" cols="30" rows="10"></textarea>

        <br>

        <label>Price :</label>
        <input type="text" name="price">

        <br>

        <input type="submit" value="Add">
    </form>
</body>
</html>