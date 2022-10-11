<?php

$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master.php");


session_start();
	$user=$_SESSION['user'];
	
	
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$did=$_GET['id'];
	$q1="SELECT disease_name,bed_type,description FROM `disease_details` WHERE disease_id=$did";
	$res1=mysqli_query($con,$q1) or die(mysqli_error($con));
	$r1=mysqli_fetch_array($res1);
	$bed=$r1['bed_type'];
	$q2="SELECT quantity,rate_per_day FROM `bed_info` WHERE bed_type='$bed' AND hos_name='$hos'";
	$res2=mysqli_query($con,$q2) or die(mysqli_error($con));
	$r2=mysqli_fetch_array($res2);
?>
<html>
<head>
	<title>Disease Details</title>
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
<script type="text/javascript">
function validate()
{
	var name=document.forms["my"]["dname"].value;
	var bed=document.forms["my"]["bed"].value;
	var desc=document.forms["my"]["desc"].value;
	var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
	var desc_pat=/^[\w][\w\s\-\&\.\,\']+$/;

	if(!char.test(name)) {
		alert("Enter proper disease name");
		document.forms["my"]["dname"].focus();
		return false;
	}
	if(!char.test(bed)) {
		alert("Enter proper ICU Bed Type");
		document.forms["my"]["bed"].focus();
		return false;
	}
	if(!desc_pat.test(desc)) {
		alert("Enter proper description");
		document.forms["my"]["desc"].focus();
		return false;
	}
} 
</script>
<div class="single">
	<div class="container">
		<div class="single-grid">
			<div class="lone-line">
				<h1>Edit Disease Details</h1><hr>
				<div class="simply">
					<form action="Disease_update.php" name="my" method="post" onSubmit="return validate()">
						<input type="hidden" name="id" value="<?php echo $did; ?>">
						<input type="text" name="dname" value="<?php echo $r1['disease_name']?>" required="required" placeholder="Disease name">
						<input type="hidden" name="oldbed" value="<?php echo $r1['bed_type']; ?>">
						<input type="text" name="bed" value="<?php echo $r1['bed_type']?>" required="" placeholder="ICU Bed Type">
						<input type="number" name="qty" value="<?php echo $r2['quantity']?>" placeholder="Quantity" required="" />
						<input type="number" name="rate" value="<?php echo $r2['rate_per_day']?>" placeholder="Rate per day" required="" />
						<textarea name="desc" placeholder="Description"><?php echo $r1['description']?></textarea>
						<input type="submit" value="Update" />
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
					<p ><?php echo $row1['hospital_name']; ?></p>
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
