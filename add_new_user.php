<!DOCTYPE html>
<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['admin_name'])) {
	 header('Location: login.php');
	 exit();
}
?>
<html>

<head>
    <title>admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/add_new_user.css">
    <link rel="stylesheet" typr="text/css" href="assets/css/admin_page.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous">
    </script>
</head>

<body>
    <?php
    //kiem tra quyen
    if ($_SESSION['role']!=5) {
        header('location: logout.php');
        exit();
    }
	//Gọi file connection.php 
	require_once("lib/connection.php");
	// Kiểm tra nếu người dùng đã ân nút Add thì mới xử lý
	if (isset($_POST["add"])) {
		// lấy thông tin 
		$user_name = $_POST["user_name"];
		$raw_password = $_POST["password"];
		$image = $_POST["image"];
		$address = $_POST["address"];
		$number_phone = $_POST["number_phone"];
		$role = $_POST["role"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$user_name = strip_tags($user_name);
		$user_name  = addslashes($user_name );
		$raw_password = strip_tags($raw_password);
		$raw_password = addslashes($raw_password);
		$image = strip_tags($image);
		$image = addslashes($image);
		$address = strip_tags($address);
		$address = addslashes($address);
		$number_phone = strip_tags($number_phone);
		$number_phone = addslashes($number_phone);
		$role = strip_tags($role);
        $role = addslashes($role);
        $config = include('config/config.php');
        $password = sha1($raw_password.$config['key']);
        $user_id = $_GET["id"];
        //chuoi truy van
        $sql = "INSERT INTO `user`(`user_name`, `password`, `image`, `address`, `number_phone`, `role`) VALUES ('${user_name}','${password}','${image}','${address}','${number_phone}','${role}')";
        $query = mysqli_query($conn,$sql);
        if ($query) {
            ?>
    <script type="text/javascript">
        alert('have successfully added the new user');
    </script>
    <?php
		} else {
            ?>
    <script type="text/javascript">
        alert('failer');
    </script>
    <?php
        }
	}
?>
    <?php include 'admin_head_and_menu.php'; ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h4>Add New Product</h4>
                    </div>
                    <div class="col-md-7">
                        <button type="button" class="btn btn-sm btn-primary">Add New</button>
                        <!-- chua su li si kien cho button nay -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-9">
                        <form method="POST" action="add_new_user.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">User name:</label>
                                        <div class="col-12">
                                            <input id="text" name="user_name" placeholder="Enter User Name" class="form-control here"
                                                required="required" type="text" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">password:</label>
                                        <div class="col-12">
                                            <input id="text" name="password" placeholder="Enter Password" class="form-control here"
                                                required="required" type="password" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Address:</label>
                                        <div class="col-12">
                                            <input id="text" name="address" placeholder="Enter Your Address" class="form-control here"
                                                required="required" type="text" maxlength="120">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Number phone:</label>
                                        <div class="col-12">
                                            <input id="text" name="number_phone" placeholder="Enter Your Number phone" class="form-control here"
                                                required="required" type="number" maxlength="11">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">image:</label>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <input type="file" name="image"   class="form-control-file" id="exampleFormControlFile1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">role:</label>
                                        <div class="col-12">
                                            <input id="text" name="role" placeholder="Enter role" class="form-control here"
                                                type="number" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="add" name="add" class="btn btn-outline-primary" style="float: right;">add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>