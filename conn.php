<?php

$conn = mysqli_connect("localhost","root","","smarthome");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>