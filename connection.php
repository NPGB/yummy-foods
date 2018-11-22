<?php
	$server_username = "root";
	$server_password = "warriorIT13:)";
	$server_host = "localhost";
	$database = 'yummy_food';
	 
	$conn = mysqli_connect($server_host,$server_username,$server_password,$database) or die("Connection failed: " . $conn->connect_error);
	mysqli_query($conn,"SET NAMES 'UTF8'");
