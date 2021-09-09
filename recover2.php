<?php
	include('conn.php');
	session_start();
function check_input($data) {
		$//data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = mysql_escape_string($data);
		return $data;
		}
		
	
	$pass = $_POST['pwd'];
	$conpass = check_input($_POST['pwd1']);
	$email = $_POST['email'];
	$code = $_POST['code'];
	if($pass == $conpass){
		
	
	
	$query=mysqli_query($conn,"select * from user where email='$email'");
	$row=mysqli_fetch_array($query);

	if($row['email']==$email){
		 $newpass  = md5($pass);
		//change the password
		$result = mysqli_query($conn,"update user set password='$newpass' where email='$email'");
		if($result){
		?>
		<p>
			<script>
			alert('Password changed successfully');
			window.location = 'index.php';
			</script>
		</p>
		
		<?php
		}
	}
	else{
		$_SESSION['sign_msg'] = "Something went wrong. Please sign up again.";
  		//header('location:signup.php');
	}
	}else{
		echo 'the Password and confirm password are not the same';
	}
	

?>