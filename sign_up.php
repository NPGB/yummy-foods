<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/header-footer.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header-footer.css">
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous">
    </script>
</head>
<body>
<?php
$config = include('config/config.php'); 
include('config/page_config.php');
include('header.php');
	// Kiểm tra nếu người dùng đã ân nút Add thì mới xử lý
	if (isset($_POST["submit"])) {
		// lấy thông tin 
        $user_name = $_POST["user_name"];
		$raw_password = $_POST["password"];
		$address = $_POST["address"];
		$number_phone = $_POST["number_phone"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$user_name = strip_tags($user_name);
		$user_name  = addslashes($user_name );
		$raw_password = strip_tags($raw_password);
		$raw_password = addslashes($raw_password);
		$address = strip_tags($address);
		$address = addslashes($address);
		$number_phone = strip_tags($number_phone);
		$number_phone = addslashes($number_phone);
        $config = include('config/config.php');
        $password = sha1($raw_password.$config['key']);
	    //Gọi file connection.php 
	    require_once("lib/connection.php");
        //chuoi truy van
        $sql = "INSERT INTO `user`(`user_name`, `password`, `image`, `address`, `number_phone`, `role`) VALUES ('${user_name}', '${password}', 'default-user.png', '${address}', '${number_phone}', 1)";
        $query = mysqli_query($conn,$sql);
        if ($query) {
            ?>
            <script type="text/javascript">
                alert('Successful account registration. Sign in to continue');
            </script>
            <?php
		} else {
            ?>
            <script type="text/javascript">
                alert('failed try with another name. can use mail');
            </script>
             <?php
        }
	}
?>
    <div class="login-form">
        <form action="sign_up.php" method="POST">
            <h2 class="text-center">Sign up</h2>
            <div class="form-group">
                <input type="text" name="user_name" class="form-control" placeholder="Username" required="required"
                    maxlength="20" autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="required"
                    maxlength="20">
            </div>
            <div class="form-group">
                <input type="text" name="address" class="form-control" placeholder="address" required="required">
            </div>
            <div class="form-group">
                <input type="text" name="number_phone" class="form-control" placeholder="number_phone" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
            </div>
        </form>
        <p class="text-center"><a href="user_login.php">login</a></p>
        </div>
<?php
 include('footer.php');
?>
</body>
</html>