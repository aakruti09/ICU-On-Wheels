<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error){
		die('Connection Failed: '.$link->connect_error);
	}
	$amb=$_POST['amb'];
	$phno=$_POST['phno'];

	$qry="SELECT * FROM ambulance_details WHERE username='$amb' AND phno=$phno";
	 
	$result=($link->query($qry));
	 
	if ($result->num_rows == 1) {
		echo "Correct";
	}
	else {
	    echo "Entered information is wrong.";
	}

	$link->close();
?>