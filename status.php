<?php
 //include '../header.php';
function appliance_status($appname)
{
	global $conn;
	$sql = mysqli_query($conn,"
	
				SELECT id, appliance_name,status,date
				FROM appliance
				WHERE id IN (
				SELECT MAX(id)
				FROM appliance where appliance_name='$appname'
				GROUP BY `appliance_name`
			);
			")or die(mysqli_error($conn));
			$rowc = mysqli_fetch_array($sql);
			
			     if ($rowc['status']=="on")
				 //$appname = $rowc['appliance_name'];
			
			{
			
					echo 'checked';
					//echo $status;
				}
			
}
//appliance_status("Refrigerator");


function chidi($appname)
{
	global $conn;
	$sql = mysqli_query($conn,"
	
				SELECT id, appliance_name,status,date
				FROM appliance
				WHERE id IN (
				SELECT MAX(id)
				FROM appliance where appliance_name='$appname'
				GROUP BY `appliance_name`
			);
			")or die(mysqli_error($conn));
			$rowc = mysqli_fetch_array($sql);
			     return $rowc['status'];
			
}

?>