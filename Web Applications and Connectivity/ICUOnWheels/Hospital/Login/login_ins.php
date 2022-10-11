<?php
	$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	
	if(!empty('$user') && !empty('$pwd'))
	{
		$query="SELECT * FROM login WHERE user_name='$user' && password='$pwd' && type='Hospital'";
		$sql=mysqli_query($con,$query) or die(mysqli_error($con));
		if(mysqli_num_rows($sql) == 1)
		{
			$query="UPDATE login SET last_login=localtimestamp WHERE user_name='$user'" ;
			$sql=mysqli_query($con,$query) or die(mysqli_error($con));
			echo "Login successfully done!!!";
			session_start();
			$_SESSION['user'] = $user;
			echo $_SESSION['user'];
			echo $_SESSION['query'];
			echo "<script>document.location='../home.php'</script>";
		}
		else
		{
			echo "Wrong username or password....";
			echo "<script>alert('Wrong username or password....');document.location='Login.php'</script>";
		}
	}
	else
	{
		echo "<script>alert('Enter username and password both. Something is empty.');</script>";
	}
?>