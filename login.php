<?php
	session_start(); /*khoi tao session de su dung*/
	if(isset($_SESSION['admin_name'])) {
		header('Location: admin.php');
		exit();
	}
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
</head>

<body>
    <?php
	//Gọi file connection.php 
	require_once("lib/connection.php");
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["submit"])) {
		// lấy thông tin người dùng
		$admin_name = $_POST["admin_name"];
		$raw_password = $_POST["password"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$admin_name = strip_tags($admin_name);
		$admin_name = addslashes($admin_name);
		$raw_password = strip_tags($raw_password);
		$raw_password = addslashes($raw_password);
		
		// debug error
		// echo '<pre>';
		// print_r($admin_name); die;
		$config = include('config/config.php');
        $password = sha1($raw_password.$config['key']);
			$sql = "select * from user where user_name = '$admin_name' and password = '$password'";
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
					$_SESSION['admin_name'] = $admin_name;
				}*/
				while ($row = $result->fetch_assoc()): 
					$_SESSION['role'] = $row['role'];
					$_SESSION['image'] = $row['image'];
					$_SESSION['user_id'] = $row['user_id'];
				endwhile;
				if($_SESSION['role']==1){
					?>
    <script type="text/javascript">
        alert('yeu cau user co quyen cao hon !');
    </script>
    <?php
				} else {
				$_SESSION['admin_name'] = $admin_name;
					// Thực thi hành động sau khi lưu thông tin vào session
					//  tiến hành chuyển hướng trang web tới một trang gọi là index.php
					header('Location: admin.php');
				}
			}
	}
?>
    <div class="login-form">
        <form action="login.php" method="POST">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" name="admin_name" class="form-control" placeholder="Username" required="required"
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
        <p class="text-center"><a href="#">Create an Account</a></p>
    </div>
</body>

</html>