<?php 
include('master.php');
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Ambulance Details</title>
</head>

<body>

	<div id="page-wrapper" class="gray-bg dashbard-1">
    <div class="content-main">
 	<!--banner-->	
	<div class="banner">
		<h2>
		<a href="index.php">Home</a>
		<i class="fa fa-angle-right"></i>
			<span>View Ambulance Details</span>
		</h2>
	</div>

	<div class="grid-form">
		<div class="grid_3 grid_4">
			<center>
			<h3 class="head-top">Ambulance Details</h3>
			<?php
				$sql="SELECT * FROM ambulance_details,login WHERE ambulance_details.amb_id=login.amb_id";
				$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
				echo "<table border=1 class='table table-bordered'>
				<tr>
					<th></th>
					<th></th>
					<th>Ambulance ID</th>
					<th>Ambulance number</th>
					<th>Username</th>
					<th>Password</th>
					<th>Phone number</th>
				</tr>";
				while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
					echo "<tr>";
					$aid=$record['amb_id']; 
					echo '<td><a href="EditAmbulanceDetails.php?id='.$aid.'"><img src="images/Edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>';
					echo '<td><a href="Amb_Delete.php?id='.$aid.'"><img src="images/Delete.png" width="15px" height="15px" style="margin-right: 10px" />Delete</a></td>';
					echo "<td>" . $record['amb_id'] . "</td>";
					echo "<td>" . $record['amb_no'] . "</td>"; 
					echo "<td>" . $record['username'] . "</td>";
					echo "<td>" . $record['password'] . "</td>";
					echo "<td>" . $record['phno'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
			?>
		</center>
		</div>

		<!--<div class="grid-form1">
  	       	<h3>Add Ambulance Details</h3>
         	<div class="tab-content">
				<div class="tab-pane active" id="horizontal-form">
					<form class="form-horizontal" action="Amb_Add.php" method="POST" name="add_amb" enctype="multipart/form-data">
						<div class="form-group">
							<label for="username" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">Amb Vehicle Number</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="veh_num" placeholder="Ambulance Vehicle Number">
							</div>
						</div>
						<div class="form-group">
							<label for="pwd" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control1" name="pwd" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<label for="cpwd" class="col-sm-2 control-label">Confirm Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control1" name="cpwd" placeholder="Confirm Password">
							</div>
						</div>
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">Phone Number</label>
							<div class="col-sm-8">
								<input type="number" class="form-control1" name="phno" placeholder="Phone Number">
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputFile" class="col-sm-2 control-label">Profile Image</label>
							<div class="col-sm-8">
								<input type="file" name="profile" class="form-control1">
							</div>
					    </div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="Submit" class="btn-primary btn" value="Add" />
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
	    </div>-->
  	</div>
	<div class="copy"><p> ICU On Wheels. A passion for putting patient first.</p></div>
	</div>
	<div class="clearfix"> </div>
    </div>
<!--content-->

<link rel="stylesheet" href="css/swipebox.css">
	<script src="js/jquery.swipebox.min.js"></script> 
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
</script>
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

</body>
</html>

