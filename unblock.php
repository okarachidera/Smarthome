<?php
	session_start();
	include('conn.php');
	if(isset($_GET['code'])){
        $user=$_GET['uid'];
        $code=$_GET['code'];

        

        $query=mysqli_query($conn,"select * from user where userid='$user'");
        $row=mysqli_fetch_array($query);

        if($row['code']==$code){
            //activate account
            mysqli_query($conn,"update user set status='active' where userid='$user'");
            
            header('Refresh: 2;url=login.php');
        }
        else{
            $_SESSION['sign_msg'] = "Something went wrong. Please sign up again.";
            header('location:register.php');
        }
	}
	else{
		header('location:login.php');
	}
?>

<?php

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
Account Activated! Please Login
</h4>

</div>