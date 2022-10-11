<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error){
		die('Connection Failed: '.$link->connect_error);
	}
	$amb=$_POST['amb'];
	$old=$_POST['old'];
	$new=$_POST['new'];

$qry="SELECT * FROM login WHERE user_name= '$amb' AND type='Ambulance'";
 
$result=($link->query($qry));
 
if ($result->num_rows == 1)
{
    // output data of each row
    while($row = $result->fetch_assoc())
	{
       if($row['password'] == $old)
	   {
	   		$qry1="UPDATE login SET password='$new' WHERE user_name= '$amb' AND type='Ambulance'";
			$link->query($qry1);
			echo "Password updated.";
	   }
	   else
	   {
		   echo "Old password entered is wrong.";
	   }
    }
}

else
{
    echo "Sry something wrong.";
}

$link->close();

?>