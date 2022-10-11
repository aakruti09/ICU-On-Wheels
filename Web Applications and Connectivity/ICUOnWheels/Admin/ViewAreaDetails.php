<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Area Details</title>
	<style>
	#myh1 {
	padding:50px 20px;
	}
	</style>
</head>

<body>
	<script type="text/javascript">
	function validate()
	{
		var area_name=document.forms["add_area"]["area_name"].value;

		var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
        
		if(!char.test(city_name)){
			alert("Enter proper area name");
			document.forms["add_area"]["area_name"].focus();
			return false;
		}
    }    
</script>
<div id="page-wrapper" class="gray-bg dashbard-1">
    	<div class="content-main">	
			<div class="banner">
				<h2>
					<a href="index.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>Area Details</span>
				</h2>
			</div>

			<div class="grid-form">
				<div class="grid_3 grid_4">
					<center><h3 class="head-top">Area Details</h3>
						<?php
							$sql="select * from area";
							$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
							echo "<table border=1 class='table table-bordered'>
							<tr>								
							<th style='width: 90px'></th>
							<th style='width: 110px'></th>
							<th>Area id</th>
							<th>Area name</th>
							<th>City id</th>
							</tr>";
							while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
							echo "<tr>";
							$cid=$record['city_id']; 
							echo '<td><a href="EditAreaDetails.php?id='.$cid.'"><img src="images/Edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>';
							echo '<td><a href="Area_delete.php?id='.$cid.'"><img src="images/Delete.png" width="15px" height="15px" style="margin-right: 10px" />Delete</a></td>';
							echo "<td>" . $record['area_id'] . "</td>";
							echo "<td>" . $record['area_name'] . "</td>";
							echo "<td>" . $record['city_id'] . "</td>";
							echo "</tr>";
							}
							echo "</table>";
							mysqli_close($con);
						?>
					</center>
				</div>

				<div class="grid-form1">
		  	       	<h3>Add Area Details</h3>
					<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="Area_add.php" method="POST" name="add_area" onsubmit="return validate();">
								<!--<div class="form-group">
									<label for="city_name" class="col-sm-2 control-label">City Name</label>
									<div class="col-sm-8">
										<select class="form-control1" name="city_name">
											<option>--SELECT--</option>
											<?php
												/*$query1="SELECT * FROM city_details";
												$qexe1=mysqli_query($con,$query1) or die(mysqli_error());
												while ($qans1=mysqli_fetch_array($qexe1,MYSQLI_BOTH)) {
													echo "<option value=".$qans1['city_id'].">".$qans1['city']."</option>";
												}*/	
											?>
										</select>
									</div>
								</div>-->
								<div class="form-group">
									<label for="city_name" class="col-sm-2 control-label">Area Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="area_name" placeholder="Area Name" required="">
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
	    		</div>
	    	</div>
	    </div>
	</div>
	<div class="copy"><p> ICU On Wheels. A passion for putting patient first.</p></div>
	<div class="clearfix"> </div>

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
</body>
</html>