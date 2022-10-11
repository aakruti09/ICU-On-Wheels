<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Booking Details</title>
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
					<span>View Booking Details</span>
				</h2>
			</div>
			<!--//banner-->
		 	<!--content-->
			<div class="grid-form">
				<div class="grid_3 grid_4">
					<center><h3 class="head-top">Booking Details</h3>
					<button onclick="location.href = 'booking_pdf.php';">Generate pdf</button><br/><br/>
					<?php

						$sql="SELECT `book_id`, `patient_id`, `amb_username`, `hos_name`, `patient_condition`, `date_time`, `status`, `canceled_datetime` FROM `booking` LIMIT 100";
						$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
						echo "<table border=1 class='table table-bordered'>
						<tr>
						<th>Book id</th>
						<th>Patient id</th>
						<th>Ambulance</th>
						<th>Hospital Name</th>
						<th>Patient Condition</th>
						<th>Booking Date</th>
						<th>Status</th>
						<th>Cancel Date</th>
						</tr>";
						while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
						echo "<tr>";
						echo "<td>" . $record['book_id'] . "</td>";
						echo "<td>" . $record['patient_id'] . "</td>";
						echo "<td>" . $record['amb_username'] . "</td>";
						echo "<td>" . $record['hos_name'] . "</td>";
						echo "<td>" . $record['patient_condition'] . "</td>";
						echo "<td>" . $record['date_time'] . "</td>";
						echo "<td>" . $record['status'] . "</td>";
						echo "<td>" . $record['canceled_datetime'] . "</td>";
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
<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

</body>
</html>

