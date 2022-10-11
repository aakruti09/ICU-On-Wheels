<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error){
		die('Connection Failed: '.$link->connect_error);
	}
	$amb=$_POST['amb'];
	$sql1="SELECT * FROM request_facility,facilty WHERE request_facility.fac_id=facilty.facility_id AND amb_username='$amb' AND fac_status='Owned'";
	$result1=$link->query($sql1);
	if ($result1->num_rows>0) {
		while($e1=mysqli_fetch_assoc($result1))
		{
			$output1[]=$e1;	
		}
		echo json_encode($output1);
	}
	else {
		echo "No records";
	}
	$link->close();
?>