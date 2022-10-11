<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$nid=$_GET['id'];
	$query1="DELETE FROM nurse_details WHERE nurse_id=$nid";
	$qexe1=mysqli_query($con,$query1) or die(mysqli_error($con));
	if($qexe1==1) {
		echo "<script>alert('Data Deleted');document.location='ViewNurseDetails.php'</script>";
	}
?>