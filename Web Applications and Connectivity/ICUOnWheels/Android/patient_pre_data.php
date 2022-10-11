<?php
$server_name="localhost";
$db_user="root";
$db_pass="";
$data_base_name="extra";

$mysqli=new mysqli($server_name,$db_user,$db_pass,$data_base_name);

$mysqli->query("disease_name 'utf8'");
$sql="SELECT disease_name FROM disease_details";
$result=$mysqli->query($sql);
while($e=mysqli_fetch_assoc($result))
{
	$output[]=$e;
}

print(json_encode($output)); 

echo "<br>";
echo "&";

$sql1="SELECT city FROM city_details";
$result1=$mysqli->query($sql1);
while($e1=mysqli_fetch_assoc($result1))
{
	$output1[]=$e1; 
}
print(json_encode($output1)); 


$mysqli->close();	

?>