<?php
	$link=new mysqli("localhost","root","","extra");
	if($link->connect_error){
		die('Connection Failed: '.$link->connect_error);
	}
	$amb=$_POST['amb'];
	$fname=$_POST['fac'];
	$other=$_POST['ofac'];
	$qty=$_POST['qty'];

	if ($fname=="Other") {
		$q1="INSERT INTO facilty(facility_name) VALUES ('$other')";
		$r1=$link->query($q1);
		if ($r1==1) {
			$qry1="SELECT facility_id FROM `facilty` WHERE facility_name='$other'";
			$res1=mysqli_query($link,$qry1) or die(mysqli_error($link));
			$race=mysqli_fetch_array($res1);
			$fid=$race['facility_id'];
		}
	} 
	else {
			$qry2="SELECT facility_id FROM `facilty` WHERE facility_name='$fname'";
			$res2=mysqli_query($link,$qry2) or die(mysqli_error($link));
			$race2=mysqli_fetch_array($res2);
			$fid=$race2['facility_id'];
	}
	$q2="SELECT fac_id FROM request_facility WHERE amb_username='$amb' AND fac_id=$fid";
	$r2=$link->query($q2);
	if ($r2->num_rows>=1) {
		$q3="UPDATE request_facility SET quantity=quantity+$qty,req_date=CURRENT_DATE WHERE amb_username='$amb' AND fac_id=$fid AND fac_status='Owned'";
		if ($link->query($q3)===TRUE) {
			echo "Facility Updated";
		}

	} else {
		$sql1="INSERT INTO `request_facility`( `fac_id`, `quantity`, `amb_username`, `req_date`, `fac_status`) VALUES ($fid,$qty,'$amb',CURRENT_DATE,'Owned')";
		$result1=$link->query($sql1);
		if ($result1==1) {
			echo "Facility Added !!";
		}
	}
	$link->close();
?>