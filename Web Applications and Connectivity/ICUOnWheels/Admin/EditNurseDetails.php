<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_connect($con)); 
$nid=$_GET['id'];
$query2="SELECT * FROM nurse_details WHERE nurse_id=$nid";
$qexe2=mysqli_query($con,$query2) or die(mysqli_error($con));
$qans2=mysqli_fetch_array($qexe2);
?>
<html>
<head>
	<title>Edit Nurse Details</title>
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
					<span>Edit Nurse Details</span>
				</h2>
			</div>

			<div class="grid-form">
				<div class="grid-form1">
		  	       	<h3>Edit Nurse Details</h3>
					<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="Nurse_update.php" method="POST" name="add_nurse" onsubmit="return validate();">
								<div class="form-group">
									<label for="nurse_id" class="col-sm-2 control-label">Nurse ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="nurse_id" placeholder="Nurse ID" value="<?php echo $nid ?>" readonly="">
									</div>
								</div>
								<div class="form-group">
									<label for="user" class="col-sm-2 control-label">Ambulance Username</label>
									<div class="col-sm-8">
										<select class="form-control1" name="user">
											<?php
												$amb_username=$qans2['amb_user'];
												echo "<option value=".$qans2['amb_user'].">".$qans2['amb_user']."</option>";
												$query1="SELECT username FROM ambulance_details WHERE username<>'$amb_username'";
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
										<input type="text" class="form-control1" name="nurse_name" placeholder="Nurse Name" value="<?php echo $qans2['nurse_name'] ?>" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="exper" class="col-sm-2 control-label">Working Experiance</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="exper" placeholder="Working Experiance" value="<?php echo $qans2['nurse_exper'] ?>" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="degree" class="col-sm-2 control-label">Qualification</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="degree" placeholder="Qualification" value="<?php echo $qans2['nurse_qua'] ?>" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="phno" class="col-sm-2 control-label">Phone Number</label>
									<div class="col-sm-8">
										<input type="number" class="form-control1" name="phno" placeholder="Phone Number" value="<?php echo $qans2['nurse_phno'] ?>" required="">
									</div>
								</div>
								<div class="form-group">
									<label for="emailid" class="col-sm-2 control-label">Email ID</label>
									<div class="col-sm-8">
										<input type="email" class="form-control1" name="emailid" placeholder="Email ID" value="<?php echo $qans2['nurse_email'] ?>" required="">
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<input type="Submit" class="btn-primary btn" value="Update" />
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

