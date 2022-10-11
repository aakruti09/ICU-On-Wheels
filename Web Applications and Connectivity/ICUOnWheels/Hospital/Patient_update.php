<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	session_start();
	$user=$_SESSION['user'];
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row=mysqli_fetch_array($result);
	$hos=$row['hospital_name'];

	$pid=$_POST['pat_id'];
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
	$adate=$_POST['adate'];
	$oldcond=$_POST['oldcond'];

	echo "<script>alert($oldcond);alert($disease)</script>";

	$qry2="SELECT bed_type FROM `disease_details` WHERE disease_id=$disease";
	$res2 = mysqli_query($con,$qry2) or die(mysqli_error($con));
	$r2=mysqli_fetch_array($res2);
	$dbed=$r2['bed_type'];

	$qry5="SELECT bed_type FROM `disease_details` WHERE disease_id=$oldcond";
	$res5 = mysqli_query($con,$qry5) or die(mysqli_error($con));
	$r5=mysqli_fetch_array($res5);
	$obed=$r5['bed_type'];

	$qry3="UPDATE bed_info SET empty_beds=empty_beds-1,reserved_beds=reserved_beds+1 WHERE hos_name='$hos' AND bed_type='$dbed' AND empty_beds>0 AND quantity=empty_beds+reserved_beds";
	$res3=mysqli_query($con,$qry3) or die(mysqli_error($con));
	
	if($res3>0) 
	{
		
		$qry4="UPDATE bed_info SET empty_beds=empty_beds+1,reserved_beds=reserved_beds-1 WHERE bed_type='$obed' AND hos_name='$hos' AND reserved_beds>0 AND quantity=empty_beds+reserved_beds";
		$res4=mysqli_query($con,$qry4) or die(mysqli_error($con));
		
		if ($res4>0) 
		{
			$qry1="UPDATE patient_details SET patient_name='$pname',age=$age,gender='$gender',pcondition=$disease,admited_date='$adate',address='$addr',city=$city,occupation='$occu',phone_number=$phno,relation='$rel',rel_name='$rel_name',mediclaim='$medi',doc_id=$doc_id,description='$desc' WHERE patient_id=$pid AND (hospital_name='$hos' OR hospital_name='Ambulance $hos')";
			$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
			
			if($res1==1) 
			{
				echo "<script>alert('Data Updated.');document.location='PatientDetails.php'</script>";
			}
		}
		else 
		{
			echo "<script>alert('No such bed is booked. Sorry');document.location='Patient_edit.php'</script>";
		}
	}
	else 
	{
		echo "<script>alert('No beds empty. Sorry');document.location='Patient_edit.php'</script>";
	}
?>