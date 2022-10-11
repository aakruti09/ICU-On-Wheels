<?php include("master.php"); 
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Facility Details</title>
	<style>
	#myh1 {
	padding:50px 20px;
	}
	</style>
</head>

<body>
	<div id="page-wrapper" class="gray-bg dashbard-1">
    	<div class="content-main">
			<div class="banner">
				<h2>
					<a href="index.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>View Facility Details</span>
				</h2>
			</div>
			<div class="grid-form">
				<div class="grid_3 grid_4">
					<center><h3 class="head-top">Facility Details</h3>
					<button onclick="location.href = 'facility_pdf.php';">Generate pdf</button>
					<br/><br/>			
					<?php
						$sql="SELECT req_id,amb_username,facilty.facility_name,quantity,req_date,fac_status FROM `request_facility`,facilty WHERE facilty.facility_id=request_facility.fac_id";
						$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
						echo "<table border=1 class='table table-bordered'>
						<tr>
							<th>Request ID</th>
							<th>Username</th>
							<th>Facility Name</th>
							<th>Quantity</th>
							<th>Request Date</th>
							<th>Status</th>
						</tr>";
						while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
						echo "<tr>";
						echo "<td>" . $record['req_id'] . "</td>";
						echo "<td>" . $record['amb_username'] . "</td>";
						echo "<td>" . $record['facility_name'] . "</td>";
						echo "<td>" . $record['quantity'] . "</td>";
						echo "<td>" . $record['req_date'] . "</td>";
						echo "<td>" . $record['fac_status'] . "</td>";
						echo "</tr>";
						}
						echo "</table>";
						mysqli_close($con);
					?>
					</center>
				</div>
			</div>
			<div class="copy"><p> ICU On Wheels. A passion for putting patient first.</p></div>
		</div>
	</div>
    
	<link rel="stylesheet" href="css/swipebox.css">
	<script src="js/jquery.swipebox.min.js"></script> 
	<script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
</body>
</html>