<?php
$server_name="localhost";
$db_user="root";
$db_pass="";
$data_base_name="extra";

$mysqli=new mysqli($server_name,$db_user,$db_pass,$data_base_name);


$mysqli->query("city 'utf8'");
$sql1="SELECT city FROM city_details";
$result1=$mysqli->query($sql1);
while($e1=mysqli_fetch_assoc($result1))
{
	$output1[]=$e1; 
}
print(json_encode($output1)); 

$mysqli->close();	

?>