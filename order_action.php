<?php
    require_once("lib/connection.php");
    $id = $_GET['id'];
    $action = $_GET['action'];
    $status ='';
    if($action=='shipping') {
        $status = 'shipping';
    } else if($action=='delivered') {
        $status = 'delivered';
    } else {
        $status = 'empl ccor';
    }
    $sql ="UPDATE `orders` SET `status`='$status' WHERE `order_id` = $id";
    $result = $conn->query($sql);
    if($result) {
        echo 'ok';
    }
?>