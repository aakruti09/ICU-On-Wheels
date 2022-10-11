<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];
	
	
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row=mysqli_fetch_array($result);
	$hell=$row['hospital_name'];
	
	$pname=$_POST['name'];
	$disease=$_POST['disease'];
	$addr=$_POST['addr'];
	$occu=$_POST['occup'];
	$phno=$_POST['phno'];
	$rel=$_POST['relation'];
	$rel_name=$_POST['rel_name'];
	$medi=$_POST['medi'];
	$doc_id=$_POST['doctor'];
	$gender=$_POST['gender'];
	$age=$_POST['age'];
	$desc=$_POST['desc'];
	$city=$_POST['city'];

	$qry2="SELECT disease_name,bed_type FROM `disease_details` WHERE disease_id=$disease";
	$res2 = mysqli_query($con,$qry2) or die(mysqli_error($con));
	$r2=mysqli_fetch_array($res2);
	$dname=$r2['disease_name'];
	$dbed=$r2['bed_type'];

	$qry1="INSERT INTO patient_details(patient_name,age,gender,pcondition,admited_date,address,city,occupation,phone_number,relation,rel_name,mediclaim,doc_id,hospital_name,description) VALUES ('$pname',$age,'$gender',$disease,CURDATE(),'$addr','$city','$occu','$phno','$rel','$rel_name','$medi',$doc_id,'$hell','$desc')";
	$result=mysqli_query($con,$qry1) or die(mysqli_error($con));
	if($result>0)
	{
		$qry3="UPDATE bed_info SET empty_beds=empty_beds-1,reserved_beds=reserved_beds+1 WHERE hos_name='$hell' AND bed_type='$dbed' AND empty_beds>0 AND quantity=empty_beds+reserved_beds";
		$res3=mysqli_query($con,$qry3) or die(mysqli_error($con));
		if($res3>0)
		{
			echo "<script>alert('Bed Booked');document.location='PatientDetails.php'</script>";
		}
	}
?>