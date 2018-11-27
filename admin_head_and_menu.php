<div id="head-bar">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <nav id="nav-bar">
                    <a href="index.php"><img id="logo-top" src="assets/img/logo.png" alt=""></a>
                    <h1 id="name-page">Yummy Foods</h1>
                    <div id="user">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="img-user" src="assets/img/user/<?php echo $_SESSION['image'] ?>" alt="">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="admin.php">view profile</a>
                                <a class="dropdown-item" href="logout.php">logout</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 ">
            <div class="list-group ">
                <a href="" class="list-group-item list-group-item-action active">Product</a>
                <a href="admin.php" class="list-group-item list-group-item-action">admin</a>
                <a href="admin_all_products.php" class="list-group-item list-group-item-action">All product</a>
                <a href="admin_add_product.php" class="list-group-item list-group-item-action">Add product</a>
                <a href="admin_oder.php" class="list-group-item list-group-item-action">Oder</a>
                <a href="admin_bill.php" class="list-group-item list-group-item-action">Bill</a>
                <a href="admin_statistic_product.php" class="list-group-item list-group-item-action">Statistic product</a>
                <a href="" class="list-group-item list-group-item-action active">User</a>
                <a href="users.php" <?php if ($_SESSION['role']!=5) echo "style=\" display: none;\"" ?>
                    class="list-group-item list-group-item-action">users</a>
                <a href="admin_statistic_users.php" class="list-group-item list-group-item-action">Statistic user</a>
                <a href="logout.php" class="list-group-item list-group-item-action">Log out</a>
            </div>
        </div>