<?php
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master.php");


	session_start();
	$user=$_SESSION['user'];
	$bed=$_GET['bed'];
	
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];


	$query="SELECT quantity,empty_beds,reserved_beds,rate_per_day FROM `bed_info` WHERE bed_type='$bed' AND hos_name='$hos'";
	$result1 = mysqli_query($con,$query);
	$r=mysqli_fetch_array($result1);
?>
<html>
<head>
	<title>Patient Details</title>
	<style type="text/css">
		.simply input[type="number"] {
		background: none;
		outline: none;
		border: 1px solid #BDBCBC;
		width: 51%;
		padding: 0.7em;
		margin: 0 0 1em 0;
		font-size: 1em;
	  	color:#7E7D7D;
	}
	</style>
</head>

<body>
<div class="single">
	<div class="container">
		<div class="single-grid">
			<div class="lone-line">
				<h1>Edit ICU Bed Details</h1><hr>
				<div class="simply">
					<form action="IcuBed_update.php" method="post" name="icubededit">
						<input type="text" name="bed" value="<?php echo $bed; ?>" placeholder="Bed Type" readonly="readonly"/>
						<p>Quantity: </p>
						<input type="number" name="qty" value="<?php echo $r['quantity']; ?>" required="" placeholder="Quantity" />
						<p>Empty Beds</p>
						<input type="number" name="empty" value="<?php echo $r['empty_beds']; ?>" required="" placeholder="Empty Bed" />
						<p>Rate per day:</p>
						<input type="number" name="rate" value="<?php echo $r['rate_per_day']; ?>" required="" placeholder="Rate per Day" />
						<input type="submit" value="Update !!"/>
					</form>
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
