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
	if (isset($_POST["add"])) {
        //kiem tra quyen co duoc them hay khong
        if ($_SESSION['role']<3) {
            header('location: warning_for_role.php');
            exit();
        }
		// lấy thông tin người dùng
		$product_name = $_POST["product_name"];
		$product_price = $_POST["product_price"];
		$unit = $_POST["unit"];
		$product_description = $_POST["product_description"];
		$amount = $_POST["amount"];
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
		$amount = strip_tags($amount);
		$amount = addslashes($amount);
		$group_species = strip_tags($group_species);
		$group_species = addslashes($group_species);
		$supplier = strip_tags($supplier);
		$supplier = addslashes($supplier);
		$img = strip_tags($img);
        $img = addslashes($img);
        if ($img==null) {
            $img = 'noimg.png';
        }
            $sql = "INSERT INTO `product`(`product_name`, `product_price`, `unit`, `product_description`, `amount`, `group_species`, `supplier`, `img`) VALUES ('${product_name}', '${product_price}', '${unit}', '${product_description}', '${amount}', '${group_species}', '${supplier}', '${img}')";
			$query = mysqli_query($conn,$sql);
			if ($query) {
				?>
            <script type="text/javascript">
                alert('have successfully added the product');
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
                <hr>
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <form method="POST" action="admin_add_product.php">
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Enter Product Name:</label>
                                <div class="col-12">
                                    <input id="text" name="product_name" placeholder="Enter Product Name here" class="form-control here"
                                        required="required" type="text" maxlength="100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Enter Product Price 1 unit:</label>
                                        <div class="col-12">
                                            <input id="number" name="product_price" placeholder="Enter Product Price here"
                                                class="form-control here" required="required" type="text" min="1000" max="100000">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">Enter Unit:</label>
                                        <div class="col-12">
                                            <input id="text" name="unit" placeholder="Enter unit here" class="form-control here"
                                                required="required" type="text" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">amount:</label>
                                        <div class="col-12">
                                        <input id="text" name="amount" value="0" class="form-control here" required="required" type="number">
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
                                                <option value="snacks">snacks</option>
                                                <option value="drinks">drinks</option>
                                                <option value="milk tea">milk tea</option>
                                                <option value="fruits">fruits</option>
                                                <option value="Fruit beams">Fruit beams</option>
                                                <option value="other">other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group row">
                                        <label for="text" class="col-12 col-form-label">supplier:</label>
                                        <div class="col-12">
                                            <input id="text" name="supplier" placeholder="Enter supplier" class="form-control here"
                                                type="text" maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Image of Product:</label>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="file" name="img"  class="form-control-file" id="exampleFormControlFile1">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="textarea" class="col-12 col-form-label">Enter Product Description:</label>
                                <div class="col-12">
                                    <textarea id="textarea" name="product_description" cols="40" rows="5" class="form-control"
                                        maxlength="1000"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="add" name="add" class="btn btn-sm btn-primary" style="float: right;">Add
                                    New</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 ">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>