<?php include("master.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<title>ICU On Wheels</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/custom.css" rel="stylesheet">
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}
			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
		});
		</script>
</head>
<body>
	<div id="wrapper">
		<div class="clearfix"></div>
		<div id="page-wrapper" class="gray-bg dashbard-1">
       	<div class="content-main">
 		    <div class="banner">   
				<h2><a href="index.html">Home</a></h2>
		    </div>

		<div class="content-top">
			<div class="col-md-4 " style="width:auto">
				<div class="content-top-1" style="height:180px; width:180px; float:left; margin-right:16px; padding:5px">
				<a href="ViewAmbulanceDetails.php"><img src="images/home8.jpg" width="166" height="143"></img></a>
				<center>Ambulance Details</center>
				<div class="clearfix"> </div>
			  </div>
				
			
				<div class="content-top-1" style="height: 180px; width:180px; float:left; margin-right:16px; padding:5px">
					
						<a href="ViewHospitalDetails.php"><img src="images/Hospital_Logo.jpg" width="168" height="144"></img></a>
						<center>Hospital Details</center>
				 	<div class="clearfix">
					</div>
			  </div>
				<div class="content-top-1" style="height: 180px; width:180px; float:left; margin-right:16px; padding:5px" >
					
						<a href="ViewDoctorDetails.php"><img src="images/Doctors.png" width="167" height="143"></img></a>
						<center>Doctor Details</center>
				 	<div class="clearfix"> </div>
			  </div>
				 
			
			<div class="content-top-1" style="height:180px; width:180px; float:left; margin-right:16px; padding:5px">
				<a href="ViewBookingDetails.php"><img src="images/bed.png" width="168" height="142"></img></a>
				<center>Booking Details</center>
				
				 <div class="clearfix"> </div>
			  </div>
				
			
				<div class="content-top-1" style="height: 180px; width:180px; float:left; margin-right:16px; padding:5px">
					
						<a href="ViewFacilityDetails.php"><img src="images/disease.png" width="167" height="144"></img></a>
						<center>Facility Details</center>
				 	<div class="clearfix">
					</div>
			  </div>
		  </div>
		<div class="clearfix"> </div>
		</div>
  
		<div class="content-mid">
		  	<div class="col-md-7 mid-content-top" style="padding-left:15px">
				<div class="middle-content">
					<h3>Latest Images</h3>
					<div id="owl-demo" class="owl-carousel text-center">
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home1.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home7.png" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home3.png" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home4.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home5.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home6.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home7.png" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/home8.jpg" alt="name">
						</div>
						
					</div>
				</div>
		
				<link href="css/owl.carousel.css" rel="stylesheet">
				<script src="js/owl.carousel.js"></script>
				<script>
					$(document).ready(function() {
						$("#owl-demo").owlCarousel({
							items : 3,
							lazyLoad : true,
							autoPlay : true,
							pagination : true,
							nav:true,
						});
					});
				</script>
		  	</div>
			<div class="clearfix"> </div>
		</div>
		
		<div class="content-bottom">
		  <div class="clearfix"> </div>
		</div>

		<div class="copy"><p>ICU On Wheels. A passion for putting patient first.</p></div>
	</div>
	<div class="clearfix"> </div>
	</div>
	</div>
	<script src="js/jquery.nicescroll.js"></script>
</body>
</html>

