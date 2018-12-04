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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
//Gọi file connection.php 
	require_once("lib/connection.php");
    // list user
        $user_id = $_SESSION['user_id'];
			$sql = "SELECT * FROM `user` WHERE `user_id`= '${user_id}'";
			$result = $conn->query($sql);// cach viet
	//}
?>
    <?php include 'admin_head_and_menu.php'; ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h4>User Info</h4>
                    </div>
                    <div class="col-md-7">
                        <button type="button" class="btn btn-sm btn-primary">??</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12   ">
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
                                            <input id="text" name="password" value="chicken" class="form-control here" required="required"
                                            type="password" maxlength="50" >
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