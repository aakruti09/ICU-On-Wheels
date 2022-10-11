<?php
	$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
	$hname=$_POST['hname'];
	$uname=$_POST['uname'];
	$addr=$_POST['addr'];
	$phno=$_POST['phno'];
	$doctor=$_POST['doctor'];
	$website=$_POST['website'];
	$emailid=$_POST['emailid'];
	$mediclaim=$_POST['mediclaim'];

	$qry1="UPDATE `hospital_details` SET hospital_name='$hname',address='$addr',phone_no='$phno',doc_id='$doctor',website_name='$website',email='$emailid',madiclaim='$mediclaim' WHERE user_name='$uname'";
	$res=mysqli_query($con,$qry1) or mysqli_error($con);
	if($res==1){	
		echo "<script>alert('Data Updated');document.location='ViewProfile.php'</script>";
	}
?>