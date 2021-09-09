<?php
	include('conn.php');
	include('function.php');
	session_start();

use PHPMailer\PHPMailer\PHPMailer;

	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		

		$email=check_input($_POST['email']);
		//OTP TIMER
		$d=time();
		$t= date("Y-m-d h:i:s", strtotime('+10 minutes', $d));

		//block status
		$blocktime= date("Y-m-d h:i:s", $d);


		


			//check affected rows
		$sql = mysqli_query($conn,"SELECT * from dictionary_table WHERE name='$email' ");
			//check affected rows

				while($row = mysqli_fetch_array($sql))
			{
				$dictionary=$row['name'];


			}





			$query=mysqli_query($conn,"select * from user where email='$email'");
			$num = mysqli_num_rows($query);


			
			if($num == 1)
			{
				//echo 'record found';
				while($rw = mysqli_fetch_array($query))
				{
				//echo $userID = $row['memid'];
				$otp_code=$rw['otp_code'];
				$userid=$rw['userid'];	
				$otp_timer=$rw['otp_timer'];
				$password_guess=$rw['password_guess'];	
				$block_timer=$rw['block_timer'];
				$status=$rw['status'];				
				}
			}

		if (!isset($email)) {
  			$_SESSION['log_msg'] = "Username Empty";
  			header('location:login.php');
		}
		elseif ($email==$dictionary) {
			$ipaddress=finduserIPAddress();

			dictionary_detect($email,$dictionary,$ipaddress);
			$_SESSION['log_msg'] = "Dictionary attack detected";
			header('location:login.php?');

		}
		else{
			$query=mysqli_query($conn,"select * from user where email='$email'");

			if(mysqli_num_rows($query)==0){
				$_SESSION['log_msg'] = "User not found";
  				header('location:login.php?');
			}
			else{
				$row=mysqli_fetch_array($query);
				if($row['verify']==0){
					$_SESSION['log_msg'] = "User not verified. Please activate account";
  					header('location:login.php');
				}
				elseif($status=='block' && $blocktime < $block_timer){
					$_SESSION['otp_failed'] = "Account blocked Until ".'<br>'.date("h:i:s",strtotime($block_timer));
					header('location:login.php');
				}
				else{

					
					require_once "PHPMailer/PHPMailer.php";
					require_once "PHPMailer/SMTP.php";
					require_once "PHPMailer/Exception.php";
				
					$mail = new PHPMailer();
				
					//smtp settings
					$mail->isSMTP();
					$mail->Host = "smtp.gmail.com";
					$mail->SMTPAuth = true;
					$mail->Username = "";
					$mail->Password = '';
					$mail->Port = 465;
					$mail->SMTPSecure = "ssl";

					//OTP
					// $code = rand(999999, 111111);
					$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&';
					$code=substr(str_shuffle($set), 0, 6);
				

					// //OTP TIMER
					// $d=time();
					// // echo "Created date is " . date("Y-m-d h:i:sa",$d);
					// // echo" <br>";
					// $t= date("Y-m-d h:i:s", strtotime('+10 minutes', $d));
					// echo" <br>";
					// echo $t;


					//2021-03-26 05:40:14


				
					//email settings
					$mail->isHTML(true);
					$mail->setFrom($email, "Smart Home OTP");
					$mail->addAddress("$email");
					$mail->Subject = ("$email (OTP CODE)");
					$mail->Body = " Your one time password is $code and expires in $t";
					if($mail->send()){
					//INSERT OTP
					$guesscount=0;
					$setnull=null;
					$query1=mysqli_query($conn,"update user set otp_code='$code', 
					otp_timer='$t', status='active', block_timer='$setnull', password_guess='$guesscount'
					where email='$email'");
						header('location:otp.php?statusmsg=success&email='.$email);

					}else{
						$_SESSION['otp_failed'] = "OTP failed! Check Internet Connection and Try again";
						header('location:login.php');
  
					}
					
				}
			}
		}

	}


	//form validation
	if(isset($_GET['id']))
	{
	
	  echo $email= $_GET['id'];
	//   $statusmsg=$_GET['statusmsg'];

	  require_once "PHPMailer/PHPMailer.php";
	  require_once "PHPMailer/SMTP.php";
	  require_once "PHPMailer/Exception.php";
  
	  $mail = new PHPMailer();
  
	  //smtp settings
	  $mail->isSMTP();
	  $mail->Host = "smtp.gmail.com";
	  $mail->SMTPAuth = true;
	  $mail->Username = "ckgraphite@gmail.com";
	  $mail->Password = 'chider11';
	  $mail->Port = 465;
	  $mail->SMTPSecure = "ssl";

	  //OTP
		// $code = rand(999999, 111111);
		$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&';
		$code=substr(str_shuffle($set), 0, 6);
	  
		//OTP TIMER
		$d=time();
		// echo "Created date is " . date("Y-m-d h:i:sa",$d);
		// echo" <br>";
		$t= date("Y-m-d h:i:s", strtotime('+10 minutes', $d));
		// echo" <br>";
		// echo $t;
	  


  
	  //email settings
	  $mail->isHTML(true);
	  $mail->setFrom($email, "Smart Home OTP");
	  $mail->addAddress("$email");
	  $mail->Subject = ("$email (OTP CODE)");
	  $mail->Body = " Your one time password is $code and expires in $t";
	  if($mail->send()){
	  //INSERT OTP
	  $query1=mysqli_query($conn,"update user set otp_code='$code', otp_timer='$t' where email='$email'");
		header('location:otp.php?statusmsg=success&email='.$email);

	  }else{
		  $_SESSION['otp_failed'] = "OTP failed! Check Internet Connection and Try again";
		  header('location:login.php');

	  }


   }

?>
