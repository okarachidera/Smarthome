<?php
	session_start();
	include('conn.php');
	if(isset($_GET['code'])){
	$user=$_GET['uid'];
	$code=$_GET['code'];
	

    include('include/homecss.php'); 
            
            

	$query=mysqli_query($conn,"select * from user where userid='$user'");
	$row=mysqli_fetch_array($query);

	if($row['code']==$code){
		//activate account
		mysqli_query($conn,"update user set verify='1', status='active' where userid='$user'");
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
            Activating Account..
            </h4>
            
            </div>

		<?php
    		echo'<script>
            setTimeout(function(){
                window.location.href = "login.php?msg=success";
            }, 2000);
            </script>';
	}
	else{
		$_SESSION['sign_msg'] = "Something went wrong. Please sign up again.";
  		// header('location:register.php');
  		    echo'<script>
            setTimeout(function(){
                window.location.href = "login.php?";
            });
            </script>';

	}
	}
	else{
// 		header('location:login.php');
	  	echo'<script>
        setTimeout(function(){
            window.location.href = "login.php?";
        });
        </script>';
	}
?>