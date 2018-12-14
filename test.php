<?php
    session_start();
    ob_start();
    //tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
    //nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
    if (!isset($_SESSION['admin_name'])) {
        
        ?>
        <p><?php echo $_SESSION['admin_name']; ?></p>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
        <?php
    } else {
        ?>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img style="max-width: 34px;" id="img-user" src="assets/img/user/<?php echo $_SESSION['image'] ?>" alt="">
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="admin.php">view profile</a>
                <a class="dropdown-item" href="logout.php">logout</a>
            </div>
        </div>
        <?php
    }
?>