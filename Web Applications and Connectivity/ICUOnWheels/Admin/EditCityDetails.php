<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
$cid=$_GET['id'];
$query2="SELECT * FROM city_details WHERE city_id=$cid";
$qexe2=mysqli_query($con,$query2) or die(mysqli_error($con));
$qans2=mysqli_fetch_array($qexe2); ?>
<html>
<head>
	<title>Edit City Details</title>
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
		var city_name=document.forms["add_city"]["city_name"].value;

		var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
        
		if(!char.test(city_name)){
			alert("Enter proper city name");
			document.forms["add_city"]["city_name"].focus();
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
					<span>Edit City Details</span>
				</h2>
			</div>

			<div class="grid-form">
				<div class="grid-form1">
		  	       	<h3>Edit City Details</h3>
					<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="City_update.php" method="POST" name="add_city" onsubmit="return validate();">
								<div class="form-group">
									<label for="city_id" class="col-sm-2 control-label">City ID</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="city_id" placeholder="City ID" value="<?php echo $cid?>" readonly="">
									</div>
								</div>
								<div class="form-group">
									<label for="city_name" class="col-sm-2 control-label">City Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="city_name" placeholder="City Name" value="<?php echo $qans2['city']?>" required="">
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

