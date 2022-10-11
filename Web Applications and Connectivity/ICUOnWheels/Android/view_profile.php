<?php
	$link=new mysqli("localhost","root","","extra");
	$amb=$_POST['amb'];
	$qry1="SELECT amb_no,image,phno FROM ambulance_details WHERE username='$amb'";
	$result=$link->query($qry1);
	while ($r=mysqli_fetch_assoc($result)) {
		$output[]=$r;	
	}
	echo json_encode($output);
?>