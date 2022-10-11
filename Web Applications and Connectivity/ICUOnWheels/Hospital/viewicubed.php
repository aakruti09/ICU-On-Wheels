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
	
	$hell=$row1['hospital_name'];
	$query="SELECT * FROM bed_info where hos_name='$hell'";
	$result1 = mysqli_query($con,$query);
?>
<html>
<head>
<title>ICU Bed details</title>
</head>

<body>
<div class="single">
	<div class="container">
		<div class="single-grid">
			<div class="lone-line">
				<h1 style="padding-top:14px;">ICU Bed Transaction</h1><hr>
				<div class="simply">
					<p><?php echo $hell; ?></p>
					<table border="1">
					  	<tr>
					  		<th></th>
							<th>Bed type</th>
							<th>Total Beds</th>
							<th>Empty Beds</th>
							<th>Reserved Beds</th>
							<th>Rate</th>
						</tr>
						<?php
						while($race=mysqli_fetch_array($result1,MYSQLI_BOTH)){ ?>
						<tr>
							<?php 
								$bed=$race['bed_type']; 
								echo '<td><a href="IcuBed_edit.php?bed='.$bed.'"><img src="images/edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>'; 
							?>
							<td><?php echo $race['bed_type']; ?></td>
							<td><?php echo $race['quantity']; ?></td>
							<td><?php echo $race['empty_beds']; ?></td>
							<td><?php echo $race['reserved_beds']; ?></td>
							<td><?php echo $race['rate_per_day']; ?></td>
						</tr>
						<?php } ?>
				  	</table><br/><br/><br/>
				  	
				  	<h1 style="padding-top:14px;">Release Bed</h1><hr>
					<form method="post" action="Release_bed.php"> 
						<p>Patient id: </p>
						<select name="pid">
							<?php 
								$q1="SELECT patient_id,patient_name FROM `patient_details` WHERE release_date='0000-00-00' AND (hospital_name='$hell' OR hospital_name='Ambulance $hell')";
								$res1=mysqli_query($con,$q1) or die(mysqli_error($con));
								while ($r1=mysqli_fetch_array($res1)) { ?>
								
							<option value="<?php echo $r1['patient_id']; ?>"><?php echo $r1['patient_id'].'. '.$r1['patient_name']; ?></option>

							<?php	} ?>
						</select><br>					 
					 
					<input type="submit" name="submit" value="Release :-(">
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
