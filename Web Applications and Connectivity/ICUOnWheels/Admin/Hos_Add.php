<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$hos=$_POST['hos_name'];
	$user=$_POST['username'];
	$pwd=$_POST['pwd'];
	$type=$_POST['type'];
	$city=$_POST['city'];
	$area=$_POST['drparea'];
	$address=$_POST['address'];
	$phno=$_POST['phno'];
	$web_name=$_POST['web_name'];
	$emailid=$_POST['emailid'];
	$medi=$_POST['medi'];
	$pic=$_FILES['profile']['name'];

	if (isset($_FILES['profile']['error'])) 
	{
		if ($_FILES['profile']['error']>0) 
		{
			echo "Error: ".$_FILES['profile']['error'];
		} 
		else 
		{
			$allowed = array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'png' => 'image/png');
			$filetype=$_FILES['profile']['type'];
			$ext=pathinfo($pic,PATHINFO_EXTENSION);

			if (!array_key_exists($ext, $allowed)) {
				die("Select a valid format");
			}

			if (in_array($filetype, $allowed)) {
				if (file_exists("upload/".$pic)) {
					echo $pic." already exist.";
				} else {
					$path="http://localhost/ICUOnWheels/Admin/upload/".$pic;
					$qry1="INSERT INTO hospital_details(hospital_name,user_name,type,image,address,area,city,phone_no,website_name,email,madiclaim) VALUES ('$hos','$user','$type','$path','$address','$area','$city','$phno','$web_name','$emailid','$medi')";
					$res=mysqli_query($con,$qry1) or die(mysqli_error($con));
					if ($res>0) 
					{
						$lastid=mysqli_insert_id($con);
						$qry2="insert into login(hospital_id,user_name,password,type,last_login) values('$lastid','$user','$pwd','Hospital',localtimestamp)";
						$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));

						if ($res2>0) 
						{
							move_uploaded_file($_FILES["profile"]["tmp_name"], "upload/".$pic);
							echo '<script>alert("Data Inserted");document.location="ViewHospitalDetails.php"</script>';
							echo "Data Inserted";	
						}
						else
						{
							echo "Login Error";
						}
					}
					else
					{
						echo "Hospital Error.";
					}
				}
			} 
			else 
			{
				echo "Error";
			}
		}
	} 
	else 
	{
		echo "Already empty variable";
	}
?>