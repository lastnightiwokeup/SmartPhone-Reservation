<!-- Name: Leung Tsz Ki Connie, Student ID: 21070955S -->
<!-- Create the admin login page UI using bootstrap -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html>

<head>
	<link rel="icon" type="image/x-icon" href="./assets/favicon.ico" />
	<title>Admin Login Page</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!-- styling using external css -->
    <link rel="stylesheet" href="./css/login.css">


</head>

<body>
	<div class="sidenav">
		<div class="login-main-text">
		<h2>Admin<br> Login Page</h2>
		<p>Login from here to access.</p>
		</div>
	</div>
	<div class="main">
		<div class="col-md-6 col-sm-12">
		<div class="login-form">
			<form method="POST" action=""> 
				<div class="form-group">
					<label>User Name</label>
					<input type="text" name="login" class="form-control" value="" placeholder="username">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="pw" class="form-control" value="" placeholder="password">
				</div>
				<button type="submit" name="submit" class="btn btn-black" value="submit">Login</button>
				<button type="submit" name="back" class="btn btn-black" value="submit">Back</button>

			</form>
		</div>
		</div>
	</div>
</body>
</html>

<?php
// Redirect to admin page only if "admin" & "pass" is entered as login name and password respectively
$_SESSION['loginErr']="";
if (isset($_POST['submit'])) {
    if ($_POST['login'] == 'admin' && $_POST['pw'] == 'pass') {
    	header('Location: admin.php');
    }
}
// Redirect to home page if user click the "Admin Login" button
if (isset($_POST['back'])) { 
    	header('Location: index.php');
    
}
?>