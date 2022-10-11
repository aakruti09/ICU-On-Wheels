<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con)); ?>
<html>
<head>
	<title>View Hospital Details</title>

</head>

<body>
	<script type="text/javascript">
		function showArea(str)
		{
			if (str=="")
			{  
			  document.getElementById("area").innerHTML="";
			  return;
			} 
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    	document.getElementById("area").innerHTML=xmlhttp.responseText;
			    }
			}
			xmlhttp.open("GET","area_details.php?r="+str,true);
			xmlhttp.send();
		}
	</script>
	<div id="page-wrapper" class="gray-bg dashbard-1">
    	<div class="content-main">
 
			<div class="banner">
				<h2>
					<a href="index.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>View Hospital Details</span>
				</h2>
			</div>

			<div class="grid-form">
				<div class="grid_3 grid_4">
					<center><h3 class="head-top">Hospital Details</h3>
					<?php

						$sql="SELECT hospital_details.hospital_id,hospital_name,hospital_details.user_name,login.password,hospital_details.type,address,phone_no,email,madiclaim FROM hospital_details,login WHERE hospital_details.hospital_id=login.hospital_id";
						$myData=mysqli_query($con,$sql) or die(mysqli_error($con));
						echo "<table border=1 class='table table-bordered'>
						<tr>
						<th style='width: 110px'></th>
						<th>Hospital ID</th>
						<th>Hospital Name</th>
						<th>Username</th>
						<th>Type</th>
						<th>Address</th>
						<th>Phone number</th>
						<th>Mediclaim Details</th>
						</tr>";
						while($record=mysqli_fetch_array($myData,MYSQLI_BOTH)){
						echo "<tr>";
						$hid=$record['hospital_id']; 
						//echo '<td><a href=".php?id='.$hid.'"><img src="images/Edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>';
						echo '<td><a href="Hos_Delete.php?id='.$hid.'"><img src="images/Delete.png" width="15px" height="15px" style="margin-right: 10px" />Delete</a></td>';
						echo "<td>" . $record['hospital_id'] . "</td>";
						echo "<td>" . $record['hospital_name'] . "</td>";
						echo "<td>" . $record['user_name'] . "</td>";
						echo "<td>" . $record['type'] . "</td>";
						echo "<td>" . $record['address'] . "</td>";
						echo "<td>" . $record['phone_no'] . "</td>";
						echo "<td>" . $record['madiclaim'] . "</td>";
						echo "</tr>";
						}
						echo "</table>";
					?>
					</center>
				</div>

				<!--<div class="grid-form1">
					<h3>Add Hospital Details</h3>
		         	<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="Hos_Add.php" method="POST" name="add_hos" enctype="multipart/form-data">
								<div class="form-group">
									<label for="hos_name" class="col-sm-2 control-label">Hospital name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="hos_name" placeholder="Hospital Name">
									</div>
								</div>
								<div class="form-group">
									<label for="username" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="username" placeholder="Username">
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
									<label for="selector1" class="col-sm-2 control-label">Type</label>
									<div class="col-sm-8"><select name="type" id="selector1" class="form-control1">
										<option value="Private">Private</option>
										<option value="Public">Public</option>
									</select></div>
								</div>
								<div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">City</label>
									<div class="col-sm-8"><select name="city" id="selector1" class="form-control1" onchange="showArea(this.value);" required="">
										<option>--SELECT CITY--</option>
										<?php
											/*$qry1="SELECT * FROM city_details";
											$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
											while ($r=mysqli_fetch_array($res1)) {
												echo "<option value=".$r["city_id"].">".$r["city"]."</option>";
											}*/
										?>
									</select></div>
								</div>
								<div class="form-group">
									<label for="selector1" class="col-sm-2 control-label">Area</label>
									<div class="col-sm-8"><div id="area"></div></div>
								</div>
								<div class="form-group">
									<label for="txtarea1" class="col-sm-2 control-label">Address</label>
									<div class="col-sm-8"><textarea name="address" id="txtarea1" cols="50" rows="4" class="form-control1"></textarea></div>
								</div>

								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Phone Number</label>
									<div class="col-sm-8">
										<input type="number" class="form-control1" name="phno" placeholder="Phone Number">
									</div>
								</div>
								<div class="form-group">
									<label for="web_name" class="col-sm-2 control-label">Website Name</label>
									<div class="col-sm-8">
										<input type="url" class="form-control1" name="web_name" placeholder="Website Name">
									</div>
								</div>
								<div class="form-group">
									<label for="username" class="col-sm-2 control-label">Email ID</label>
									<div class="col-sm-8">
										<input type="email" class="form-control1" name="emailid" placeholder="Email ID">
									</div>
								</div>
								<div class="form-group">
									<label for="medi" class="col-sm-2 control-label">Mediclaim Details</label>
									<div class="col-sm-8">
										<div class="radio block"><label><input type="radio" name="medi" value="Yes Cashless" checked=""> Yes (Cashless Available)</label></div>	
										<div class="radio block"><label><input type="radio" name="medi" value="Yes Cash"> Yes (With Cash)</label></div>
										<div class="radio block"><label><input type="radio" name="medi" value="No"> No</label></div>
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