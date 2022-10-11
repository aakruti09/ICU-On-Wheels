<?php 
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$pid=$_POST['pid'];
	$qry1="SELECT pcondition FROM patient_details WHERE patient_id=$pid";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	$r1=mysqli_fetch_array($res1);
	$did=$r1['pcondition'];

	$qry2="UPDATE bed_info,disease_details SET empty_beds=empty_beds+1,reserved_beds=reserved_beds-1 WHERE disease_details.bed_type=bed_info.bed_type AND hos_name='$hos' AND disease_details.disease_id=$did";
	$qry3="UPDATE patient_details SET release_date=CURRENT_DATE WHERE patient_id=$pid";
	$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
	$res3=mysqli_query($con,$qry3) or die(mysqli_error($con));

	if ($res2>0 && $res3>0) {
		echo "<script>alert('Bed Released');document.location='viewicubed.php'</script>";
	}
?>