<?php

$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master.php");

session_start();
	$user=$_SESSION['user'];
	
	
	$sqldata="SELECT * FROM hospital_details where user_name='$user'";
	$ans = mysqli_query($con,$sqldata);
	$horror=mysqli_fetch_array($ans,MYSQLI_BOTH);

?>
<html>
<head>
<title>View Profile</title>
<style>
#img1{
  -webkit-border-radius: 50em;
  -moz-border-radius: 100em;
  border-radius: 100em;
  /*border: 1px solid #c0cadd;*/
  margin-top: -4px;
	width:300px;
	height:300px;
	margin:20px
}
p{
color:#000000;
font-size:36px;
font-family:DidactGothic,Verdana;
}
td{
padding: 0.3em 1em;
font-family:DidactGothic;
}
</style>
</head>

<body>

<div class="single">
	<div class="container">
		<div class="single-grid">
			<div class="lone-line">
				<img src="images/Icon-user.png" width="60" height="57" style="float:left; margin-right: 10px;" ></img>
				<h1 style="padding-top:14px;"><?php echo "Profile"; ?></h1><hr>
				<div class="simply">
					<div style="float:left;">
<?php

$sql="SELECT city_details.city FROM city_details,hospital_details WHERE city_details.city_id=hospital_details.city AND hospital_details.user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);

$sql1="SELECT area.area_name FROM area,hospital_details WHERE area.area_id=hospital_details.area and hospital_details.user_name='$user'";
	$result1 = mysqli_query($con,$sql1);
	$row2=mysqli_fetch_array($result1,MYSQLI_BOTH);


$res=mysqli_query($con,"select * from hospital_details where user_name='$user'");
while($row=mysqli_fetch_array($res,MYSQLI_BOTH))
{ 
$nm=basename($row['image']); ?> 
<img id="img1" src="upload/<?php echo $nm; ?>">
</div>
<div style="float:left; margin:20px;">
<?php echo "<p>" .$row['hospital_name']. "</p>"; ?>

<table>
	
<tr>
	<td>User name</td>
	<td>:</td>
	<?php echo "<td>" .$row['user_name']. "</td>"; ?>
</tr>
<tr>
	<td>City</td>
	<td>:</td>
	<?php echo "<td>" .$row1['city']. "</td>"; ?>
</tr>
<tr>
	<td>Area</td>
	<td>:</td>
	<?php echo "<td>" .$row2['area_name']. "</td>"; ?>
</tr>
<tr>
	<td>Address</td>
	<td>:</td>
	<?php echo "<td>" .$row['address']. "</td>"; ?>
</tr>
<tr>
	<td>Phone</td>
	<td>:</td>
	<?php echo "<td>" .$row['phone_no']. "</td>"; ?>
</tr>
<tr>
	<td>URL</td>
	<td>:</td>
	<?php echo "<td>" .$row['website_name']. "</td>"; ?>
</tr>
<tr>
	<td>Email</td>
	<td>:</td>
	<?php echo "<td>" .$row['email']. "</td>"; ?>
</tr>
<tr>
	<td>Mediclaim details</td>
	<td>:</td>
	<?php echo "<td>" .$row['madiclaim']. "</td>"; }?>
</tr>
<tr>
	<td colspan="3" style="padding-left: 150px; padding-top: 20px;"><input class="simply" type="button" name="editprofilr_btn" value="Edit" onclick="window.location.href='EditProfile.php'"></td>
</tr>
</table>
</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--//blog-->
<!--address-->
	<div class="address">
		<div class="container">
			<div class=" address-more">
				<h3>Address</h3>
				<div class="col-md-4 address-grid">
					<i class="glyphicon glyphicon-map-marker"></i>
					<div class="address1">
						<p ><?php echo $horror['hospital_name']; ?></p>
						<p><?php echo $horror['address']; ?></p>
					</div>
						<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-phone"></i>
						<div class="address1">
							<p><?php echo $horror['phone_no']; ?></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-envelope"></i>
						<div class="address1">
							<p><a href="mailto:<?php echo $horror['email']; ?>"><?php echo $horror['email']; ?></a></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
</body>
</html>
