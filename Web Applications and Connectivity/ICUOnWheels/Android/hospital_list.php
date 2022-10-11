<?php
$server_name="localhost";
$db_user="root";
$db_pass="";
$data_base_name="extra";

$condition=$_POST['condition'];
$city=$_POST['city'];
$area=$_POST['area'];
$mediclaim=$_POST['mediclaim'];

$link=new mysqli($server_name,$db_user,$db_pass,$data_base_name) or die(mysqli_error($link));
//$m='Yes';
	$sql="SELECT bed_type FROM disease_details WHERE disease_name='$condition'";
	$result = $link->query($sql);
	$row=mysqli_fetch_assoc($result);
	$bed_type=$row['bed_type'];
	//$bed_type="Emergency ICU";
if ($condition!='Other' && $bed_type!='Emergency ICU') {
	if ($mediclaim=='Yes') {

		//For Private Hospital

		$sql1="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name='$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Private' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result1=$link->query($sql1);
		while($e1=mysqli_fetch_assoc($result1))
		{
			$output1[]=$e1;	
		}
		$sql2="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name<>'$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Private' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result2=$link->query($sql2);
		while($e2=mysqli_fetch_assoc($result2))
		{
			$output1[]=$e2;	
		}
		echo json_encode($output1);
		echo "<br>";
		echo "&";
		//For Government Hospital
		$sql3="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name='$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result3=$link->query($sql3);
		while($e1=mysqli_fetch_assoc($result3))
		{
			$output2[]=$e1;	
		}
		$sql4="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name<>'$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result4=$link->query($sql4);
		while($e2=mysqli_fetch_assoc($result4))
		{
			$output2[]=$e2;	
		}
		print(json_encode($output2));
		echo "<br>";
		echo "&";
	}
	elseif ($mediclaim=='No') {
		# code...
		//For Private Hospital
		$sql1="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name='$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Private' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result1=$link->query($sql1);
		while($e1=mysqli_fetch_assoc($result1))
		{
			$output1[]=$e1;	
		}
		$sql2="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name<>'$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Private' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result2=$link->query($sql2);
		while($e2=mysqli_fetch_assoc($result2))
		{
			$output1[]=$e2;	
		}
		print(json_encode($output1));
		echo "<br>";
		echo "&";

		//For Government Hospital
		$sql3="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name='$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result3=$link->query($sql3);
		while($e1=mysqli_fetch_assoc($result3))
		{
			$output2[]=$e1;	
		}
		$sql4="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='$city' AND area.area_name<>'$area' AND bed_info.bed_type='$bed_type' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result4=$link->query($sql4);
		while($e2=mysqli_fetch_assoc($result4))
		{
			$output2[]=$e2;	
		}
		print(json_encode($output2));
		echo "<br>";
		echo "&";
	}
}	 
else{
	echo "Sorry no bed in any hospitals yet, Shift to nearest hospital.";
}
$link->close();