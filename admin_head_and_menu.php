<nav class="navbar navbar-light sticky-top flex-md-nowrap p-0 height" style="background-color: #e3f2fd;">
    <a href="admin.php"><img class="height" src="assets/img/<?php $config = include('config/config.php'); echo $config['logo']; ?>" alt=""></a>   
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
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
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 col-lg-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_all_products.php">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_add_product.php">
                  <span data-feather="users"></span>
                  Add product
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_bill.php">
                  <span data-feather="bar-chart-2"></span>
                  Bill
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_statistic_product.php">
                  <span data-feather="layers"></span>
                  Statistic product
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="users.php" <?php if ($_SESSION['role']!=5) echo "style=\" display: none;\"" ?>>
                  <span data-feather="layers"></span>
                  Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="admin_statistic_users.php">
                  <span data-feather="layers"></span>
                  Statistic user
                </a>
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
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Last quarter
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Social engagement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <span data-feather="file-text"></span>
                  Logout
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <div role="main" class="col-md-9 col-lg-10 ml-sm-auto col-lg-10 pt-3 px-4">
            