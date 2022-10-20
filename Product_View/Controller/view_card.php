<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php if(count($_SESSION["card"][$_SESSION["user"]["id"]]) < 1):?>
        <p>Card Is Empty</p>
    <?php else:?>

        <table>
            <tr>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Product price</th>
                <th>Total</th>
                <th>Product Count</th>
                <th>Action</th>
            </tr>

            <?php foreach($_SESSION["card"][$_SESSION["user"]["id"]] as $key => $value):?>
                <tr>
                    <td>
                        <?php echo $value["product_name"]?>
                    </td>

                    <td>
                        <?php echo $value["category_name"]?>
                    </td>

                    <td>
                        <?php echo $value["product_price"]?>
                    </td>

                    <td>
                        <?php echo $value["total"]?>
                    </td>

                    <td>
                        <form action="index.php" method="post">

                            <input type="hidden" name="action"
                                value="update_product_count">

                            <input type="hidden" name="product_id"
                                value="<?php echo $key?>">

                            <select name="count">
                                <?php for($i = 1; $i < 10; $i++):?>
                                    <?php if($value["product_count"] == $i):?>
                                        <option selected="selected" value="<?php echo $i?>">
                                            <?php echo $i?>
                                        </option>
                                    <?php else:?>
                                        <option value="<?php echo $i?>">
                                            <?php echo $i?>
                                        </option>
                                    <?php endif;?>
                                <?php endfor;?>
                            </select>
                            <input type="submit" value="Update">
                        </form>
                    </td>
                        
                    <td>
                        <form action="index.php" method="post">

                        <input type="hidden" name="action"
                            value="delete_product_from_card">

                        <input type="hidden" name="product_id"
                            value="<?php echo $key?>">

                        <input type="submit" value="Delete">
                        
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    <?php endif;?>

    <p>Total : 
        <?php echo $sub_total = ProcessOnSessionAndCookie::getSubTotal($_SESSION["user"]["id"]);?>
    </p>

    <?php if($sub_total > 0):?>
        <a href="index.php?action=register_order">Buy</a>
    <?php endif;?>
    
    
</body>
</html>