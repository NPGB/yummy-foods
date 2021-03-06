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
    <link rel="stylesheet" typr="text/css" href="assets/css/admin_page.css">
    <link rel="stylesheet" type="text/css" href="assets/css/users.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php
    //kiem tra quyen
    if ($_SESSION['role']!=5) {
        header('location: warning_for_role.php');
        exit();
    }
    //Gọi file connection.php 
	require_once("lib/connection.php");
		// lấy thông tin người dùng
			$sql = "SELECT * FROM `user` WHERE 1";
			$query = mysqli_query($conn,$sql);
			$result = $conn->query($sql);// cach viet
	//}
?>
    <?php include 'admin_head_and_menu.php'; ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h4>Add New User</h4>
                    </div>
                    <div class="col-md-7">
                        <a href="add_new_user.php" class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i> Add New</a>
                    </div>
                </div>
                <div class="">
                        <?php
							if ($result->num_rows > 0) {
							?>
                        <div class="row">
                            <?php
								// Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
								// do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
								while ($row = $result->fetch_assoc()): 
							?>
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                <a href="user.php?id=<?php echo htmlspecialchars($row['user_id']) ?>">
                                    <img class="img" src="assets/img/user/<?php echo htmlspecialchars($row['image']) ?>"
                                        alt="<?php echo htmlspecialchars($row['image']) ?>">
                                    <p class="text-name">
                                        <?php echo htmlspecialchars($row['user_name']); ?>
                                    </p>
                                </a>
                                
                            </div>
                            <?php 
								endwhile; 
							?>
                        </div>
                        <?php
								// Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
								// Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
								mysqli_free_result($query);
								}
							?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>