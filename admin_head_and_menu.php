<div id="head-bar">
	<div class="container-fluid">
		<div class="card">
			<div class="card-body">
				<nav id="nav-bar">
					<a href="index.php"><img id="logo-top" src="assets/img/logo.png" alt=""></a>
					<h1 id="name-page">Yummy Foods</h1>
					<img id="img-user" src="assets/img/user/<?php echo $_SESSION['image'] ?>" alt="">
					<!-- <select name="" id="">
							<option value=""></option>
						<option value=""><a href="user.php?id=<?php echo $_SESSION['user_id'] ?>">view</a></option>
						<option value=""><a href="logout.php">log out</a></option>
					</select>  lam sau cclick image user list choose-->
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
				<a href="admin.php" class="list-group-item list-group-item-action">All product</a>
				<a href="admin_add_product.php" class="list-group-item list-group-item-action">Add product</a>
				<a href="admin_oder.php" class="list-group-item list-group-item-action">Oder</a>
				<a href="admin_bill.php" class="list-group-item list-group-item-action">Bill</a>
				<a href="admin_statistic_product.php" class="list-group-item list-group-item-action">Statistic product</a>
				<a href="" class="list-group-item list-group-item-action active">User</a>
				<a href="users.php" <?php if ($_SESSION['role']!=5) echo "style=\"display: none;\"" ?> class="list-group-item list-group-item-action">users</a>
				<a href="admin_statistic_users.php" class="list-group-item list-group-item-action">Statistic user</a>
				<a href="logout.php" class="list-group-item list-group-item-action">Log out</a>	              
			</div> 
		</div>