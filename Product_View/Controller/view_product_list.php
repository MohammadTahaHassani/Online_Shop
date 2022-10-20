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
        <input type="hidden" name="action" value="product_search">

        <input type="text" name="serach_text">

        <input type="submit" value="Search">
    </form>

    <hr>
    <ul>
        <?php foreach($categories as $category):?>
            <li>
                <a href="index.php?action=product_view_list&
                        category_id=<?php echo $category["category_id"]?>">

                        <?php echo $category["category_name"]?>
                    </a>
            </li>
        <?php endforeach;?>
    </ul>

    <h2><?php echo $category_name?></h2>

    <ul>
        <?php foreach($products as $product):?>
            <a href="index.php?action=view_product_detail&
                    product_id=<?php echo $product->__get("id")?>">
                <li>
                    <img src="<?php echo $product->__get("image_path")?>" 
                        alt="<?php echo $product->__get("image_alt")?>">
                    <?php echo $product->__get("name")?>
                </li>
            </a>
        <?php endforeach;?>
    </ul>

</body>
</html>