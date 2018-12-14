<?php
	session_start(); 
?>
<!DOCTYPE html>
<html>

<head>
    <title>sign in admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header-footer.css">
</head>

<body>
    <?php
$config = include('config/config.php'); 
include('config/page_config.php');
include('header.php');
	//Gọi file connection.php 
	require_once("lib/connection.php");
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["submit"])) {
		// lấy thông tin người dùng
		$user_name = $_POST["user_name"];
		$raw_password = $_POST["password"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$user_name = strip_tags($user_name);
		$user_name = addslashes($user_name);
		$raw_password = strip_tags($raw_password);
		$raw_password = addslashes($raw_password);
		
		// debug error
		// echo '<pre>';
		// print_r($user_name); die;
		$config = include('config/config.php');
        $password = sha1($raw_password.$config['key']);
			$sql = "select * from user where user_name = '$user_name' and password = '$password'";
			//$query = mysqli_query($conn,$sql);
			$result = $conn->query($sql);
			$num_rows = mysqli_num_rows($result);
			if ($num_rows==0) {
				?>
                <script type="text/javascript">
                    alert('tên đăng nhập hoặc mật khẩu không đúng !');
                </script>
                <?php
            } else {
                //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                /*if ($_POST["remenber_me"]==1) {
                    $_SESSION['user_name'] = $user_name;
                }*/
                while ($row = $result->fetch_assoc()): 
                    // $_SESSION['role'] = $row['role']; needn't
                    $_SESSION['image'] = $row['image'];
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                endwhile;
                    // Thực thi hành động sau khi lưu thông tin vào session
                    //  tiến hành chuyển hướng trang web tới một trang gọi là index.php
                header('Location: index.php');
            }
	}
?>
    <div class="login-form">
        <form action="user_login.php" method="POST">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" name="user_name" class="form-control" placeholder="Username" required="required"
                    maxlength="20" autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="required"
                    maxlength="20">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <div class="clearfix">
                <label class="pull-left checkbox-inline"><input type="checkbox"> Remember me</label>
                <a href="#" class="pull-right">Forgot Password?</a>
            </div>
        </form>
        <p class="text-center"><a href="sign_up.php">Create an Account</a></p>
    </div>
<?php
 include('footer.php');
?>
</body>

</html>