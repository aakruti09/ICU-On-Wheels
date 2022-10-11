<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];

	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$dname=$_POST['dname'];
	$dbed=$_POST['bed'];
	$desc=$_POST['desc'];
	$qty=$_POST['qty'];
	$rate=$_POST['rate'];

	$qry1="INSERT INTO disease_details(disease_name,bed_type,description) VALUES ('$dname','$dbed','$desc')";
	$qry2="INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES ('$hos','$dbed',$qty,$qty,0,$rate)";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
	if ($res1>0 && $res2>0) {
		echo "<script>alert('Data Inserted');document.location='DiseaseDetails.php';</script>";
	}
?>