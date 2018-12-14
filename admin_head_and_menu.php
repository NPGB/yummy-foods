<nav class="navbar navbar-light sticky-top flex-md-nowrap p-0 height" style="background-color: #e3f2fd;">
  <a href="index.php"><img class="height" src="assets/img/<?php $config = include('config/config.php'); echo $config['logo']; ?>" alt=""></a>   
      <div id="user">
        <div>
          <p class="hello">hello, <?php echo $_SESSION['admin_name'] ?></p>
          <img id="img-user" src="assets/img/user/<?php echo $_SESSION['image'] ?>" alt="">
        </div>
        <div class="user-info">
          <a class="dropdown-item" href="admin.php">view profile</a>
          <a class="dropdown-item" href="logout.php">logout</a>
        </div>
      </div>
</nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 col-lg-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                <i class="fas fa-home"></i> Dashboard <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_order.php">
                  <i class="fas fa-file-signature"></i> Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_all_products.php">
                <i class="fab fa-product-hunt"></i> Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_add_product.php">
                <i class="fas fa-plus-circle"></i> Add product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_bill.php">
                <i class="fas fa-file-invoice-dollar"></i> Bill</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_statistic_product.php">
                <i class="fas fa-chart-pie"></i> Statistic product</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="users.php" <?php if ($_SESSION['role']!=5) echo "style=\" display: none;\"" ?>>
                <i class="fas fa-users"></i> Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_statistic_users.php">
                <i class="fas fa-chart-bar"></i> Statistic user</a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span> Current month</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span> Last quarter</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span> Social engagement</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout</a>
              </li>
            </ul>
          </div>
        </nav>

        <div role="main" class="col-md-9 col-lg-10 ml-sm-auto col-lg-10 pt-3 px-4">
            