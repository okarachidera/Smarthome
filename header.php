<?php   
   // ini_set("display_errors", 0);
   // error_reporting(E_ALL);
    date_default_timezone_set('Africa/Lagos');
    session_start();
	//header("Refresh: 60");
	include("conn.php");
	include("status.php");
   // include("../functions/miningfunctions.php");
    

    if(!isset($_SESSION['id'])){
        
		header('location: login.php');
    }else{
        $userid=$_SESSION['id'];
        //$username=$_SESSION['username'];
        $sql=mysqli_query($conn,"SELECT * FROM user WHERE userid=$userid");
        
        if($sql){
            $rows=mysqli_fetch_array($sql);
			$surname = $rows['firstname'];
			$lastname = $rows['lastname'];
			$namem = $surname.' '.$lastname;
            $fullname=$rows['firstname'] . ", " . $rows['lastname'];
           // $passport=$rows['passport'];
			$password = $rows['password'];
			//$country = $rows['country'];
            $emailaddress=$rows['email'];
            $usertype=$rows['user_type'];
           // $phoneno=$rows['phoneno'];
            
        }
        $_SESSION['user_type']=$usertype;

    }
    
?>