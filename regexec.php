<?php
	include('conn.php');
	session_start();
	include("notify.php");
	include('include/homecss.php'); 


?>

            <style>
            .new{
            	margin-top:20%
            }
            </style>
            <div class="container new">
            <h4 class="text-center">
            <div class="spinner-grow text-primary" role="status">
              <span class="sm sr-only">Loading...</span>
            </div>
            </h4>
            <h4 class="text-center">
            Creating Account..
            </h4>
            


<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	function check_input($data){
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}

	$email=check_input($_POST['email']);
	// $password=sha1(check_input($_POST['password']));
	$first = check_input($_POST['first']);
	$last = check_input($_POST['last']);
	$phone= check_input($_POST['phone']);
	$uname= check_input($_POST['uname']);


	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$_SESSION['sign_msg'] = "Invalid email format";
  		
  		// header('location:register.php');
  		
  	    echo '<script>
            window.location = "register.php?";
        </script>';
  
	}

	else{

		$query=mysqli_query($conn,"select * from user where
		 email='$email' or username='$uname'");
		if(mysqli_num_rows($query)>0){
			$_SESSION['sign_msg'] = "Account already taken";
			
  		// 	header('location:register.php');
  			
  			    echo '<script>
                    window.location = "register.php?";
                </script>';
		}
		else{
		$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$code=substr(str_shuffle($set), 0, 18);

		mysqli_query($conn,"insert into user (phone,email,firstname,lastname, code,username) values ('$phone','$email','$first','$last', '$code','$uname')");
		$uid=mysqli_insert_id($conn);
		//default value for our verify is 0, means it is unverified
      $name = $first .' '.$last;
		//sending email verification
		$to = $email;
			$subject = "Smart Home Sign Up Verification Code";
			$body = "
				<html>
				<head>
				<title>Verification Code</title>
				</head>
				<body>
				<h2>Thank you for Registering.</h2>
				<p>Dear ".$name." Your Account Detail is:</p>
				<p>Email: ".$email."</p>
				<p>Please click the link below to activate your account.</p>
				<h4><a href='http://smarthome.clptechnology.com.ng/activate.php?uid=$uid&code=$code'>Click to Activate your Account</h4>
				</body>
				</html>
				";


		notify($email,$name,$subject,$body);


		$_SESSION['sign_msg'] = "Verification code sent to your email";
		
  		// header('location:register.php');
    	echo '<script>
            window.location = "register.php?";
        </script>';


  		}
	}
	}
?>

</div>
