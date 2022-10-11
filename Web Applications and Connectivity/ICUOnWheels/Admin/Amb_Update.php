<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$aid=$_POST['amb_id'];
	$user=$_POST['username'];
	$veh_num=$_POST['veh_num'];
	$phno=$_POST['phno'];
	$pwd=$_POST['pwd'];

	$qry1="UPDATE ambulance_details SET amb_no='$veh_num',username='$user',phno=$phno WHERE amb_id=$aid";
	$qry2="UPDATE login SET user_name='$user',password='$pwd' WHERE amb_id=$aid AND type='Ambulance'";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
	if ($res1>0 && $res2>0) {
		echo "<script>alert('Data Updated');document.location='ViewAmbulanceDetails.php'</script>";
	}
?>