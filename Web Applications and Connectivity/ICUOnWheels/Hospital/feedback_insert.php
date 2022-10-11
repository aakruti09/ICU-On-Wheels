<?php 
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$msg=$_POST['message'];
	$qry1="INSERT INTO feedback(hospital_name,message) VALUES ('$hos','$msg')";
	$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
	if ($res1>0) {
		echo "<script>alert('Feedback Sended');document.location='contact_us.php'</script>";
	}

?>