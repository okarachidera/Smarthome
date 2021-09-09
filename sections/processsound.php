<?php
//insert.php
include '../header.php';
	$appname = $_POST['hidden_soundsystem'];
	$appstatus = $_POST['hidden_sound'];
	$result = mysqli_query($conn,"INSERT INTO appliance(userid,appliance_name,status)VALUES('$userid','$appname','$appstatus')") or die(mysqli_error($conn));
 
 if(($result))
 {
  echo 'done';
 }


?>