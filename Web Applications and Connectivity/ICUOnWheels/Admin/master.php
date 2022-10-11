<!DOCTYPE HTML>
<html>
<head>
<title>ICU ON WHEELS</title>
<link rel="icon" type="image/ico" href="images/icon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<!--<link href="css/myform.css" rel="stylesheet" type="text/css">-->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
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
<!--skycons-icons-->
<script src="js/skycons.js"></script>
<!--//skycons-icons-->
</head>
<body>
<div id="wrapper">

<!----->
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1> <a class="navbar-brand" href="index.php">ICU on Wheels</a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <!-- <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section> -->
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="clearfix">
       
     </div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="index.php" class=" hvr-bounce-to-right"><i class="fa fa-home nav_icon "></i><span class="nav-label">Home</span> </a>
                    </li>
					<li>
                        <a href="ViewAmbulanceDetails.php" class=" hvr-bounce-to-right"><i class="fa  fa-ambulance nav_icon "></i><span class="nav-label">Ambulance Details</span> </a>
                    </li>
                    <li>
                        <a href="ViewHospitalDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-hospital-o nav_icon"></i> <span class="nav-label">Hospital Details</span> </a>
                    </li>
                    <li>
                        <a href="ViewBookingDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-bed nav_icon"></i> <span class="nav-label">Booking Details</span> </a>
                    </li>
                    <li>
                        <a href="ViewFacilityDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-stethoscope nav_icon"></i> <span class="nav-label">Facility Details</span> </a>
                    </li>
                    <li>
                        <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-map-o nav_icon"></i> <span class="nav-label">Location Details</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="ViewCityDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>City Details</a></li>

                            <li><a href="ViewAreaDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>Area Details</a></li>
					   </ul>
                    </li>
                    <li>
                        <a href="ViewNurseDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-user-md nav_icon"></i> <span class="nav-label">Nurse Details</span> </a>
                    </li>
                    <li>
                        <a href="ViewFeedbackDetails.php" class=" hvr-bounce-to-right"><i class="fa fa-envelope nav_icon"></i> <span class="nav-label">Feedback Details</span> </a>
                    </li> 
                </ul>
            </div>
			</div>
        </nav>
 <!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	<script src="js/bootstrap.min.js"> </script>
</body>
</html>