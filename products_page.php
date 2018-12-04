<?php
//Gọi file connection.php 
	require_once("lib/connection.php");
		// lấy thông tin 
		// Kiểm tra nếu người dùng đã ân nút search thì mới xử lý
    $search_text='%';
    $category='%';
	if (isset($_POST["search"])) {
        $search_text=$_POST['search_text'];
    }
    if (isset($_GET['category'])) {
        $category=$_GET['category'];
    }
    $name = "where `group_species` like '$category' AND `product_name` like '%$search_text%' ";
    $sql = "SELECT `product_id`, `product_name`, `product_price`, `unit`, `sold_out`, `img` FROM `product`	$name  ORDER BY `product`.`sold_out` ASC";
    $result = $conn->query($sql);// cach viet
?>
<div>
    <div class="direct-bar">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <?php 
                    foreach ($species as $key => $value) {
                            ?>
                            <a class="btn btn-outline-primary" href="index.php?category=<?php echo $value ?>"<?php if($value==$category) {echo" style=\"color:red;\"";} ?>><?php echo $key ?></a>
                            <?php
                        }
                    ?>
                </div>
                <div class="col-12 col-md-4">
                    <form id="search" action="index.php?category=<?php echo $category ?>" method="POST">
                        <table>
                            <tr>
                                <td><input class="form-control" type="text" name="search_text" placeholder="enter name"></td>
                                <td><button class="btn btn-primary" type="submit" name="search">Search</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
                if ($result->num_rows > 0) {
            // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
            // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                while ($row = $result->fetch_assoc()): 
                ?>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="content-center content-align">
                            <a href="admin_product.php?id=<?php echo htmlspecialchars($row['product_id']) ?>">
                                <img class="img-att" src="assets/img/product/	<?php echo htmlspecialchars($row['img']) ?>"
                                    alt="<?php echo htmlspecialchars($row['img']) ?>">
                            </a>
                            <p class="text-att"><?php echo htmlspecialchars($row['product_name']); ?></p>
                            <p class="text-att">gia:
                                <?php echo htmlspecialchars($row['product_price']); ?>đ/
                                <?php echo htmlspecialchars($row['unit']); ?>
                                <?php if($row['sold_out'] == 1 ) echo '<span class="text-att"  style="color: red;">  sold out</span>' ?>
                            </p>
                        </div>
                    </div>
                <?php 
                endwhile; 
                    // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
                    // Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
                mysqli_free_result($query);
                } else {
                    echo "There are no products";
                }	
            ?>
        </div>
    </div>
</div>  