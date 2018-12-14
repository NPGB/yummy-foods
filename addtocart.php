<?php

session_start();
ob_start();

if(isset($_GET['product_id'])) {
    $id = $_GET['product_id'];
    $quantity = 1;

    if(isset($_GET['quantity'])) {
        $quantity = $_GET['quantity'];
    }

    $_SESSION['cart'][$id] = $quantity;
}

?>