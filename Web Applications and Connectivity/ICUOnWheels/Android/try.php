<?php
$server_name="localhost";
$db_user="root";
$db_pass="";
$data_base_name="extra";
//$condition=$_POST['condition'];
//$city=$_POST['city'];
//$area=$_POST['area'];
//$mediclaim=$_POST['mediclaim'];

$mysqli=new mysqli($server_name,$db_user,$db_pass,$data_base_name);

$m='Yes';
	/*$sql="SELECT bed_type FROM disease_details WHERE disease_name='$pat'";
	$result = $mysqli->query($sql);
	$row=mysqli_fetch_assoc($result);
	$hell=$row['bed_type'];*/
	if ($m=='Yes') {

		//For Private Hospital

		$sql1="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Private'AND (hospital_details.madiclaim='Yes Cashless' OR hospital_details.madiclaim='Yes Cash') AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result1=$mysqli->query($sql1);
		while($e1=mysqli_fetch_assoc($result1))
		{
			$output1[]=$e1;	
		}
		$sql2="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name<>'Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Private' AND (hospital_details.madiclaim='Yes Cashless' OR hospital_details.madiclaim='Yes Cash') AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result2=$mysqli->query($sql2);
		while($e2=mysqli_fetch_assoc($result2))
		{
			$output1[]=$e2;	
		}

		
		//print(json_encode($output1));
		echo json_encode($output1);
		echo "<br>";
		echo "&";
		//For Government Hospital
		$sql3="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result3=$mysqli->query($sql3);
		while($e1=mysqli_fetch_assoc($result3))
		{
			$output2[]=$e1;	
		}
		$sql4="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name<>'Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim DESC";
		$result4=$mysqli->query($sql4);
		while($e2=mysqli_fetch_assoc($result4))
		{
			$output2[]=$e2;	
		}
		//print(json_encode($output2));
		echo json_encode($output2);
		echo "<br>";
		echo "&";
	}
	elseif ($m=='No') {
		# code...
		//For Private Hospital
		$sql1="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Private' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result1=$mysqli->query($sql1);
		while($e1=mysqli_fetch_assoc($result1))
		{
			$output1[]=$e1;	
		}
		$sql2="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name<>'Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Private' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result2=$mysqli->query($sql2);
		while($e2=mysqli_fetch_assoc($result2))
		{
			$output1[]=$e2;	
		}
		print(json_encode($output1));
		echo "<br>";
		echo "&";

		//For Government Hospital
		$sql3="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result3=$mysqli->query($sql3);
		while($e1=mysqli_fetch_assoc($result3))
		{
			$output2[]=$e1;	
		}
		$sql4="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name<>'Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY bed_info.rate_per_day";
		$result4=$mysqli->query($sql4);
		while($e2=mysqli_fetch_assoc($result4))
		{
			$output2[]=$e2;	
		}
		print(json_encode($output2));
		echo "<br>";
		echo "&";
	}
	 

$mysqli->close();	


/*SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Asarwa' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government'

//For Yes Mediclaim
SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Asarwa' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 AND (hospital_details.madiclaim='Yes Cashless' OR hospital_details.madiclaim='Yes Cash') ORDER BY hospital_details.madiclaim DESC

//For No mediclaim
SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Asarwa' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Government' AND bed_info.empty_beds>=1 ORDER BY hospital_details.madiclaim*/
/*For no madiclaim in area
		/*$sqlno1="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name='Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Private'AND hospital_details.madiclaim='No' AND bed_info.empty_beds>=1";
		$resultno1=$mysqli->query($sqlno1);
		while($e1=mysqli_fetch_assoc($resultno1))
		{
			$output1[]=$e1;	
		}

		//For no mediclaim in other area
		$sqlno2="SELECT bed_info.hos_name FROM hospital_details,city_details,area,bed_info WHERE bed_info.hos_name=hospital_details.hospital_name AND city_details.city_id=hospital_details.city AND area.area_id=hospital_details.area AND city_details.city='Ahmedabad' AND area.area_name<>'Thaltej' AND bed_info.bed_type='Neonatal ICU' AND hospital_details.type='Private'AND hospital_details.madiclaim='No' AND bed_info.empty_beds>=1"
		$resultno2=$mysqli->query($sqlno2);
		while($e1=mysqli_fetch_assoc($resultno2))
		{
			$output1[]=$e1;	
		}*/
?>