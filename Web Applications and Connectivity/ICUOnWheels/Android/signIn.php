<?php

$link=new mysqli("localhost","root","","extra");
if($link->connect_error){
	die('connectfail'.$link->connect_error);
}

$name=$_POST['name'];
$user_password=$_POST['password'];
 
$qry="SELECT * FROM login WHERE user_name='$name' and type='Ambulance'";
$result=($link->query($qry));
if ($result->num_rows == 1)
{
    while($row = $result->fetch_assoc())
	{
       if($row['password'] == $user_password)
	   {
		    $qry1="UPDATE login SET last_login=localtimestamp WHERE user_name='$name'";
		    if(($link->query($qry1)) == TRUE)
			{
				echo "Success ".$name;
			}
	   }
	   else
	   {
		   echo "Wrong Password";
	   }
    }
}
else
{
    echo "Register plz";
}
$link->close();
?>