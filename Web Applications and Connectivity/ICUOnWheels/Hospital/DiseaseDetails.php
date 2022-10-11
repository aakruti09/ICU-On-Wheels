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

	$qry1="SELECT disease_id,disease_name,disease_details.bed_type,description FROM disease_details,bed_info WHERE disease_details.bed_type=bed_info.bed_type AND bed_info.hos_name='$hos' ORDER BY disease_id";
	$res1=mysqli_query($con,$qry1);
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
				<h1>DISEASE DETAILS</h1>
				<div class="simply">
					<h2>Add Disease Details</h2>
					<form action="Disease_insert.php" name="my" method="post" onSubmit="return validate()">
						<input type="text" name="dname" required="required" placeholder="Disease name">
						<input type="text" name="bed" required="" placeholder="ICU Bed Type">
						<input type="number" name="qty" placeholder="Quantity" required="" />
						<input type="number" name="rate" placeholder="Rate per day" required="" />
						<textarea name="desc" placeholder="Description"></textarea>
						<input type="submit" value="Add" />
					</form>

					<h2>View Disease Details</h2>
					<table border="1">
					  	<tr>
					  		<th></th>
					  		<th>Disease ID</th>
					  		<th>Disease Name</th>
							<th>Bed type</th>
							<th>Description</th>
						</tr>
						<?php
						while($race=mysqli_fetch_array($res1,MYSQLI_BOTH)){ ?>
						<tr>
							<?php 
								$pid=$race['disease_id']; 
								echo '<td><a href="Disease_edit.php?id='.$pid.'"><img src="images/edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>'; 
							?>
							<td><?php echo $race['disease_id']; ?></td>
							<td><?php echo $race['disease_name']; ?></td>
							<td><?php echo $race['bed_type']; ?></td>
							<td><?php echo $race['description']; ?></td>
						</tr>
						<?php } ?>
				  	</table>
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
