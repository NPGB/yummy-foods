<!DOCTYPE html>
<?php
session_start();
ob_start();
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
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/user.css">
    <link rel="stylesheet" typr="text/css" href="assets/css/admin_page.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous">
    </script>
</head>

<body>
    <?php
    // kiem tra quyen
    if ($_SESSION['role']!=5) {
        header('location: warning_for_role.php');
        ?>
        <?php
        exit();
    }
//Gọi file connection.php 
	require_once("lib/connection.php");
	// Kiểm tra nếu người dùng đã ân nút Add thì mới xử lý
    //kiem tra nguoi dung chon edit thi
    if (isset($_POST["edit"])) {
        // hoi lai co chac muon edit
        ?>
    <script type="text/javascript">
        alert('Are you sure you want to edit this user?');
    </script>
    <?php
		// lấy thông tin 
		$user_name = $_POST["user_name"];
		$password = $_POST["password"];
		$image = $_POST["image"];
		$address = $_POST["address"];
		$number_phone = $_POST["number_phone"];
		$role = $_POST["role"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$user_name = strip_tags($user_name);
		$user_name  = addslashes($user_name );
		$password = strip_tags($password);
		$password = addslashes($password);
		$image = strip_tags($image);
		$image = addslashes($image);
		$address = strip_tags($address);
		$address = addslashes($address);
		$number_phone = strip_tags($number_phone);
		$number_phone = addslashes($number_phone);
		$role = strip_tags($role);
		$role = addslashes($role);
        $user_id = $_GET["id"];
			$sql = "UPDATE `user` SET `user_name`='${user_name}',`password`='${password}',`image`='${image}',`address`='${address}',`number_phone`='${number_phone}',`role`='${role}' WHERE `user_id` = '${user_id}'";
			$query = mysqli_query($conn,$sql);
			if ($query) {
				?>
    <script type="text/javascript">
        alert('have successfully edited this user');
    </script>
    <?php
			}else{
				?>
    <script type="text/javascript">
        alert('failer');
    </script>
    <?php
			}
    }
    // kiem tra neu la delete thi thuc hien
    if (isset($_POST["delete"])) {
        // hoi lai co chac muon delete
        ?>
    <script type="text/javascript">
        alert('Are you sure you want to delete this user?');
    </script>
    <?php
        $user_id = $_GET["id"];
	$sql = "DELETE FROM `user` WHERE `user_id` = '${user_id}'";
			$query = mysqli_query($conn,$sql);
			if ($query) {
				?>
    <script type="text/javascript">
        alert('have successfully delete the user');
    </script>
    <?php
                header('Location: users.php');
			}else{
				?>
    <script type="text/javascript">
        alert('failer');
    </script>
    <?php
			}
    }
    // list san pham neu co
        $user_id = $_GET["id"];
			$sql = "SELECT * FROM `user` WHERE `user_id`= '${user_id}'";
			$result = $conn->query($sql);// cach viet
	//}
?>
    <?php include 'admin_head_and_menu.php'; ?>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h4>Add New User</h4>
                    </div>
                    <div class="col-md-7">
                        <button type="button" class="btn btn-sm btn-primary">Add New</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <?php
                                    if ($result->num_rows > 0) {
                                ?>
                        <div>
                            <?php
								// Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
								// do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
								$row = $result->fetch_assoc();
								?>
                            <div class="a_user_name">
                                <img class="img" style="max-width:400px;" src="assets/img/user/<?php echo htmlspecialchars($row['image']) ?>"
                                    alt="<?php echo htmlspecialchars($row['image']) ?>">
                                <form method="POST" action="user.php?id=<?php echo htmlspecialchars($row['user_id']) ?>">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">User name:</label>
                                        <div class="col-12">
                                            <input id="text" name="user_name" value="<?php echo htmlspecialchars($row["user_name"]) ?>" class="form-control here" required="required"
                                            type="text" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">password:</label>
                                        <div class="col-12">
                                            <input id="text" name="password" value="<?php echo htmlspecialchars($row["password"]) ?>" class="form-control here" required="required"
                                            type="text" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Address:</label>
                                        <div class="col-12">
                                            <input id="text" name="address" value="<?php echo htmlspecialchars($row["address"]) ?>" class="form-control here" required="required"
                                            type="text" maxlength="120">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Number phone:</label>
                                        <div class="col-12">
                                            <input id="text" name="number_phone" value="<?php echo htmlspecialchars($row["number_phone"]) ?>" class="form-control here" required="required"
                                            type="number" maxlength="11">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">image:</label>
                                        <div class="col-12">
                                            <input id="text" name="image" value="<?php echo htmlspecialchars($row["image"]) ?>" class="form-control here" type="text" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">role:</label>
                                        <div class="col-12">
                                            <input id="text" name="role" value="<?php echo htmlspecialchars($row["role"]) ?>" class="form-control here" type="number" maxlength="10" >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="add" name="delete" class="btn btn-sm btn-outline-danger" style="float: right;">Delete</button>
                                        <button type="add" name="edit" class="btn btn-sm btn-outline-warning" style="float: right;">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
								// Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
								// Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
								mysqli_free_result($query);
								}
								else {
									echo "There are no products";
								}	
								?>
                    </div>
                    <div class="col-md-4 ">
                        <div class="card mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-light ">Categories</div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group row">
                                        <div class="col-9">
                                            <input id="tags" name="tags" placeholder=" " required="required" class="form-control here"
                                                type="text">
                                        </div>
                                        <div class=" col-2">
                                            <button name="submit" type="submit" class="btn btn-light">Add</button>
                                        </div>
                                    </div>
                                </form>
                                <form>
                                    <div class="form-group row">
                                        <label for="select" class="col-12 col-form-label">Select Category</label>
                                        <div class="col-8">
                                            <select id="select" name="select" class="custom-select" required="required">
                                                <option value="rabbit">Rabbit</option>
                                                <option value="duck">Duck</option>
                                                <option value="fish">Fish</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light">
                                <button type="button" class="btn btn-primary btn-sm">Add New Category</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>

</html>