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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
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
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h4>Add New User</h4>
                    </div>
                    <div class="col-md-7">
                        <a href="add_new_user.php" class="btn btn-sm btn-primary">Add New</a>
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
								while ($row = $result->fetch_assoc()): 
							?>
                            <div class="a-product">
                                <a href="user.php?id=<?php echo htmlspecialchars($row['user_id']) ?>">
                                    <img class="img" src="assets/img/user/<?php echo htmlspecialchars($row['image']) ?>"
                                        alt="<?php echo htmlspecialchars($row['image']) ?>">
                                </a>
                                <p class="text-name">
                                    <?php echo htmlspecialchars($row['user_name']); ?>
                                </p>
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
                        </div>
                        <div class="card mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-light ">Featured Image</div>
                            <div class="card-body">
                            </div>
                            <div class="card-footer bg-light">
                                <a href="#">Set Featured Image</a>
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