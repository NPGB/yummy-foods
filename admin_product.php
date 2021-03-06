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
    <link rel="stylesheet" type="text/css" href="assets/css/admin_product.css">
    <link rel="stylesheet" typr="text/css" href="assets/css/admin_page.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php
    //Gọi file connection.php 
	require_once("lib/connection.php");
	// Kiểm tra nếu người dùng đã ân nút Add thì mới xử lý
    //kiem tra nguoi dung chon edit thi
    if (isset($_POST["edit"])) {
        //kiem tra quyen
        if ($_SESSION['role']<4) {
            header('location: warning_for_role.php');
            exit();
        }
		// lấy thông tin 
		$product_name = $_POST["product_name"];
		$product_price = $_POST["product_price"];
		$unit = $_POST["unit"];
		$product_description = $_POST["product_description"];
		$quantity = $_POST["quantity"];
		$group_species = $_POST["group_species"];
		$supplier = $_POST["supplier"];
        $img = $_POST["img"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$product_name = strip_tags($product_name);
		$product_name  = addslashes($product_name );
		$product_price = strip_tags($product_price);
		$product_price = addslashes($product_price);
		$unit = strip_tags($unit);
		$unit = addslashes($unit);
		$product_description = strip_tags($product_description);
		$product_description = addslashes($product_description);
		$quantity = strip_tags($quantity);
		$quantity = addslashes($quantity);
		$group_species = strip_tags($group_species);
		$group_species = addslashes($group_species);
		$supplier = strip_tags($supplier);
		$supplier = addslashes($supplier);
		$img = strip_tags($img);
        $img = addslashes($img);
        $id = $_GET["id"];
		if ($img == null) {
            $sql = "UPDATE `product` SET `product_name`='${product_name}',`product_price`='${product_price}',`unit`='${unit}',`product_description`='${product_description}',`quantity`='${quantity}',`group_species`='${group_species}',`supplier`='${supplier}' WHERE `product_id` = '${id}'";
        } else {
            $sql = "UPDATE `product` SET `product_name`='${product_name}',`product_price`='${product_price}',`unit`='${unit}',`product_description`='${product_description}',`quantity`='${quantity}',`group_species`='${group_species}',`supplier`='${supplier}',`img`='${img}' WHERE `product_id` = '${id}'";
        }
			$query = mysqli_query($conn,$sql);
			if ($query) {
				?>
    <script type="text/javascript">
        alert('have successfully edited the product');
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
        //kiem tra quyen
        if ($_SESSION['role']<4) {
            header('location: warning_for_role.php');
            exit();
        }
        $id = $_GET["id"];
			$sql = "DELETE FROM `product` WHERE  `product_id` = '${id}'";
			$query = mysqli_query($conn,$sql);
			if ($query) {
				?>
    <script type="text/javascript">
        alert('have successfully delete the product');
    </script>
    <?php
        header('Location: admin_all_products.php');
			}else{
				?>
    <script type="text/javascript">
        alert('failer');
    </script>
    <?php
			}
    }
    // list san pham neu co
        $id = $_GET["id"];
			$sql = "SELECT *     FROM `product` WHERE `product_id`= '${id}'";
			$result = $conn->query($sql);// cach viet
	//}
?>
    <?php include 'admin_head_and_menu.php'; ?>
        <div class="card">
            <div class="card-body">
                <h4>chi tiet san pham</h4>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <?php
                        if ($result->num_rows > 0) {
                            // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                            // do đó cần sử dụng vòng lặp While để lặp qua toàn bộ dữ liệu trên bảng posts
                            $row = $result->fetch_assoc();
                            ?>
                        <div class="a-product">
                            <form method="POST" action="admin_product.php?id=<?php echo htmlspecialchars($row['product_id']) ?>" onSubmit="return confirmED()">
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Product Name:</label>
                                    <div class="col-12">
                                        <input id="text" name="product_name" value="<?php echo htmlspecialchars($row["product_name"]) ?>" class="form-control here" required="required"
                                        type="text" maxlength="100">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group row">
                                            <label for="text" class="col-12 col-form-label">Product Price 1 unit:</label>
                                            <div class="col-12">
                                                <input id="number" name="product_price" value="<?php echo htmlspecialchars($row["product_price"]) ?>" class="form-control here" required="required"
                                                type="text" min="1000" max="100000">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-group row">
                                            <label for="text" class="col-12 col-form-label">Unit:</label>
                                            <div class="col-12">
                                                <input id="text" name="unit" value="<?php echo htmlspecialchars($row["unit"]) ?>" class="form-control here" required="required" type="text"
                                                maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-group row">
                                            <label for="text" class="col-12 col-form-label">quantity:</label>
                                            <div class="col-12">
                                            <input id="text" name="quantity" value="<?php echo htmlspecialchars($row["quantity"]) ?>" class="form-control here" required="required" type="number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="text" class="col-12 col-form-label">group_species:</label>
                                            <div class="col-12">
                                                <select name="group_species" class="custom-select">
                                                    <option value="snacks" <?php if($row["group_species"]=="snacks" ) echo
                                                        "selected=\" selected\"" ?>>snacks</option>
                                                    <option value="drinks" <?php if($row["group_species"]=="drinks" ) echo
                                                        "selected=\" selected\"" ?>>drinks</option>
                                                    <option value="milk tea" <?php if($row["group_species"]=="milk tea" )
                                                        echo "selected=\" selected\"" ?>>milk tea</option>
                                                    <option value="fruits" <?php if($row["group_species"]=="fruits" ) echo
                                                        "selected=\" selected\"" ?>>fruits</option>
                                                    <option value="Fruit beams" <?php if($row["group_species"]=="Fruit beams"
                                                        ) echo "selected=\" selected\"" ?>>Fruit beams</option>
                                                    <option value="other" <?php if($row["group_species"]=="other" ) echo
                                                        "selected=\" selected\"" ?>>other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group row">
                                            <label for="text" class="col-12 col-form-label">supplier:</label>
                                            <div class="col-12">
                                                <input id="text" name="supplier" value="<?php echo htmlspecialchars($row["supplier"]) ?>" class="form-control here" type="text" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="text" class="col-12 col-form-label">Image of Product:</label>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="file" name="img"  placeholder="choose img"  value="<?php echo htmlspecialchars($row["img"]) ?>" class="form-control-file" id="exampleFormControlFile1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="textarea" class="col-12 col-form-label">Product Description:</label>
                                    <div class="col-12">
                                        <textarea id="textarea" name="product_description" placeholder="<?php echo htmlspecialchars($row["product_description"]) ?>" cols="40" rows="5" class="form-control" maxlength="1000"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="add" name="delete" onclick="funcDelete()" class="btn btn-sm btn-outline-danger" style="float: right;">Delete</button>
                                    <button type="add" name="edit" onclick="funcEdit()" class="btn btn-sm btn-outline-warning" style="float: right;">Edit</button>
                                </div>
                            </form>
                        </div>
                    <?php
                        // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
                        mysqli_free_result($query);
                        }
                        else {
                            echo "There are no products";
                        }	
                    ?>
                </div>
                <div class="col-md-4">
                    <img class="img" style="width:100%;" src="assets/img/product/<?php echo htmlspecialchars($row['img']) ?>"
                    alt="<?php echo htmlspecialchars($row['product_name']); ?> img">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var noti = '';
    function funcDelete() {
        noti='are you sure delete this product';
    }

    function funcEdit() {
        noti='are you sure edit this product';
    }

    function confirmED() {
        return confirm(noti);
    }
</script>
</body>

</html>