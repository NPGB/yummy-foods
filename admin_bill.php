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
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <?php include 'admin_head_and_menu.php'; ?>
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
                <?php
                    //Gọi file connection.php 
                        require_once("lib/connection.php");
                        $sql = "SELECT `bill_id`, `amount`, `ship`, `total`, `date`, `order_id` FROM `bill` WHERE 1  
                        ORDER BY `bill`.`date` DESC";
                        $result = $conn->query($sql);
                    ?>
                        <table class="table thead-light table-striped">
                            <tr>
                                <td>#</td>
                                <td>bill_id</td>
                                <td>amount</td>
                                <td>ship</td>
                                <td>total</td>
                                <td>date</td>
                                <td>order_id</td>
                                <td>employees</td>
                                <td>action</td>
                            </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()): 
                                $count++;
                            ?>
                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $row['bill_id'] ?></td>
                                    <td><?php echo $row['amount'] ?></td>
                                    <td><?php echo $row['ship'] ?></td>
                                    <td><?php echo $row['total'] ?></td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['order_id'] ?></td>
                                    <td><?php echo $row['employees'] ?></td>
                                    <td><a href="admin_order_detail.php?order_id=<?php echo $row['order_id'] ?>">detail</a></td>
                                </tr>
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
                        </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>