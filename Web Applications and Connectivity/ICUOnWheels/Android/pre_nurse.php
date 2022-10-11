<?php
	$link=new mysqli("localhost","root","","extra");
	$amb=$_POST['amb'];
	$qry1="SELECT * FROM `nurse_details` WHERE amb_user='$amb'";
	$result1=$link->query($qry1);
	while ($r=mysqli_fetch_assoc($result1)) {
		$output1[]=$r;
	}
	echo json_encode($output1);
?>