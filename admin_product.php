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
        // hoi lai co chac muon edit
        ?>
    <script type="text/javascript">
        alert('Are you sure you want to edit this product?');
    </script>
    <?php
		// lấy thông tin 
		$product_name = $_POST["product_name"];
		$product_price = $_POST["product_price"];
		$unit = $_POST["unit"];
		$product_description = $_POST["product_description"];
		$sold_out = $_POST["sold_out"];
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
		$sold_out = strip_tags($sold_out);
		$sold_out = addslashes($sold_out);
		$group_species = strip_tags($group_species);
		$group_species = addslashes($group_species);
		$supplier = strip_tags($supplier);
		$supplier = addslashes($supplier);
		$img = strip_tags($img);
        $img = addslashes($img);
        $id = $_GET["id"];
			$sql = "UPDATE `product` SET `product_name`='${product_name}',`product_price`='${product_price}',`unit`='${unit}',`product_description`='${product_description}',`sold_out`='${sold_out}',`group_species`='${group_species}',`supplier`='${supplier}',`img`='${img}' WHERE `product_id` = '${id}'";
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
        // hoi lai co chac muon delete
        ?>
    <script type="text/javascript">
        alert('Are you sure you want to delete this product?');
    </script>
    <?php
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
			$sql = "SELECT `product_id`, `product_name`, `product_price`, `unit`, `product_description`, `sold_out`, `group_species`, `supplier`, `img` FROM `product` WHERE `product_id`= '${id}'";
			$result = $conn->query($sql);// cach viet
	//}
?>
    <?php include 'admin_head_and_menu.php'; ?>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <h4>Add New Post</h4>
                    </div>
                    <div class="col-md-7">
                        <button type="button" class="btn btn-sm btn-primary">Add New</button>
                    </div>

                </div>
                <hr>
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
                            <div class="a-product">
                                <img class="img" style="max-width:400px;" src="assets/img/product/<?php echo htmlspecialchars($row['img']) ?>"
                                    alt="<?php echo htmlspecialchars($row['img']) ?>">
                                <form method="POST" action="admin_product.php?id=<?php echo htmlspecialchars($row['product_id']) ?>">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Product Name:</label>
                                        <div class="col-12">
                                            <input id="text" name="product_name" value="<?php echo htmlspecialchars($row["product_name"]) ?>" class="form-control here" required="required"
                                            type="text" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Product Price 1 unit:</label>
                                        <div class="col-12">
                                            <input id="number" name="product_price" value="<?php echo htmlspecialchars($row["product_price"]) ?>" class="form-control here" required="required"
                                            type="text" min="1000" max="100000">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Unit:</label>
                                        <div class="col-12">
                                            <input id="text" name="unit" value="<?php echo htmlspecialchars($row["unit"]) ?>" class="form-control here" required="required" type="text"
                                            maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">sold_out:</label>
                                        <div class="col-12">
                                            <input type="radio" name="sold_out" value="1" <?php if($row["sold_out"]==1)
                                                echo "checked=\" checked\"" ?>>True
                                            <input type="radio" name="sold_out" value="0" <?php if($row["sold_out"]==0)
                                                echo "checked=\" checked\"" ?>>False
                                        </div>
                                    </div>
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
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">supplier:</label>
                                        <div class="col-12">
                                            <input id="text" name="supplier" value="<?php echo htmlspecialchars($row["supplier"]) ?>" class="form-control here" type="text" maxlength="50">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Image of Product:</label>
                                        <div class="col-12">
                                            <input id="text" name="img" value="<?php echo htmlspecialchars($row["img"]) ?>" class="form-control here" type="text" maxlength="30" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="textarea" class="col-12 col-form-label">Product Description:</label>
                                        <div class="col-12">
                                            <textarea id="textarea" name="product_description" placeholder="<?php echo htmlspecialchars($row["product_description"]) ?>" cols="40" rows="5" class="form-control" maxlength="1000"></textarea>
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
                            <div class="card-header bg-light ">Publish</div>
                            <div class="card-body">

                            </div>
                            <div class="card-footer bg-light">
                                <button type="button" class="btn btn-outline-secondary btn-sm">Preview</button>
                                <button type="button" class="btn btn-info btn-sm">Save Draft</button>
                                <button type="button" class="btn btn-primary btn-sm">Publish</button>
                            </div>
                        </div>
                        <div class="card mb-3" style="max-width: 18rem;">
                            <div class="card-header bg-light ">Tags</div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group row">
                                        <div class="col-9">
                                            <input id="tags" name="tags" placeholder="seperate with commas" required="required"
                                                class="form-control here" type="text">
                                        </div>
                                        <div class=" col-2">
                                            <button name="submit" type="submit" class="btn btn-light">Add</button>
                                        </div>
                                        <div class="col-12">
                                            <small>Seperate Tags with commas</small>
                                        </div>
                                    </div>
                                </form>


                            </div>
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
</body>

</html>