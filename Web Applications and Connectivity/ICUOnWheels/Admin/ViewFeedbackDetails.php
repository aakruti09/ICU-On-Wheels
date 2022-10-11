<?php include("master.php"); 
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Feedback Details</title>
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
					<span>View Feeback Details</span>
				</h2>
			</div>
			<div class="grid-form">
				<div class="grid_3 grid_4">
					<center><h3 class="head-top">Feedback Details</h3>
					<?php
						$sql="SELECT feedback_id,hospital_name,message FROM feedback";
						$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
						echo "<table border=1 class='table table-bordered'>
						<tr>
							<th>Feedback ID</th>
							<th>Hospital Name</th>
							<th>Message</th>
						</tr>";
						while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
						echo "<tr>";
						echo "<td>" . $record['feedback_id'] . "</td>";
						echo "<td>" . $record['hospital_name'] . "</td>";
						echo "<td>" . $record['message'] . "</td>";
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