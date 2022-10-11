<?php
	$link=new mysqli("localhost","root","","extra");

	$amb=$_POST['amb'];
	$qry1="SELECT book_id,hos_name,patient_condition,date_time FROM booking WHERE amb_username='$amb'";
	$result=$link->query($qry1);
	if ($result->num_rows>0) 
	{
		while ($r=mysqli_fetch_assoc($result)) 
		{
			$output[]=$r;
		}
		echo json_encode($output);
	} 
	else 
	{
		echo "No booking";
	}
	$link->close();
?>