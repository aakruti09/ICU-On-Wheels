<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_connect($con)); ?>
<html>
<head>
	<title>Edit Facility Details</title>
	<script type="text/javascript">
		function validate()
		{
			var fac=document.forms["my"]["fac_name"].value;
			var char=/^[a-zA-Z]*$/
            
			if(!char.test(fac)){
				alert("Enter proper Facility name");
				return false;
			}
        }    
		function validate1(){
    		var fac_id=document.forms["my1"]["fac_id"].value;
			var numeric=/^[0-9]+$/;
            if(!numeric.test(fac_id)){
				alert("Enter a valid number");
                return false;
            }
        }    
	</script>
</head>

<body>
	 <div id="page-wrapper" class="gray-bg dashbard-1">
     <div class="content-main">
 
 	<!--banner-->	
	<div class="banner">
	<h2>
	<a href="index.php">Home</a>
	<i class="fa fa-angle-right"></i>
		<span>Edit Facility Details</span>
	</h2>
	</div>
	<!--//banner-->
 	<!--content-->
	<br>
	<div class="banner">
		<h1>Add Facility Details</h1>
		<form name="my" onSubmit="return validate()" method="post">
		<table>
		<tr>
			<td>Facility name : </td>
			<td><input type="text" name="fac_name" required="required"></td>
		</tr>
		<tr>
			<td><input type="submit" value="Add"></td>
		</tr>
		</table>
		</form>
		<div class="clearfix"> </div>
		<h1>Delete Facility Details</h1>
		<form name="my1" onSubmit="return validate1()" method="post">
		<table>
		<tr>
			<td>Facility id : </td>
			<td><input type="text" name="fac_id" required="required"></td>
		</tr>
		<tr>
			<td><input type="submit" value="Delete"></td>
		</tr>
		</table>
		</form>
	<div class="clearfix"> </div>
 	</div>
	<br>
	
	<div class="copy"><p>ICU On Wheels. A passion for putting patient first.</p></div>
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

