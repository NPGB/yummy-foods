<header>
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <a href="index.php" class="my-0 mr-md-auto font-weight-normal none-decoration">
                <img class="logo" src="assets/img/<?php echo $config['logo']; ?>" alt="">
            </a>
            <nav class="my-2 my-md-0 mr-md-3 nav-menu">
                <?php
                session_start();
                ob_start();
                function dqmenu($name_array) {
                    static $count =0;
                    $count++;
                    foreach ($name_array as $key => $value) {
                        ?>
                        <div class="<?php if($count==1){echo 'block ';} else {echo ' sub-menu-a';} if($count<=4){echo ' tagmenu'.$count;} else {echo '  tagmenu';}?>"><a class="p-2 text-color none-decoration " href="<?php if(!is_array($value)) {echo $value;} else {echo "#";} ?>"><?php echo $key ?></a>
                            <?php
                            if (is_array($value)) {
                                ?>
                                <div class="sub-menu <?php if($count<=4){echo 'sub-menu'.$count;} else {echo ' sub-menu5';} ?> " >
                                <?php
                                dqmenu($value);
                                $count--;
                                ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }
                dqmenu($menu);
                ?>
            </nav>
            <a href="cart.php" class="cart"><i class="fas fa-shopping-cart"></i></a>
            <?php 
                //tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
                //nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
                if (!isset($_SESSION['user_name'])) {
                    ?>
                    <a class="btn btn-outline-primary" href="user_login.php">Sign in</a>
                    <?php
                } else {
                    ?>
                    <div id="user">
                        <div>
                            <img id="img-user" src="assets/img/user/<?php echo $_SESSION['image'] ?>" alt="">
                        </div>
                        <div class="user-info">
                            <div class="sub-menu-a" ><a href="user.php?id=<?php $_SESSION['user_id'] ?>" class="none-decoration">view profile</a></div>
                            <div class="sub-menu-a"><a  href="view_order.php?id=<?php $_SESSION['user_id'] ?>" class="none-decoration">view order</a></div>
                            <div class="sub-menu-a"><a  href="user_logout.php" class="none-decoration">logout</a></div>
                    </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</header>