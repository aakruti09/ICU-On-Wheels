<html>
<head>

<title>ICU On Wheels</title>
<link rel="icon" type="image/ico" href="images/icon.png" />
<link href="css/mybootstrap.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script>
<link href="css/mystyle.css" rel="stylesheet" type="text/css" media="all" />	
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Scientist Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

</head>

<body>

<div class="header header-top">
	<div class="container"style="
    margin-left: 120.444">
		<div class="logo">
		<h1><a href="#">
			ICU on Wheels
		</a></h1>
		</div>
		
		<div class="top-nav">
			<span class="menu"><img src="images/menu.png" alt=""> </span>
			<?php
			$page=basename($_SERVER['PHP_SELF']);
			?>
				<ul>
					<li <?php if($page=="home.php") { echo "class='active' "; }?>><a href="home.php" class="hvr-sweep-to-bottom">Home</a></li>
					<li <?php if($page=="ViewProfile.php") { echo "class='active' "; }?>><a href="ViewProfile.php" class="hvr-sweep-to-bottom">Profile</a></li>
					<li <?php if($page=="viewicubed.php") { echo "class='active' "; }?>><a href="viewicubed.php" class="hvr-sweep-to-bottom">Bed Transaction</a></li>
					<li <?php if($page=="PatientDetails.php") { echo "class='active' "; }?>><a href="PatientDetails.php" class="hvr-sweep-to-bottom">Patient Details</a></li>
					<li <?php if($page=="DiseaseDetails.php") { echo "class='active' "; }?>><a href="DiseaseDetails.php" class="hvr-sweep-to-bottom">Disease Details</a></li>
					<li <?php if($page=="contact_us.php") { echo "class='active' "; }?>><a href="contact_us.php" class="hvr-sweep-to-bottom">Feedback</a></li>
					<li <?php if($page=="logout.php") { echo "class='active' "; }?>><a href="logout.php" class="hvr-sweep-to-bottom">Log out </a></li>
				</ul>
				<div class="clearfix"> </div>
						<!--script-->
					<script>
						$("span.menu").click(function(){
							$(".top-nav ul").slideToggle(500, function(){
							});
						});
				</script>				
		</div>
		<div class="clearfix"> </div>
	</div>
<!---->
</div>

	

</body>
</html>
