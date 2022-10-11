<?php

$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master.php");

session_start();
	$user=$_SESSION['user'];
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
?>
<html>
<head>
<title>Contact Us</title>
<style type="text/css">
	#map{
		width: 100%;
   		height: 400px;
   		background-color: grey;
	}
</style>
</head>

<body>
	<div class="container">
		<div class="contact">  
			<div class="contact-bottom"><br>
				<h1>Any suggesstions</h1><hr>
				<form action="feedback_insert.php" method="post">
					<textarea placeholder="Message" name="message"></textarea>	
					<input type="submit" value="Submit">
				</form>	
			</div>			
		</div>
	</div>

	<div class="address">
		<div class="container">
			<div class=" address-more">
				<h3>Address</h3>
				<div class="col-md-4 address-grid">
					<i class="glyphicon glyphicon-map-marker"></i>
					<div class="address1">
						<p><?php echo $row1['hospital_name']; ?></p>
						<p><?php echo $row1['address']; ?></p>
					</div>
						<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-phone"></i>
						<div class="address1">
							<p><?php echo $row1['phone_no']; ?></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-envelope"></i>
						<div class="address1">
							<p><a href="mailto:<?php echo $row1['email']; ?>"><?php echo $row1['email']; ?></a></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

</body>
</html>
