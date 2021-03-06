<?php
//Gọi file connection.php 
	require_once("lib/connection.php");
		// lấy thông tin 
		// Kiểm tra nếu người dùng đã ân nút search thì mới xử lý
    $search_text='%';
    $category='%';
    if ($_GET['search_text']!='') {
        $search_text=$_GET['search_text'];
    }
    if (isset($_GET['category'])) {
        $category=$_GET['category'];
    }
    $name = "where `group_species` like '$category' AND `product_name` like '%$search_text%' ";
    $sql = "SELECT `product_id`, `product_name`, `product_price`, `unit`, `quantity`, `group_species`, `img` FROM `product`	$name  ORDER BY `product`.`quantity` DESC";
    $result = $conn->query($sql);// cach viet
?>
<?php
if ($result->num_rows > 0) {
// Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
// do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
    while ($row = $result->fetch_assoc()): 
    ?>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
            <div class="content content-align <?php
                switch ($row['group_species']) {
                    case 'milk tea':
                        echo 'p';
                        break;
                    case 'fruits':
                        echo 'gr';
                        break;
                    case 'snacks':
                        echo 'y';
                        break;
                    case 'fruit beam':
                        echo 'r';
                        break;
                    case 'drink':
                        echo 'b';
                        break;
                    default:
                        echo 'bl';
                        break;
                } 
            ?>">
                <a class="none-decor" href="product_detail.php?id=<?php echo htmlspecialchars($row['product_id']) ?>" target="_blank">
                    <img class="img-att" src="assets/img/product/<?php echo htmlspecialchars($row['img']) ?>"
                    alt="<?php echo htmlspecialchars($row['product_name']); ?> img">
                    <p class="text-att"><?php echo htmlspecialchars($row['product_name']); ?></p>
                    <p class="text-att">giá:<?php echo htmlspecialchars($row['product_price']); ?>đ/<?php echo htmlspecialchars($row['unit']); ?></p>
                </a>
                    <?php 

                        if($row['quantity'] == 0 ) {
                            echo '<span class="text-color-r">sold out</span>';
                        }    else {
                            $id = $row['product_id'];
                            session_start();
                            ob_start();
                            if(isset($_SESSION['cart'][$id])) {
                                echo 'added to shopping cart';
                            } else {
                                echo '<div id="'.$row['product_id'].'" onclick="setid(this.id);loadDoc(\'addtocart.php?product_id='.$row['product_id'].'\', addtocart)" style="margin-top: 5px; color: #49a2b8;">
                                <i class="fas fa-cart-plus icon-cart cart"></i><p class="inline-block">add to cart</p></div>';
                            }
                        }

                    ?>
            </div>
        </div>
    <?php 
    endwhile; 
        // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
        // Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
    mysqli_free_result($query);
    } else {
        echo "<h2>There are no products</h2>";
    }	
?>