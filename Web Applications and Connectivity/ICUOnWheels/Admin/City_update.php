<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	
	$city_id=$_POST['city_id'];	
	$city_name=$_POST['city_name'];
	
	$query1="UPDATE city_details SET city='$city_name' WHERE city_id=$city_id";
	$qexe1=mysqli_query($con,$query1) or die(mysqli_error($con));
	if ($qexe1==1) {
		echo "<script>alert('Data Updated');document.location='ViewCityDetails.php'</script>";
	}
?>