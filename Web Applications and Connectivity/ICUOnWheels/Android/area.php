<?php

$server_name="localhost";
$user_name="root";
$password="";
$data_base_name="extra";
$city=$_POST['city'];
 
$mysqli=new mysqli($server_name,$user_name,$password,$data_base_name);

  
$mysqli->query("area_name 'utf8'");
$sql1="SELECT area_name FROM area,city_details WHERE area.city_id=city_details.city_id and city_details.city='$city'";
//$sql1="SELECT area_name FROM area";
$result1=$mysqli->query($sql1);
while($e1=mysqli_fetch_assoc($result1))
{
	$output1[]=$e1; 
}
print(json_encode($output1)); 

$mysqli->close();	

?>