<?php
session_start();
// Hủy các session
session_destroy();
header('Location: login.php');
?>