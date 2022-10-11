<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error());
	
	$city_name=$_POST['city_name'];
	
	$query1="INSERT INTO city_details(city) VALUES('$city_name')";
	$qexe1=mysqli_query($con,$query1) or die(mysqli_error($con));
	if ($qexe1==1) {
		echo "<script>alert('Data Inserted');document.location='ViewCityDetails.php'</script>";
	}
?>