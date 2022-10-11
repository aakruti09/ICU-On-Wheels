<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];

	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$bed=$_POST['bed'];
	$empty=$_POST['empty'];
	$qty=$_POST['qty'];
	$rate=$_POST['rate'];

	$qry1="UPDATE bed_info SET quantity=$qty,empty_beds=$empty,reserved_beds=quantity-empty_beds,rate_per_day=$rate WHERE hos_name='$hos' AND bed_type='$bed'";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	if ($res1>0) {
		echo "<script>alert('Data Updated');document.location='viewicubed.php';</script>";
	}
?>