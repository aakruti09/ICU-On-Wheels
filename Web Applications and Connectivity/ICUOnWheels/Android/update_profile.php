<?php

$link=new mysqli("localhost","root","","extra");
if($link->connect_error){
	die('connectfail'.$link->connect_error);
}

$amb=$_POST['amb'];
$phno=$_POST['phno'];
 
$qry="UPDATE `ambulance_details` SET phno=$phno WHERE username='$amb'";
$result=($link->query($qry));
if ($link->affected_rows == 1)
{
    echo "Data Updated";
}
else
{
    echo $link->connect_error;
}
$link->close();
?>