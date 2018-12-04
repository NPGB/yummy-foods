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
    <link rel="stylesheet" type="text/css" href="assets/css/admin.css">
    <link rel="stylesheet" typr="text/css" href="assets/css/admin_page.css">
    <link rel="stylesheet" type="text/css" href="assets/css/admin_all_product.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php
//Gọi file connection.php 
	require_once("lib/connection.php");
		// lấy thông tin 
		// Kiểm tra nếu người dùng đã ân nút search thì mới xử lý
		
	if (isset($_POST["search"])) {
		$name="";
		$search_text=$_POST["search_text"];
		if($_POST["name"]=="name") {
			if($_POST["sort"]=="ASC") {
				$name = "where `product_name` like '%$search_text%' ORDER BY `product_name` ASC";
			} else {
				$name = "where `product_name` like '%$search_text%' ORDER BY `product_name` DESC";
			}
		} 
		if ($_POST["name"]=="group_species") {
			if($_POST["sort"]=="ASC") {
				$name = "where `group_species` like  '%$search_text%' ORDER BY `product_name` ASC";
			} else {
				$name = "where `group_species` like  '%$search_text%' ORDER BY `product_name` DESC";
			}
		}
		if ($_POST["name"]=="price") {
			if($_POST["sort"]=="ASC") {
				$name = "where `product_price` <= $search_text ORDER BY `product_price` ASC";
			} else {
				$name = "where `product_price` <= $search_text ORDER BY `product_price` DESC";
			}
		}
	}
			$sql = "SELECT `product_id`, `product_name`, `product_price`, `unit`, `product_description`, `sold_out`, `group_species`, `supplier`, `img` FROM `product`	$name";
			$result = $conn->query($sql);// cach viet
	//}
?>
    <?php include 'admin_head_and_menu.php'; ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-lg-2">
                        <a href="admin_add_product.php" class="btn btn-sm btn-primary height-btn">Add New Product</a>
                    </div>
                    <div class="col-md-9 col-lg-10">
                        <!-- serach theo ten -->
                        <form action="admin_all_products.php" method="POST">
                            <div class="row">
                                <div class="col-12 col-md-8 col-lg-5">
                                    <input id="search_text" name="search_text" placeholder="search" class="form-control here"
                                        type="text">
                                </div>
                                <div class=" col-6 col-md-4 col-lg-3">
                                    <select name="sort" id="" class="custom-select">
                                        <option value="ASC" selected="selected">increase</option>
                                        <option value="DESC">decrease</option>
                                    </select>
                                </div>
                                <div class=" col-6 col-md-4 col-lg-3">
                                    <select name="name" id="" class="custom-select">
                                        <option value="name" selected="selected">name</option>
                                        <option value="group_species">categories</option>
                                        <option value="price">price</option>
                                    </select>
                                </div>
                                <div class=" col-12 col-md-4 col-lg-1   ">
                                    <button name="search" type="search" class="btn btn-sm btn-outline-primary height-btn">search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                        <?php
                            if ($result->num_rows > 0) {
                                // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                                // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                        while ($row = $result->fetch_assoc()): 
                            ?>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="admin_product.php?id=<?php echo htmlspecialchars($row['product_id']) ?>">
                                    <div class="a-product">
                                        <img class="img col-10" src="assets/img/product/	<?php echo htmlspecialchars($row['img']) ?>"
                                            alt="<?php echo htmlspecialchars($row['img']) ?>">
                                        <p class="text-name">
                                            <?php echo htmlspecialchars($row['product_name']); ?>
                                        </p>
                                        <p class="text-name">price:
                                            <?php echo htmlspecialchars($row['product_price']); ?>/
                                            <?php echo htmlspecialchars($row['unit']); ?>
                                            <?php if($row['sold_out'] == 1 ) echo '<span  style="color: red;">  sold out</span>' ?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        <?php 
                        endwhile; 
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
</body>

</html>