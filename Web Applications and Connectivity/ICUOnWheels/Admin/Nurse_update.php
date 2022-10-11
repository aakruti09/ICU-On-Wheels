<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	
	$nurse_id=$_POST['nurse_id'];
	$amb=$_POST['user'];	
	$nurse_name=$_POST['nurse_name'];
	$exper=$_POST['exper'];
	$degree=$_POST['degree'];
	$phno=$_POST['phno'];
	$emailid=$_POST['emailid'];

	$query1="UPDATE nurse_details SET amb_user='$amb',nurse_name='$nurse_name',nurse_exper='$exper',nurse_qua='$degree',nurse_phno='$phno',nurse_email='$emailid' WHERE nurse_id=$nurse_id";
	$qexe1=mysqli_query($con,$query1) or die(mysqli_error($con));
	if ($qexe1==1) {
		echo "<script>alert('Data Updated');document.location='ViewNurseDetails.php'</script>";
	}
?>