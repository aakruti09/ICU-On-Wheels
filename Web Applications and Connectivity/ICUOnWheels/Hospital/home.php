<?php
$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));

$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master1.php");

session_start();
	
	$user=$_SESSION['user'];	
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);

?>

<html>
<head>
<title>ICU On Wheels</title>
<style type="text/css">
	.caption p{
		font-family: 'DidactGothic';
	}
</style>
</head>

<body>
<div class="content">
	<div class="container">
		<!--content-top -->
		<div class="content-top">
			<div class="content-top1">
			  	<div class=" col-md-4 grid-top">
					<div class="top-grid">
					 <i class="glyphicon glyphicon-book"></i>
					  <div class="caption">
						<h3>What is Hospital ?</h3>
						<p> An institution providing medical and surgical treatment and nursing care for sick or injured people.</p>
					 </div>
				</div>
				</div>
				<div class=" col-md-4 grid-top">
					<div class="top-grid top">
					 <i class="glyphicon glyphicon-time home1 "></i>
					  <div class="caption">
						<h3>What is Ambulance ? </h3>
						<p> A vehicle equipped for taking sick or injured people to and from hospital, especially in emergencies.</p>
					  </div>
					</div>
				</div>
				<div class=" col-md-4 grid-top">
					<div class="top-grid">
					 <i class="glyphicon glyphicon-edit "></i>
					  <div class="caption">
						<h3>What is Doctor ? </h3>
						<p> A person who is qualified to treat people who are ill. A person who holds the highest university degree.</p>
					  </div>
					</div>
				</div>
			<div class="clearfix"> </div>
		</div>
		</div>
		<!--//content-top-->

		<!-- bed Image slider -->
		<div>
		<?php 
			include("slider.php");
		?>
		</div>
		<!-- bed Image slider -->
		
		<!--content-left -->
		<div class="content-left">
			<div class="clearfix"> </div>
		</div>
		<!--//content-left-->
	</div>
	
	
	<!--//content-bottom-->
<!--address-->
	<div class="address">
		<div class="container">
			<div class=" address-more">
				<h3>Address</h3>
				<div class="col-md-4 address-grid">
					<i class="glyphicon glyphicon-map-marker"></i>
					<div class="address1">
						<p style="font-weight: bolder; font-family: DidactGothic,Euphemia;"><?php echo $row1['hospital_name']; ?></p>
						<p style="font-family: DidactGothic,Euphemia;"><?php echo $row1['address']; ?></p>
					</div>
						<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-phone"></i>
						<div class="address1">
							<p style="font-family: DidactGothic,Euphemia;"><?php echo $row1['phone_no']; ?></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-envelope"></i>
						<div class="address1">
							<p style="font-family: DidactGothic,Euphemia;"><a href="mailto:<?php echo $row1['email']; ?>"><?php echo $row1['email']; ?></a></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--//address-->	
</div>
	

</body>
</html>
