<?php
	include('conn.php');
	session_start();
	if(isset($_GET['code'])){
	 $email=$_GET['uid'];
	 $code=$_GET['code'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Password Recovery App</title>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+San">
	<link href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">  
<style>
	#login_form{
		width:350px;
		position:relative;
		top:50px;
		margin: auto;
		padding: auto;
	}
</style>
</head>
<body>
<div class="container">
	<div id="login_form" class="well">
		<h2><center><span class="glyphicon glyphicon-lock"></span> Please Login</center></h2>
		<hr>
		<form method="POST" action="recover2.php">
		<input type="hidden" name="email" class="form-control" value="<?php  echo $email;  ?>">
		<input type="hidden" name="code" class="form-control" value="<?php  echo $code;  ?>">
		New Password: <input type="text" name="pwd" class="form-control" required>
		<div style="height: 10px;"></div>		
		Confirm Password: <input type="password" name="pwd1" class="form-control" required> 
		
		<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Change Password</button> <!--No account? <a href="signup.php"> Sign up</a><br/>Login?<a href="index.php"> Click here</a>-->
		</form>
		<div style="height: 15px;"></div>
		<?php
			if(isset($_SESSION['log_msg'])){
				?>
				<div style="height: 30px;"></div>
				<div class="alert alert-danger">
					<span><center>
					<?php echo $_SESSION['log_msg'];
						unset($_SESSION['log_msg']); 
					?>
					</center></span>
				</div>
				<?php
			}
		?>
	</div>
</div>
</body>
</html>