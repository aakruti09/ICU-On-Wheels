<?php 

$name=$_POST['name']; //image name
$image=$_POST['image']; //image in string format
$ambno=$_POST['ambno'];
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$phno=$_POST['phno'];

$link=new mysqli("localhost","root","","extra");
 
if($link->connect_error){
	die('connectfail'.$link->connect_error);
}


	/*$image = $_POST['image'];
	$sql ="SELECT amb_id FROM ambulance_details ORDER BY amb_id ASC";
	$res = mysqli_query($con,$sql);
	$id = 0;
	
	while($row = mysqli_fetch_array($res,MYSQLI_BOTH))
	{
	$id = $row['id'];
	}
	
	$path = "upload/$id.png";
	
	$actualpath = "http://192.168.43.254/extra/android/upload/$path";*/
	 
	 
	 
	 
$restrict = "SELECT * FROM login WHERE user_name= '$user'";
$result=($link->query($restrict));
if ($result->num_rows > 0)
{
	echo "Username already used";
}
else
{
	$decodedImage = base64_decode($image);
	//$path="upload/".$name.".jpg";
	//$actualpath = "http://192.168.43.254/ICUOnWheels/Android/$path";
	$path=$name.".jpg";
    file_put_contents("upload/".$name.".jpg", $decodedImage);
	$qry = "INSERT INTO ambulance_details(amb_no,username,image,phno) VALUES('$ambno','$user','$path',$phno)";
	if(($link->query($qry))=== TRUE)
	{
		$lastid=mysqli_insert_id($link);
		//echo "last id is : ".$lastid;
		$qry1="INSERT INTO login(amb_id,user_name,password,type,last_login) VALUES('$lastid','$user','$pwd','Ambulance',localtimestamp)";

		if(($link->query($qry1))=== TRUE)
		{

			echo "Registered";
		}
		else
		{
			echo "Something went wrong Error :" .mysqli_error($link);
		}
	}
	else
	{
		echo "Something went wrong Error :" .mysqli_error($link);
	}
}

$link->close();
?>