<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error){
		die('Connection Failed: '.$link->connect_error);
	}
	$amb=$_POST['amb'];
	$pwd=$_POST['pwd'];
	$qry="UPDATE login SET password='$pwd' WHERE user_name='$amb' AND type='Ambulance'";
	$result=($link->query($qry));
	if ($result == 1) {
	    echo "Done";
	}
	else {
	    echo "Sry something wrong";
	}
	$link->close();
?>