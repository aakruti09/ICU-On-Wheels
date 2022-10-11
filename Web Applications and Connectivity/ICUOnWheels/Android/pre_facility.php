<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error){
		die('Connection Failed: '.$link->connect_error);
	}
	$sql1="SELECT facility_name FROM facilty";
	$result1=$link->query($sql1);
	while($e1=mysqli_fetch_assoc($result1))
	{
		$output1[]=$e1;	
	}
	echo json_encode($output1);
	$link->close();
?>