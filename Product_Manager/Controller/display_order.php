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
        <input type="hidden" name="action" value="order_search">
        <input type="text" name="order_search_text">
        <input type="submit" value="Search">
    </form>

    <hr>

    <table>
        <th>Order Id</th>
        <th>User Id</th>
        <th>User Name</th>
        <th>User Family</th>
        <th>User Phone</th>
        <th>User Address</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Product Category</th>
        <th>Count</th>
        <th>Price</th>
        <th>Date</th>
        <th>Status</th>
        <th>Total Price</th>
        <th>Action</th>

        <?php foreach($orders as $order):?>            
            <tr>
                <td>
                    <?php echo $order->__get("order_id");?>
                </td>
                <td>
                    <?php echo $order->__get("user_id");?>
                </td>
                <td>
                    <?php echo $order->__get("user_name");?>
                </td>
                <td>
                    <?php echo $order->__get("user_family");?>
                </td>
                <td>
                    <?php echo $order->__get("user_phone");?>
                </td>
                <td>
                    <?php echo $order->__get("user_address");?>
                </td>
                <td>
                    <?php echo $order->__get("product_id");?>
                </td>
                <td>
                    <?php echo $order->__get("product_name");?>
                </td>
                <td>
                    <?php echo $order->__get("product_category");?>
                </td>
                <td>
                    <?php echo $order->__get("count");?>
                </td>
                <td>
                    <?php echo $order->__get("product_price");?>
                </td>
                <td>
                    <?php echo $order->__get("date");?>
                </td>
                <td>
                    <?php echo $order->__get("status");?>
                </td>
                <td>
                    <?php echo $order->__get("count") * 
                        $order->__get("product_price");?>
                </td>
                <td>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="action" value="change_order_status">

                        <input type="hidden" name="order_id" 
                            value="<?php echo $order->__get("order_id");?>">

                            <select name="order_status">
                                <?php if($order->__get("status") == "Cancel"):?>
                                    <option selected="selected" value="Cancel">Cancel</option>
                                    <option value="Delivered">Delivered</option>
                                <?php elseif($order->__get("status") == "Delivered"):?>
                                    <option value="Cancel">Cancel</option>
                                    <option selected="selected" value="Delivered">Delivered</option>
                                <?php else:?>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Delivered">Delivered</option>
                                <?php endif;?>
                            </select>

                        <input type="submit" value="Change">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>