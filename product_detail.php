<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header-footer.css">
    <link rel="stylesheet" href="assets/css/product_detail.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <?php 
        $config = include('config/config.php'); 
        include('config/page_config.php');
        include('header.php');
    ?>
    <section class="">
        <div class="container">
           <div class="row">
           <?php
            require_once("lib/connection.php");
            $id =$_GET['id'];
            $sql = "SELECT * FROM `product` WHERE `product_id` = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Hàm `mysql_fetch_row()` sẽ chỉ fetch dữ liệu một record mỗi lần được gọi
                $row = $result->fetch_assoc();
                ?>
                    <div class="col-12 col-md-6">
                        <img class="img-pr" src="assets/img/product/<?php echo $row['img'] ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?> img">
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="detail">
                            <h2><?php echo $row['product_name'] ?></h2>
                            <h5>price: <?php echo $row['product_price'] ?>d/<?php echo $row['unit'];
                            if($row['quantity']==0) {echo ' <span style="color:red;">sold out</span>'; } ?></h5>
                            <h5>species: <?php echo $row['group_species'] ?></h5>
                            <h5>supplier: <?php echo $row['supplier'] ?></h5>
                            <p>desciption:<?php echo $row['product_description'] ?></p>
                        </div>
                        <div class="">
                            <div class="detail">
                                <div class="line-block">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                    <i class="fas fa-minus-square"></i>
                                    </button>
                                    <input type="text" id="quantity" name="quantity" class="input-number max-w" value="1" min="1" max="100">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                    <i class="fas fa-plus-square"></i>
                                    </button>
                                </div>
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
                                            ?>
                                            <div class="line-block vertical-mid" id="cart" onclick="var a = document.getElementById('quantity').value;loadDoc('addtocart.php?product_id=<?php echo $id ?>&quantity='+a, addtocart)">
                                                <i class="fas fa-cart-plus icon-cart"></i>
                                            </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                // Máy tính sẽ lưu kết quả từ việc truy vấn dữ liệu bảng
                // Do đó chúng ta nên giải phóng bộ nhớ sau khi hoàn tất đọc dữ liệu
                mysqli_free_result($query);
                } else {
                    echo "<p>This product is not available</p>";
                }	
            ?>
           </div>
        </div>
    </section>
    <?php
        include('footer.php');
    ?>
</body>
<script type="text/javascript">
	$(document).ready(function(){

	var quantitiy=0;
	   $('.quantity-right-plus').click(function(e){
	        
	        // Stop acting like a button
	        e.preventDefault();
	        // Get the field name
	        var quantity = parseInt($('#quantity').val());
	        
	        // If is not undefined
	            
	            $('#quantity').val(quantity + 1);

	          
	            // Increment
	        
	    });

	     $('.quantity-left-minus').click(function(e){
	        // Stop acting like a button
	        e.preventDefault();
	        // Get the field name
	        var quantity = parseInt($('#quantity').val());
	        
	        // If is not undefined
	      
	            // Increment
	            if(quantity>0){
	            $('#quantity').val(quantity - 1);
	            }
	    });
	    
    });
    function loadDoc(url, cFunction) {
        var xhttp = new XMLHttpRequest(url, cFunction);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                cFunction(this);
            // document.getElementById("products").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }

    function addtocart(xhttp) {
        document.getElementById('cart').innerHTML = 'added to shopping cart';
    } 
</script>
</html>