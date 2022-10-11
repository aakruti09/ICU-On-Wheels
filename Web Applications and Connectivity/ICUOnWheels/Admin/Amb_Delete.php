<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$aid=$_GET['id'];
	$qry1="DELETE FROM ambulance_details WHERE amb_id=$aid";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	$qry2="DELETE FROM login WHERE amb_id=$aid";
	$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
	if ($res1>0 && $res2>0) {
		echo "<script>alert('Data deleted');document.location='ViewAmbulanceDetails.php'</script>";
	}
?>