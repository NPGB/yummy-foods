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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
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
	              <a href="admin_user.php" class="list-group-item list-group-item-action">Admin user</a>
	              <a href="users.php" class="list-group-item list-group-item-action">user</a>
	              <a href="admin_statistic_users.php" class="list-group-item list-group-item-action">Statistic user</a>
	              <a href="logout.php" class="list-group-item list-group-item-action">Log out</a>	                
	            </div> 
			</div>
			<div class="col-md-9">
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
			                <div class="col-md-8">
	        		            <form>
	                              <div class="form-group row">
	                                <label for="text" class="col-12 col-form-label">Enter Title here</label> 
	                                <div class="col-12">
	                                  <input id="text" name="text" placeholder="Enter Title here" class="form-control here" required="required" type="text">
	                                </div>
	                              </div>
	                              <div class="form-group row">
	                                <label for="textarea" class="col-12 col-form-label">Visual Editor</label> 
	                                <div class="col-12">
	                                  <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control"></textarea>
	                                </div>
	                              </div> 
	                            </form>
	        		        </div>
	        		        <div class="col-md-4 ">
	        		            <div class="card mb-3" style="max-width: 18rem;">
	                                  <div class="card-header bg-light ">Publish</div>
	                                  <div class="card-body">
	                                   
	                                  </div>
	                                  <div class="card-footer bg-light">
	                                      <button type="button" class="btn btn-outline-secondary btn-sm">Preview</button>
	                                      <button type="button" class="btn btn-info btn-sm">Save Draft</button>
	                                      <button type="button" class="btn btn-primary btn-sm">Publish</button>
	                                  </div>
	                                </div>
	                            <div class="card mb-3" style="max-width: 18rem;">
	                                  <div class="card-header bg-light ">Tags</div>
	                                  <div class="card-body">
	                                    <form>
	                                      <div class="form-group row">
	                                        <div class="col-9">
	                                          <input id="tags" name="tags" placeholder="seperate with commas" required="required" class="form-control here" type="text">
	                                        </div>
	                                        <div class=" col-2">
	                                          <button name="submit" type="submit" class="btn btn-light">Add</button>
	                                        </div>
	                                        <div class="col-12">
	                                            <small>Seperate Tags with commas</small>
	                                        </div>
	                                      </div> 
	                                    </form>
	                                    

	                                  </div>
	                                  <div class="card-footer bg-light">
	                                      <a href="#">Choose from the most used tags</a>
	                                  </div>
	                                </div>
	                            <div class="card mb-3" style="max-width: 18rem;">
	                                  <div class="card-header bg-light ">Categories</div>
	                                  <div class="card-body">
	                                    <form>
	                                      <div class="form-group row">
	                                        <div class="col-9">
	                                          <input id="tags" name="tags" placeholder=" " required="required" class="form-control here" type="text">
	                                        </div>
	                                        <div class=" col-2">
	                                          <button name="submit" type="submit" class="btn btn-light">Add</button>
	                                        </div>
	                                        
	                                      </div> 
	                                    </form>
	                                    <form>
	                                      <div class="form-group row">
	                                        <label for="select" class="col-12 col-form-label">Select Category</label> 
	                                        <div class="col-8">
	                                          <select id="select" name="select" class="custom-select" required="required">
	                                            <option value="rabbit">Rabbit</option>
	                                            <option value="duck">Duck</option>
	                                            <option value="fish">Fish</option>
	                                          </select>
	                                        </div>
	                                      </div> 
	                                    </form>
	                                  </div>
	                                  <div class="card-footer bg-light">
	                                      <button type="button" class="btn btn-primary btn-sm">Add New Category</button>
	                                  </div>
	                                </div>
	                            <div class="card mb-3" style="max-width: 18rem;">
	                                  <div class="card-header bg-light ">Featured Image</div>
	                                  <div class="card-body">
	                                    

	                                  </div>
	                                  <div class="card-footer bg-light">
	                                      <a href="#">Set Featured Image</a>
	                                  </div>
	                                </div>    
	        		        </div>
	        		        
	        		    </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</body>
</html>