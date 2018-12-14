<?php
     require_once("lib/connection.php");
     $user_id = $_GET['user_id'];
     $date_time = date('Y-m-d H:i:s');
     $sql = "INSERT INTO `orders`(`user_id`, `date_time`, `status`) VALUES ($user_id,'$date_time','pending')";
     $result = $conn->query($sql);
     $sql = "SELECT `order_id` FROM `orders` WHERE `user_id`=$user_id and `date_time`= '$date_time' and `status`='pending'";
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
        // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
        $row = $result->fetch_assoc();
        $order_id =$row['order_id'];
        session_start();
        ob_start();
        foreach ($_SESSION['cart'] as $key => $value) {
           $sql = "INSERT INTO `list_order`(`product_id`, `quantily`, `order_id`) VALUES ($key,$value,$order_id)";
           $result = $conn->query($sql);
        }
        unset($_SESSION['cart']);
     }
     echo 'success order view to check'
?>