<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/header-footer.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    <?php 
        session_start();
        ob_start();
        $config = include('config/config.php'); 
        include('config/page_config.php');
        include('header.php');
        require_once("lib/connection.php");
        if(isset($_POST['order'])) {
            $id =$_GET['id'];
            $sql = "INSERT INTO `orders`(`user_id`, `date_time`, `status`) VALUES (,,'pending')";
            $result = $conn->query($sql);
        } 
     ?>
<section class="">
    <div class="container">
        <div class="">
            <div class="list-cart">
            </div>
            <!-- viet vong lap in ra cac pp trong session  -->
            <div class="content-cart">
                <div id="cart">
                    <?php 
                    if(isset($_SESSION['cart'])) {
                    ?>
                    <table class="table thead-light">
                        <tr>
                                <!-- cho nay la stt -->
                            <td>#</td>
                            <!-- ten pro duct -->
                            <td>product_name</td>
                            <td>quantily</td>
                            <td>remove</td>
                        </tr>
                            <!-- loop start here -->
                        <?php 
                                $count = 0;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $count++;
                                    ?>
                                        <tr id="<?php echo $key ?>">
                                            <td><?php echo $count ?></td>
                                            <td><?php echo $key ?></td>
                                            <td>
                                                <div class="">
                                                    <!-- <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="" onclick="var a = document.getElementById('quantity').value-1;loadDoc('addtocart.php?product_id=<?php echo $key ?>&quantity='+a, add)">
                                                    <i class="fas fa-minus-square"></i>
                                                    </button> -->
                                                    <input type="text" id="<?php echo 'id'.$key ?>" name="" class="input-number max-w" value="<?php echo $value ?>" min="1" max="100" onchange="var a= document.getElementById('<?php echo 'id'.$key ?>').value;console.log(a) ;loadDoc('addtocart.php?product_id=<?php echo $key ?>&quantity='+a, add)">
                                                    <!-- <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="" onclick="var a = document.getElementById('quantity').value;a++;loadDoc('addtocart.php?product_id=<?php echo $key ?>&quantity='+a, add)">
                                                    <i class="fas fa-plus-square"></i>
                                                    </button> -->
                                                </div>
                                            </td>
                                            <td>
                                                <button onclick="getid(<?php echo $key ?>);loadDoc('removefromcart.php?product_id=<?php echo $key ?>', remove)">remove</button>
                                            </td>
                                        </tr>
                                    <?php
                                }
                     ?>
                    </table>
                    <?php
                        if(isset($_SESSION['user_id'])) {
                            ?>
                            
                                <button class="btn btn-success" onclick="loadDoc('order_process.php?user_id=<?php echo $_SESSION['user_id'] ?>', order_process)">order</button>
                            <?php
                        } else {
                            ?>
                                <p>please sign in to order.</p>
                            <?php
                        } 
                    }
                    ?>
                <!-- phai kien tra m t l da dat cai ji thi moi hien order  -->
                </div>
            </div>
        </div>
    </div>
</section>
    <?php
        include('footer.php');
    ?>
</body>
<script type="text/javascript">
	// $(document).ready(function(){

	// var quantitiy=0;
	//    $('.quantity-right-plus').click(function(e){
	//         // Stop acting like a button
	//         e.preventDefault();
	//         // Get the field name
	//         var quantity = parseInt($('#quantity').val());
	//         // If is not undefined
	//             $('#quantity').val(quantity + 1);
	//             // Increment 
	//     });

	//      $('.quantity-left-minus').click(function(e){
	//         // Stop acting like a button
	//         e.preventDefault();
	//         // Get the field name
	//         var quantity = parseInt($('#quantity').val());
	        
	//         // If is not undefined
	      
	//             // Increment
	//             if(quantity>0){
	//             $('#quantity').val(quantity - 1);
	//             }
	//     });
	    
	// });

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

    function remove(xhttp) {
        document.getElementById(id).innerHTML = '';
    } 

    function add(xhttp) {
    } 

    function order_process(xhttp) {
        document.getElementById('cart').innerHTML = xhttp.responseText;
    } 

    function getid(a) {
        id = a;
    }
</script>
</html>