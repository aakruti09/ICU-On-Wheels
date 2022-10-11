<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$cid=$_GET['id'];
	$query1="DELETE FROM city_details WHERE city_id=$cid";
	$qexe1=mysqli_query($con,$query1) or die(mysqli_error($con));
	if($qexe1==1) {
		echo "<script>alert('Data Deleted');document.location='ViewCityDetails.php'</script>";
	}
?>