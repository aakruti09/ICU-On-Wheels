<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$user=$_POST['username'];
	$veh_num=$_POST['veh_num'];
	$phno=$_POST['phno'];
	$pwd=$_POST['pwd'];
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

					$qry1="INSERT INTO `ambulance_details`(amb_no,username,image,phno) VALUES ('$veh_num','$user','$pic',$phno)";
					$res=mysqli_query($con,$qry1) or die(mysqli_error($con));
					if ($res>0) 
					{
						$lastid=mysqli_insert_id($con);
						$qry2="INSERT INTO login(amb_id,user_name,password,type,last_login) VALUES('$lastid','$user','$pwd','Ambulance',localtimestamp)";
						$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));

						if ($res2>0) 
						{
							move_uploaded_file($_FILES["profile"]["tmp_name"], "upload/".$pic);
							echo '<script>alert("Data Inserted");document.location="ViewAmbulanceDetails.php"</script>';
							echo "Data Inserted";	
						}
						else
						{
							echo "Login Error";
						}
					}
					else
					{
						echo "Ambulance Error.";
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