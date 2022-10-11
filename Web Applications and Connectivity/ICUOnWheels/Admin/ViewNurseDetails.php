<?php include("master.php"); 
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Doctor Details</title>
	<style type="text/css">
		/*.form-horizontal .control-label {
		    margin: 10px;
		    padding-top: 7px;
		    margin-bottom: 0;
		    text-align: right;
		}*/
	</style>
</head>

<body>
<script type="text/javascript">
	function validate()
	{
		var nurse_name=document.forms["add_nurse"]["nurse_name"].value;
		var degree=document.forms["add_nurse"]["degree"].value;
		var phno=document.forms["add_nurse"]["phno"].value;

		var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
        var char_dot=/^[a-zA-Z][a-zA-Z\s\.]{1,40}$/;
        var phn=/^[6789]\d{9}$/;
        
		if(!char.test(nurse_name)){
			alert("Enter proper nurse name");
			document.forms["add_nurse"]["nurse_name"].focus();
			return false;
		}
		if(!char_dot.test(degree)){
			alert("Enter a valid degree");
			document.forms["add_nurse"]["degree"].focus();
            return false;
        }
		if(!phn.test(phno)){
			alert("Enter valid phone number");
			document.forms["add_nurse"]["phno"].focus();
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
					<span>Nurse Details</span>
				</h2>
			</div>

			<div class="grid-form">
				<div class="grid_3 grid_4">
					<center><h3 class="head-top">Nurse Details</h3>
					<?php

					$sql="select * from nurse_details";
					$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
					echo "<table border=1 class='table table-bordered'>
					<tr>
						<th style='width: 90px'></th>
						<th style='width: 110px'></th>
						<th>Nurse id</th>
						<th>Username</th>
						<th>Nurse name</th>
						<th>Experiance</th>
						<th>Qualification</th>
						<th>Phone number</th>
						<th>Email ID</th>
					</tr>";
					while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
					echo "<tr>";
					$did=$record['nurse_id']; 
					echo '<td><a href="EditNurseDetails.php?id='.$did.'"><img src="images/Edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>';
					echo '<td><a href="Nurse_delete.php?id='.$did.'"><img src="images/Delete.png" width="15px" height="15px" style="margin-right: 10px" />Delete</a></td>';
					echo "<td>" . $record['nurse_id'] . "</td>";
					echo "<td>" . $record['amb_user'] . "</td>";
					echo "<td>" . $record['nurse_name'] . "</td>";
					echo "<td>" . $record['nurse_exper'] . "</td>";
					echo "<td>" . $record['nurse_qua'] . "</td>";
					echo "<td>" . $record['nurse_phno'] . "</td>";
					echo "<td>" . $record['nurse_email'] . "</td>";
					echo "</tr>";
					}
					echo "</table>";
					?>
					</center>
				</div>

				<div class="grid-form1">
		  	       	<h3>Add Nurse Details</h3>
					<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="Nurse_add.php" method="POST" name="add_nurse" onsubmit="return validate();">
								<div class="form-group">
									<label for="user" class="col-sm-2 control-label">Ambulance Username</label>
									<div class="col-sm-8">
										<select class="form-control1" name="user">
											<option>--SELECT--</option>
											<?php
												$query1="SELECT username FROM ambulance_details";
												$qexe1=mysqli_query($con,$query1) or die(mysqli_error());
												while ($qans1=mysqli_fetch_array($qexe1,MYSQLI_BOTH)) {
													echo "<option value=".$qans1['username'].">".$qans1['username']."</option>";
												}	
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="nurse_name" class="col-sm-2 control-label">Nurse Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="nurse_name" placeholder="Nurse Name" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="exper" class="col-sm-2 control-label">Working Experiance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="exper" placeholder="Working Experiance" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="degree" class="col-sm-2 control-label">Qualification</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="degree" placeholder="Qualification" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="phno" class="col-sm-2 control-label">Phone Number</label>
									<div class="col-sm-8">
										<input type="number" class="form-control1" name="phno" placeholder="Phone Number" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="emailid" class="col-sm-2 control-label">Email ID</label>
									<div class="col-sm-8">
										<input type="email" class="form-control1" name="emailid" placeholder="Email ID" required="">
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
	<!--//scrolling js-->

</body>
</html>

