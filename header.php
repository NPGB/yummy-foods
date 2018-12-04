<div class="container">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <a href="index.php" class="my-0 mr-md-auto font-weight-normal none-decoration">
            <img class="logo" src="assets/img/<?php $config = include('config/config.php'); echo $config['logo']; ?>" alt="">
            <!-- <h5 class="my-0 mr-md-auto font-weight-normal page-name"><?php echo $config['name_store']; ?></h5> -->
        </a>
        <!-- <img src="<?php $config = include('config/config.php'); echo $config['logo']; ?>" alt="">
        <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo $config['name_store']; ?></h5> -->
        <nav class="my-2 my-md-0 mr-md-3 nav-menu">
            <?php 
                include('config/page_config.php');
                // vong lap list ds menu 
               /* me nu ko dung dq
                foreach ($menu as $key => $value) {
                    ?>
                <div class="block tagmenu"><a class="p-2 text-dark none-decoration " href="<?php if(!is_array($value)) {echo $value;} else {echo "#";} ?>"><?php echo $key ?></a>
                    <?php
                    if (is_array($value)) {
                        ?>
                        <div class="sub-menu" >
                        <?php
                        foreach ($value as $k => $v) {
                            ?>
                            <a  class="sub-menu-a none-decoration effect" href="index.php?category=<?php echo $v ?>"><?php echo $k ?></a>
                            <?php
                        }
                        ?></div><?php
                    }
                    ?>
                </div>
                    <?php
                }
               */
                function dqmenu($name_array) {
                    static $count =0;
                    $count++;
                    foreach ($name_array as $key => $value) {
                        ?>
                        <div class="<?php if($count==1){echo 'block ';} else {echo ' sub-menu-a';} if($count<=4){echo ' tagmenu'.$count;} else {echo '  tagmenu';}?>"><a class="p-2 text-dark none-decoration " href="<?php if(!is_array($value)) {echo $value;} else {echo "#";} ?>"><?php echo $key ?></a>
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
        <?php
            session_start();
            ob_start();
            //tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
            //nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
            if (!isset($_SESSION['admin_name'])) {
                ?>
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
    </div>
</div>
<div class="slide">
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            <?php 
                foreach ($imgslide as $key => $value) {
                    ?>
                    <div class="class-item">
                        <img class="style-img" src="assets/img/product/<?php echo $value ?>" alt="">
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>