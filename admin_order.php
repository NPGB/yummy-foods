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
                           <?php
                           //Gọi file connection.php 
                            require_once("lib/connection.php");
                            $sql ="SELECT COUNT(*) as count, `status` FROM orders WHERE 1 GROUP BY `status`  
                            ORDER BY `orders`.`status` ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()): 
                                    ?>
                                    <p><?php echo $row['count'].'   '.$row['status'] ?></p>
                                    <?php
                                endwhile;
                            }
                           ?>
                        </div>
                    </div>
                    <div class="row">
                    <?php
                        $sql = "SELECT `order_id`, `user_id`, `date_time`, `status` FROM `orders` WHERE 1  ORDER BY `orders`.`date_time` DESC";
                        $result = $conn->query($sql);
                    ?>
                        <table class="table thead-light ">
                            <tr>
                                <td>#</td>
                                <td>order_id</td>
                                <td>user_id</td>
                                <td>date_time</td>
                                <td>status</td>
                                <td>action</td>
                            </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()): 
                                $count++;
                                $att='';
                                switch ($row['status']) {
                                    case 'pending':
                                        $att = 'class="table-danger"';
                                        break;
                                    case 'shipping':
                                        $att = 'class="table-warning"';
                                        break;
                                    case 'delivered':
                                        $att = 'class="table-success"';
                                        break;
                                    case 'user ccor':
                                        $att = 'class="table-dark"';
                                        break;
                                    case 'empl ccor':
                                        $att = 'class="table-active"';
                                        break;
                                    default:
                                        $att = 'class="table-info"';
                                        break;
                                }
                            ?>
                                <tr <?php echo $att ?>>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $row['order_id'] ?></td>
                                    <td><?php echo $row['user_id'] ?></td>
                                    <td><?php echo $row['date_time'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td>
                                    <?php
                                        if($row['status']!='user ccor') {
                                            $id =  $row['order_id'] ;
                                            if($row['status']=='pending') {
                                                ?>
                                                <a href="admin_order_detail.php?order_id=<?php echo $id ?>" target="_blank">create an invoice</a>
                                                <a href="order_action.php?action=shipping&id=<?php echo $id ?>" target="_blank">shipping</a>
                                                <?php
                                            } else if($row['status']=='shipping') {
                                                ?>
                                                <a href="order_action.php?action=delivered&id=<?php echo $id ?>" target="_blank">delivered</a>
                                                <?php
                                            } else if($row['status']!='empl ccor') {
                                                ?>
                                                <a href="order_action.php?action=empl ccor&id=<?php echo $id ?>" target="_blank">cancel</a>
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="admin_order_detail.php?order_id=<?php echo $id ?>" target="_blank">create an invoice</a>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                                <a href="user.php?id=<?php echo htmlspecialchars($row['user_id']) ?>" target="_blank">view user</a>
                                            <?php
                                        }
                                    ?>
                                    </td>
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