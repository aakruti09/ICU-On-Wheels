<?php
	$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
	$user=$_POST['user'];
	$emailid=$_POST['emailid'];
	
	if(!empty('$user') && !empty('$ans'))
		{

			$query="SELECT login.password FROM hospital_details,login WHERE hospital_details.user_name='$user' AND hospital_details.email='$emailid' AND hospital_details.user_name=login.user_name";
			
			$sql=mysqli_query($con,$query) or die(mysqli_error($sql));
			
			
			if(mysqli_num_rows($sql) == 1)
			{
				while($record=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
					echo "<script>alert('Password: ".$record['password']."');document.location='Login.php'</script>";
			 }
			}
			else
			{
				echo("<script>alert('Sorry we cant give you password. Given information is false.');document.location='Password.php'</script>");
			}
		}
	
?>