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
        <input type="hidden" name="action" value="search">
        <input type="text" name="search_text">
        <input type="submit" value="Search">
    </form>

    <hr>

    <ul>
        <?php foreach($categories as $category):?>
            <li>
                <a href="index.php?action=view_product&
                    category_id=<?php echo $category["category_id"]?>">

                    <?php echo $category["category_name"]?>
                </a>
            </li>
        <?php endforeach;?>
    </ul>

    <h2>
        <?php echo $category_name;?>
    </h2>

    <table>
        <tr>
            <th>product Id</th>
            <th>Category</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>image Alt</th>
            <th>image Path</th>
            <th>Main Image</th>
            <th>Last Edit</th>
            <th>View Product</th>
            <th>Action</th>
        </tr>
        <?php foreach($products as $product):?>
            <tr>
                <td>
                    <?php echo $product->__get("id");?>
                </td>

                <td>
                    <?php echo $product->__get("category")->__get("name");?>
                </td>

                <td>
                    <?php echo $product->__get("name");?>
                </td>

                <td>
                    <?php echo $product->__get("description");?>
                </td>

                <td>
                    <?php echo $product->__get("price");?>
                </td>

                <td>
                    <?php echo $product->__get("image_alt");?>
                </td>

                <td>
                    <?php echo $product->__get("image_path");?>
                </td>

                <?php if(!empty($product->__get("image_path"))):?>
                    <td>
                        <img src="<?php echo $product->__get("image_path");?>"
                            alt="<?php echo $product->__get("image_alt");?>">
                    </td>
                <?php else:?>
                    <td>No Image</td>
                <?php endif;?>
                

                <td>
                    <?php echo $product->__get("last_edit");?>
                </td>

                <td>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="watch_product_detail">
                        <input type="hidden" name="product_id" 
                            value="<?php echo $product->__get("id");?>">

                        <input type="submit" value="View">
                    </form>
                </td>

                <td>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" 
                            value="delete_product">

                        <input type="hidden" name="category_id"
                            value="<?php echo $product->__get("category")->__get("id");?>">

                        <input type="hidden" name="product_id"
                            value="<?php echo $product->__get("id");?>">
                        
                        <input type="hidden" name="images[]"
                            value="<?php echo $product->__get("image_path")?>">

                        <input type="hidden" name="images[]"
                            value="<?php echo $product->__get("image_1")?>">

                        <input type="hidden" name="images[]"
                            value="<?php echo $product->__get("image_2")?>">

                        <input type="hidden" name="images[]"
                            value="<?php echo $product->__get("image_3")?>">
                        
                        <input type="submit" value="Delete">



                    </form>
                </td>
            </tr>
            
        <?php endforeach;?>
    </table>
    
    <br><br>

    <a href="index.php?action=add_product_form">Add Product Form</a>

</body>
</html>