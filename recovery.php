<?php
	include('conn.php');
	session_start();
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}

		$email=check_input($_POST['email']);
		
		

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$_SESSION['log_msg'] = "Invalid email format";
  			header('location:forget.php');
		}
		else{
			$query=mysqli_query($conn,"select * from user where email='$email'");
			if(mysqli_num_rows($query)==0){
				$_SESSION['log_msg'] = "The email is invalid. You can use our contact form to send message to our admin.If you forget both your email and Password";
  				header('location:forget.php');
			}
			else{
				$row=mysqli_fetch_array($query);
				if($row['verify']==0){
					$_SESSION['log_msg'] = "User not verified. Please activate account";
  					header('location:forget.php');
				}
				else{
					//$_SESSION['id']=$row['userid'];
					//header('location:index.php');
					
					//depends on how you set your verification code
		$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code=substr(str_shuffle($set), 0, 12);

		mysqli_query($conn,"UPDATE  user SET code='$code' WHERE email='$email'");
		$uid=mysqli_insert_id($conn);
		

		//sending email verification
		$to = $email;
			$subject = "Recovery Password Verification Code";
			$message = "
				<html>
				<head>
				<title>Recovery Code</title>
				</head>
				<body>
				<h2>Thank you for Registering.</h2>
				<p>Your Account:</p>
				<p>Email: ".$email."</p>
				
				<p>Please click the link below to recover your password.</p>
				<h4><a href='http://localhost/recoverypass/recover.php?uid=$email&code=$code'>Recover my Password</h4>
				</body>
				</html>
				";
			//dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: loveubadinma@gmail.com". "\r\n" .
						"CC:mcgamma04@gmail.com";

		mail($to,$subject,$message,$headers);
	

		$_SESSION['log_msg'] = "Verification code sent to your email. <h4><a href='http://localhost/recoverypass/recover.php?uid=$email&code=$code'>Recover my Password</h4>";
  		header('location:forget.php');
					
				}
			}
		}

	}
?>