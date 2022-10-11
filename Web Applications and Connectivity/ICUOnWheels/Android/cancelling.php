<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error) {
		die('connectfail'.$link->connect_error);
	}
	$bid=$_POST['bookid'];
	$qry1="SELECT patient_id,hos_name,patient_condition FROM booking WHERE book_id=$bid";
	$kaib=$link->query($qry1);
	$r=mysqli_fetch_assoc($kaib);
	if($kaib->num_rows===1)
	{
		$hos_name=$r['hos_name'];
		$cond=$r['patient_condition'];
		$pid=$r['patient_id'];
		$qry2="UPDATE bed_info,disease_details SET reserved_beds=reserved_beds-1,empty_beds=empty_beds+1 WHERE bed_info.bed_type=disease_details.bed_type AND disease_details.disease_name='$cond' AND hos_name='$hos_name' AND quantity=empty_beds+reserved_beds AND reserved_beds>0";
		$result2=$link->query($qry2);
		if ($result2==1) {
			$qry3="UPDATE booking SET status='Cancelled',canceled_datetime=LOCALTIMESTAMP WHERE book_id=$bid";
			$result3=$link->query($qry3);
			if ($result3==1) {
				$qry4="UPDATE patient_details SET hospital_name='Ambulance Cancelled' WHERE patient_id=$pid";
				$result4=$link->query($qry4);
				if ($result4==1) {
					echo "Cancelled";
				}
			}
		}
		else{
			echo "No booking";
		}
	}
	else{
		echo "No booking";
	}
	$link->close();
?>