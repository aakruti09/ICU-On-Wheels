<?php 

$amb=$_POST['user_name'];
$hos_name=$_POST['hos_name'];
$bed_type=$_POST['bed_type'];
$condition=$_POST['condition'];
$pid=$_POST['pid'];
 
 $link=new mysqli("localhost","root","","extra");
 if($link->connect_error){
	 die('connectfail'.$link->connect_error);
 }
 
$qry1="UPDATE bed_info SET empty_beds=empty_beds-1,reserved_beds=reserved_beds+1 WHERE bed_type='$bed_type' AND hos_name='$hos_name' AND quantity=empty_beds+reserved_beds AND empty_beds>0";
	$link->query($qry1);
	if (!$link->affected_rows>0)
	{
		echo "No";
	}
	else {
		$qry2="INSERT INTO booking(patient_id,amb_username,hos_name,patient_condition,date_time,status) VALUES ('$pid','$amb','$hos_name','$condition',LOCALTIMESTAMP,'Booked')";
		if ($link->query($qry2)===TRUE)
		{
			$lastid=mysqli_insert_id($link);
			$qry3="UPDATE patient_details SET hospital_name='Ambulance $hos_name' WHERE patient_id=$pid";
			if ($link->query($qry3)===TRUE) {
				echo $lastid;	
			}
		}
	}
 
 $link->close();
 ?>