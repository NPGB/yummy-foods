<?php
	$config = include('config/config.php');
	$server_username = $config['username'];
	$server_password = $config['password'];
	$server_host = $config['host'];
	$database = $config['database'];
	 
	$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("không thể kết nối tới database");
	mysqli_query($conn,"SET NAMES 'UTF8'");
