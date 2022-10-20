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
            <th>Name</th>
            <th>Image</th>
            <th>Per Each Price</th>
            <th>Count</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
            <th>Sum</th>
            <?php foreach($orders as $order):?>
                <tr>
                    <td>
                        <?php echo $order["name"];?>
                    </td>
                    
                    <td>
                        <img src="<?php echo $order["image_path"];?>">
                    </td>

                    <td>
                        <?php echo $order["price"];?>
                    </td>

                    <td>
                        <?php echo $order["count"];?>
                    </td>

                    <td>
                        <?php 
                            echo $order["count"] * $order["price"];
                        ?>
                    </td>

                    <td>
                        <?php echo $order["status"];?>
                    </td>

                    <td>
                        <form action="index.php" method="POST">
                            <input type="hidden" name="action" value="cancel_order">

                            <input type="hidden" name="order_id" 
                                value="<?php echo $order["order_id"];?>">

                            <input type="submit" value="Cancel">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>

                <tr>
                    <td>
                        <?php 
                            $sum = 0;
                            foreach($orders as $order){
                                $sum += $order["count"] * $order["price"];
                                if($order["status"] == "Cancel" ||
                                        $order["status"] == "Delivered"){
                                    $sum -= $order["count"] * $order["price"];
                                }
                            }
                            echo "Total Price : " . $sum;
                        ?>
                    </td>
                </tr>
        </table>    
    </body>
</html>