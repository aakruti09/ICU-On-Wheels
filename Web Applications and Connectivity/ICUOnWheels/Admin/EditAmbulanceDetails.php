<?php include("master.php"); 
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_connect($con));
$aid=$_GET['id'];
$qry1="SELECT * FROM ambulance_details WHERE amb_id=$aid";
$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
$r1=mysqli_fetch_array($res1);
$qry2="SELECT * FROM login WHERE amb_id=$aid";
$res2=mysqli_query($con,$qry2) or die(mysqli_error($con));
$r2=mysqli_fetch_array($res2);
?>
<html>
<head>
	<title>Edit Ambulance Details</title>
</head>

<body>
	<script type="text/javascript">
		function validate()
		{
			var name=document.forms["edit_amb"]["username"].value;
			var pwd=document.forms["edit_amb"]["pwd"].value;
			var cpwd=document.forms["edit_amb"][""].value;
			var phno=document.forms["edit_amb"]["phno"].value;

			var char=/^[a-zA-Z][a-zA-Z\s]{8,20}$/;
            var phn=/^[6789]\d{9}$/;
            
			if(!char.test(name)){
				alert("Username must start with alphabet. Username length should be between 8 to 20 letters. No special characters allowed.");
				document.forms["edit_amb"]["username"].focus();
				return false;
			}
			if(pwd.length<7){
				alert("Password must be greater than 7 letters.");
				document.forms["edit_amb"]["pwd"].focus();
                return false;
            }
			if (pwd != cpwd) {
				alert("Password and confirm password are different.");
				document.forms["edit_amb"]["cpwd"].focus();
				return false;
			}
			if(!phn.test(phno)){
				alert("Enter valid phone number");
				document.forms["edit_amb"]["phno"].focus();
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
				<span>Edit Ambulance Details</span>
		</h2>
	</div>

	<div class="grid-form">
		<div class="grid-form1">
  	       	<h3>Edit Ambulance Details</h3>
         	<div class="tab-content">
				<div class="tab-pane active" id="horizontal-form">
					<form class="form-horizontal" method="POST" action="Amb_Update.php" name="edit_amb">
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">Ambulance ID</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="amb_id" value="<?php echo $aid ?>" readonly="">
							</div>
						</div>
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">Username</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="username" placeholder="Username" value="<?php echo $r1['username'] ?>" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">Amb Vehicle Number</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="veh_num" value="<?php echo $r1['amb_no'] ?>" placeholder="Ambulance Vehicle Number" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="pwd" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" value="<?php echo $r2['password'] ?>" name="pwd" placeholder="Password" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="cpwd" class="col-sm-2 control-label">Confirm Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control1" name="cpwd" value="<?php echo $r2['password'] ?>" placeholder="Confirm Password" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="focusedinput" class="col-sm-2 control-label">Phone Number</label>
							<div class="col-sm-8">
								<input type="number" class="form-control1" name="phno" value="<?php echo $r1['phno'] ?>" placeholder="Phone Number" required="">
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="submit" class="btn-primary btn" value="Update">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
	    </div>
	</div>


	<div class="copy"><p>ICU On Wheels. A passion for putting patient first.</p></div>
	</div>
	</div>
	<div class="clearfix"> </div>
    </div>
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

