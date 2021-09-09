<?php
    session_start();
    include("conn.php");
    include("notify.php");
    include("function.php");

?>

<?php

if(isset($_POST['otpform'])){
     $email=$_POST['email'];
     $otp=$_POST['otp'];


     			//check affected rows
		$sql = mysqli_query($conn,"SELECT * from dictionary_table WHERE name='$otp' ");
        //check affected rows

            while($row = mysqli_fetch_array($sql))
        {
            $dictionary=$row['name'];


        }


//OTP TIMER
    $d=time();
    // echo "Created date is " . date("Y-m-d h:i:sa",$d);
    // echo" <br>";
    $t= date("Y-m-d h:i:s", strtotime('+10 minutes', $d));
    $blocktime_code= date("Y-m-d h:i:s", strtotime('+30 minutes', $d));

    // echo" <br>";
    // echo $t;
    $guesscount=1;       
}
?>
    <script type="text/javascript">
        var email = "<?php echo"$email"?>";
        document.write(x);
    </script>
<?php

$query=mysqli_query($conn,"select * from user where email='$email'");
//check affected rows
$num = mysqli_num_rows($query);
if($num == 1)
{
    //echo 'record found';
    while($row = mysqli_fetch_array($query))
    {
    //echo $userID = $row['memid'];
    $otp_code=$row['otp_code'];
    $userid=$row['userid'];	
    $otp_timer=$row['otp_timer'];
    $password_guess=$row['password_guess'];	
    $block_timer=$row['block_timer'];
    $name=$row['firstname'];
    $phone=$row['phone'];	
    }
}
if($otp==$otp_code && $t< strtotime($otp_timer ) && $t>=strtotime($block_timer)){
    $sql1=mysqli_query($conn,"update user set otp_code=0 , password_guess=0
    where email='$email'");   
    $_SESSION['id']=$userid;
    // header('location:index.php');
    echo  '<script>
    window.location = "index.php?";
</script>';


}

elseif($dictionary==$otp && $password_guess<4){

    $ipaddress=finduserIPAddress();
    dictionary_detect($email,$dictionary,$ipaddress);

    $query2=mysqli_query($conn,"update user set password_guess=password_guess+$guesscount where email='$email'");
    $subject="Smart Home Intrusion Alert";
    $body='<h2>Dictionary attack detected</h2>
    <p>An attacker attempted a Dictionary attack on your user account.</p>
    <h2> Attackers Signature</h2>
    <h3>Attackers IP: '.$ipaddress.'</h3><h3>Username: '.$email.'</h3><h3>Attack Date: '.date("Y-m-d h:i:s", $d).'<h3>' ;

    notify($email,$name,$subject,$body);
    $sender='SMARTHOME';

    // sms notification
    $message='A Dictionary attack was detected by our system on your user account. The Attackers IP is: '.$ipaddress;
    smsalert($sender,$message,$phone);
    // header('location:otp.php?statusmsg=incorrect&email='.$email);
    
        echo '<script>
    window.location = "http://smarthome.clptechnology.com.ng/otp.php?statusmsg=incorrect" + "&email="+email;
</script>';


}
elseif($otp != $otp_code && $password_guess<4){
    $query2=mysqli_query($conn,"update user set password_guess=password_guess+$guesscount where email='$email'");
            echo '<script>
    window.location = "http://smarthome.clptechnology.com.ng/otp.php?statusmsg=incorrect" + "&email="+email;
</script>';
    // header('location:otp.php?statusmsg=incorrect&email='.$email);
}
elseif($otp != $otp_code && $password_guess>3){
    
    $set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code=substr(str_shuffle($set), 0, 18);
    $block='block';
    $query2=mysqli_query($conn,"update user set status='$block', block_timer='$blocktime_code',code='$code'
     where email='$email'");
     $subject="Smart Home Intrusion Alert";
     $body='Your Account has been blocked until '. $blocktime_code."An Intruder tried to access your home please contact the admin to unblock your account
    <p>OR</p>
    <p>Click the link below to Unblock your account.</p>
     <h4><a href='http://smarthome.clptechnology.com.ng/unblock.php?uid=$userid&code=$code'>Click to Activate your Account</h4>";

     notify($email,$name,$subject,$body);
     $sender='SMARTHOME';
     
     $body='Your Account has been blocked until '. $blocktime_code." An Intruder tried to access your home please contact the admin to unblock your account
    Please click the link below to activate your account. 
     http://smarthome.clptechnology.com.ng/unblock.php?uid=".$userid.'&code='.$code;

     smsalert($sender,$body,$phone);
    // header('location:otp.php?statusmsg=block&email='.$email);
    
    echo '<script>
    window.location = "otp.php?statusmsg=block&email="+email;
</script>';
}
elseif($otp == $otp_code && $t> strtotime($otp_timer)){
    // header('location:otp.php?statusmsg=expired&email='.$email);
    
    
    echo '<script>
    window.location = "otp.php?statusmsg=expired" + "&email="+email;
</script>';
}







?>
                           