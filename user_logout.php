<?php
session_start();
// destroy sessions
session_destroy();
header('Location: index.php');
?>