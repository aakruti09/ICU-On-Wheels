<?php
$link=new mysqli("localhost","root","","extra");
if($link->connect_error){
	die('Connection Failed: '.$link->connect_error);
}

$name=$_POST['pname'];
$age=$_POST['page'];
$gender=$_POST['pgender'];
$condition=$_POST['pcondition'];
$ocond=$_POST['pocond'];
$address=$_POST['paddr'];
$city=$_POST['pcity'];
$occup=$_POST['poccu'];
$phno=$_POST['pphno'];
$rel=$_POST['prel'];
$relname=$_POST['prelname'];
$mediclaim=$_POST['pmedi'];

if(!empty($ocond)){
	$link->query("INSERT INTO disease_details(disease_name,bed_type) VALUES ('$ocond','Emergency ICU')") or die(mysqli_error($link));
}

$findd=$link->query("select disease_id from disease_details where disease_name='$condition'");
$row=mysqli_fetch_assoc($findd);
$did=$row['disease_id'];

$findc=$link->query("select city_id from city_details where city='$city'");
$row1=mysqli_fetch_assoc($findc);
$cid=$row1['city_id'];

$sql="INSERT INTO patient_details(patient_name,age,gender,pcondition,address,city,occupation,phone_number,relation,rel_name,mediclaim,hospital_name) VALUES ('$name','$age','$gender','$did','$address','$cid','$occup','$phno','$rel','$relname','$mediclaim','Ambulance')" or die(mysqli_error($link));
if(($link->query($sql))=== TRUE)
{
	$lastid=mysqli_insert_id($link);
	echo $lastid;
}
$link->close();
?>