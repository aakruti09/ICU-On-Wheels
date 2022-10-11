<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error());
	$amb=$_POST['user'];	
	$nurse_name=$_POST['nurse_name'];
	$exper=$_POST['exper'];
	$degree=$_POST['degree'];
	$phno=$_POST['phno'];
	$emailid=$_POST['emailid'];

	$query1="INSERT INTO nurse_details(amb_user,nurse_name,nurse_exper,nurse_qua,nurse_phno,nurse_email) VALUES('$amb','$nurse_name','$exper','$degree','$phno','$emailid')";
	$qexe1=mysqli_query($con,$query1) or die(mysqli_error($con));
	if ($qexe1==1) {
		echo "<script>alert('Data Inserted');document.location='ViewNurseDetails.php'</script>";
	}
?>