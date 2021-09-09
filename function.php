<?php
// obs_start();
include('conn.php');

function check_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}


function dictionary_detect($username,$dictionary,$ipaddress){
    global $conn;
	$sql1=mysqli_query($conn,"INSERT INTO dictionary_attacks(username,dictionary,ipaddress) 
	VALUES('$username','$dictionary','$ipaddress')"); 
		
}




function finduserIPAddress() {  
    //whether user ip is from a shared internet source 
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $usrip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $usrip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $usrip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $usrip;  
} 






?>