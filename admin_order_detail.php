<!DOCTYPE html>
<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['admin_name'])) {
	 header('Location: login.php');
	 exit();
}
?>
<html>

<head>
    <title>admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" typr="text/css" href="assets/css/admin_page.css">
    <link rel="stylesheet" href="assets/css/order_detail.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php include 'admin_head_and_menu.php'; ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <a href="order_action.php?action=shipping&id=<?php echo $order_id ?>" target="_blank">shipping</a>
                        </div>
                        <div class="col-md-7">
                            <div>
                                <button>print bill</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php
                    //Gọi file connection.php 
                        $order_id = $_GET['order_id'];
                        require_once("lib/connection.php");
                        $sql = "SELECT orders.order_id, user.user_name, user.address, user.number_phone FROM `orders`
                        LEFT JOIN `user`
                        ON (orders.user_id = user.user_id)
                        where order_id = $order_id";
                        $result = $conn->query($sql);
                        // get product
                        $sql1 = "SELECT list_order.quantily, product.product_name, product.product_price, product.unit FROM `list_order` LEFT JOIN `product` ON list_order.product_id = product.product_id WHERE `order_id`= $order_id"; 
                        $result1 = $conn->query($sql1);
                        $date_time = date('Y-m-d H:i:s');
                        // create bill
                        $sql2 = "INSERT INTO `bill`(`order_id`, `date`) VALUES ($order_id, '$date_time')";
                        $result2 = $conn->query($sql2);
                        // get id bill
                        $sql2 = "SELECT `bill_id` FROM `bill` WHERE `order_id` = '$order_id' ORDER BY `bill`.`date` DESC LIMIT 1";
                        $result2 = $conn->query($sql2);
                        while ($row = $result2->fetch_assoc()):
                            $bill_id = $row['bill_id'];
                            endwhile;
                        ?>
                        <div class="invoice-box">
                            <table cellpadding="0" cellspacing="0">
                                <tr class="top">
                                    <td><h4 style="text-align: center;">YUMMY FOODS INVOICE</h4></td>
                                </tr>
                                <tr>
                                    <td class="right">INVOICE: <?php echo $bill_id ?></td>
                                </tr>
                                <tr class="user-info-bill">
                                <?php  
                                while ($row = $result->fetch_assoc()):
                                ?>
                                    <td>
                                        <table>
                                            <tbody>
                                                <tr class="item">
                                                    <td>
                                                        customer name:
                                                    </td>
                                                    <td class="right item">
                                                        <?php echo $row['user_name'] ?><br>
                                                    </td>
                                                </tr>
                                                <tr class="item">
                                                    <td>
                                                        address:
                                                    </td>
                                                    <td class="right item">
                                                        <?php echo $row['address'] ?><br>
                                                    </td>
                                                </tr>
                                                <tr class="item">
                                                    <td>
                                                        number phone:
                                                    </td>
                                                    <td class="right item">
                                                        <?php echo $row['number_phone'] ?><br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                <?php 
                                endwhile;
                                ?>
                                </tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>order id:</td>
                                                <td class="right"><?php echo $order_id ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                if ($result1->num_rows > 0) {
                                ?>
                                <tr class="list">
                                    <td>
                                        <table class="table thead-light table-striped">
                                            <tr>
                                                <td>product name</td>
                                                <td>quantity</td>
                                                <td></td>
                                                <td>price/unit</td>
                                                <td></td>
                                                <td>amount</td>
                                            </tr>
                                    <?php
                                    $total_amount = 0;
                                    while ($row = $result1->fetch_assoc()): 
                                        $amount = $row['quantily']*$row['product_price'];
                                        $total_amount += $amount;
                                    ?> 
                                            <tr>
                                                <td><?php echo $row['product_name'] ?>:</td>
                                                <td><?php echo $row['quantily'].' '.$row['unit']  ?></td>
                                                <td>*</td>
                                                <td><?php echo $row['product_price'] ?></td>
                                                <td>=</td>
                                                <td><?php echo $amount ?></td>
                                            </tr>
                                            <?php
                                            endwhile;
                                        ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr class="item">
                                                <td>amount</td>
                                                <td class="right"><?php echo $total_amount ?></td>
                                            </tr>
                                            <tr class="item">
                                                <td>ship</td>
                                                <td class="right"><?php $ship =0; echo $ship ?></td>
                                            </tr>
                                            <tr class="item">
                                                <td>total</td>
                                                <td class="right"><?php echo $total_amount+$ship ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="info">
                                    <td>
                                        <table>
                                            <tbody>
                                                <tr class="item">
                                                    <td>date: </td>
                                                    <td class="right"><?php echo $date_time?></td>
                                                </tr>
                                                <tr >
                                                    <td >person create bill: </td>
                                                    <td class="right"><?php echo $_SESSION['admin_name'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                            $employees = $_SESSION['admin_name'];
                            $sql = "UPDATE `bill` SET `amount`=$total_amount,`ship`=$ship,`total`=$total_amount+$ship, `employees`= '$employees'      WHERE `bill_id` = $bill_id";
                            $result = $conn->query($sql);
                            ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>