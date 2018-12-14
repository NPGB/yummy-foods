<?php

    session_start();
    ob_start();

    if(isset($_GET['product_id'])) {
        $id = $_GET['product_id'];
        unset($_SESSION['cart'][$id] );
    }

?>