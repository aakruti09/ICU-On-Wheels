<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];

	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$did=$_POST['id'];
	$oldbed=$_POST['oldbed'];
	$dname=$_POST['dname'];
	$dbed=$_POST['bed'];
	$desc=$_POST['desc'];
	$qty=$_POST['qty'];
	$rate=$_POST['rate'];

	$qry1="UPDATE disease_details SET disease_name='$dname',bed_type='$dbed',description='$desc' WHERE disease_id=$did";
	$qry2="UPDATE `bed_info` SET bed_type='$dbed',quantity=$qty,empty_beds=$qty,reserved_beds=0,rate_per_day=$rate WHERE bed_type='$oldbed' AND hos_name='$hos'";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
	if ($res1>0 && $res2>0) {
		echo "<script>alert('Data Updated');document.location='DiseaseDetails.php';</script>";
	}
?>