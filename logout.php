<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

// include('include/homecss.php'); 

 
// Redirect to login page
// header("location: login.php");
echo'<script>
setTimeout(function(){
    window.location.href = "login.php";
}, 2000);
</script>';
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
Signing Out of Account..
</h4>

</div>

<?php
exit;
?>