<?php

$server_name="localhost";
$user_name="root";
$password="";
$data_base_name="extra";
$old_pwd=$_POST['old_pwd'];
$new_pwd=$_POST['new_pwd'];
 
$link=new mysqli($server_name,$user_name,$password,$data_base_name);
 
if($link->connect_error){
	die('connectfail'.$link->connect_error);
}
 
$qry="SELECT * FROM login WHERE user_name= 'okayeee' and type='Ambulance'";
 
$result=($link->query($qry));
 
if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc())
	{
       if($row['password'] === $old_pwd)
	   {
	   		$qry1="update login set password='$new_pwd' where user_name= 'okayeee' and type='Ambulance'";
			$link->query($qry1);
	   }
	   else
	   {
		   echo "not working";
	   }
    }
}

else
{
    echo "Sry something wrong";
}

$link->close();
?>