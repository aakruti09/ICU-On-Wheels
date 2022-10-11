<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_connect($con)); ?>
<html>
<head>
	<title>Edit Area Details</title>
	<script type="text/javascript">

		function validate()
		{
			var area=document.forms["my"]["area_name"].value;
			var char=/^[a-zA-Z]*$/
            
			if(!char.test(area)){
				alert("Enter proper area name");
				return false;
			}
        }    
		function validate1()
		{
			var area=document.forms["my1"]["area_name_del"].value;
			var char=/^[a-zA-Z]*$/
            
			if(!char.test(area)){
				alert("Enter proper area name");
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
		<span>Edit Area Details</span>
	</h2>
	</div>
	<!--//banner-->
 	<!--content-->
	<br>
	<div class="banner">
    	<h1>Add Area </h1>
		<form name="my" onSubmit="return validate()" method="post">
		<table>
		<tr>
			<td>City : </td>
			<td><select name="city">
			<?php 
			$sql=mysqli_query($con,"select * from city_details") or die(mysqli_error($con)); 
			while($row=mysqli_fetch_array($sql,MYSQLI_BOTH))
			{
			?>
			<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city']; ?></option>
			<?php } ?>
			</select><br></td>
		</tr>
		<tr>
			<td>Area :</td>
			<td><input type="text" name="area_name" required="required"><br></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Add !!"></td>
		</tr>
		</table>
		</form>
	<div class="clearfix"> </div>
		<form action="area_del.php" name="my1" onSubmit="return validate1()" method="post">
		<h1>Delete area </h1>
		<table>
		<tr>
			<td>City : </td>
			<td><select name="city_del">
			<?php 
			$sql=mysqli_query($con,"select * from city_details") or die(mysqli_error($con)); 
			while($row=mysqli_fetch_array($sql,MYSQLI_BOTH))
			{
			?>
			<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city']; ?></option>
			<?php } ?>
			</select><br></td>
		</tr>
		<tr>
			<td>Area :</td>
			<td><input type="text" name="area_name_del" required="required"><br></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Delete !!"></td>
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

