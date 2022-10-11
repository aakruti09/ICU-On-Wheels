<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];

	$qry="SELECT hospital_name FROM `hospital_details` WHERE user_name='$user'";
	$res=mysqli_query($con,$qry) or die(mysqli_error($con));
	$r=mysqli_fetch_array($res);
	$hname=$r['hospital_name'];

	$pid=$_POST['pid'];
	$qry4="SELECT pcondition FROM `patient_details` WHERE patient_id=$pid";
	$res4=mysqli_query($con,$qry4) or die(mysqli_error($con));
	$r4=mysqli_fetch_array($res4);
	$cond=$r4['pcondition'];

	$qry1="DELETE FROM `patient_details` WHERE patient_id=$pid";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	if ($res1>0) {
		$qry2="UPDATE bed_info,disease_details SET empty_beds=empty_beds+1,reserved_beds=reserved_beds-1 WHERE disease_details.bed_type=bed_info.bed_type AND disease_details.disease_name='$cond' AND hos_name='$hname' AND reserved_beds>0 AND quantity=empty_beds+reserved_beds";
		$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
		if ($res2>0) {
			echo "<script>alert('Data removed');document.location='PatientDetails.php';</script>";
		}	
	}
?>