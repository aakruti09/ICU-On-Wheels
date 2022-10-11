<?php

require("connection.php");
$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master.php");

session_start();
	$user=$_SESSION['user'];
	
	
	$sql="SELECT * FROM registration where user_name='$user'";
	$result = mysql_query($sql,$con);
	$row1=mysql_fetch_array($result);
	$hell=$row1['hospital_name'];
	

?>
<html>
<head>
<title>Edit Icu Bed Transaction Details</title>
</head>

<body>

<div class="single">
		<div class="container">
					<div class="single-grid">
					  <div class="lone-line">
						<h1>ICU BED TRANSACTION DETAILS</h1>
						<div class="simply">

						  
						  <?php
							include("icu_bed.php");
								
						?>
						
						
						
						
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
						<p ><?php echo $row1['hospital_name']; ?></p>
						<p><?php echo $row1['address']; ?></p>
					</div>
						<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-phone"></i>
						<div class="address1">
							<p><?php echo $row1['phone']; ?></p>
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
