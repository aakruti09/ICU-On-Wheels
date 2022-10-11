<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$hid=$_GET['id'];
	$sql="SELECT hospital_name FROM hospital_details WHERE hospital_id=1";
	$sqlexe=mysqli_query($con,$sql) or die(mysqli_error($con));
	$r=mysqli_fetch_array($sqlexe);
	$hos_name=$r["hospital_name"];
	$qry1="DELETE FROM hospital_details WHERE hospital_id=$hid";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	$qry2="DELETE FROM login WHERE hospital_id=$hid";
	$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
	//$qry3="DELETE FROM bed_info WHERE hos_name='$hos_name'";
	//$res3=mysqli_query($con,$qry3) or die(mysqli_error($con));
	if ($res1>0 && $res2>0) {
		echo "<script>alert('Data deleted');document.location='ViewHospitalDetails.php'</script>";
	}
?>