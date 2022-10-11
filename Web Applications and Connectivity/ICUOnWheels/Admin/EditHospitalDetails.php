<?php include("master.php");
$con=mysqli_connect("localhost","root","","extra") or die(mysqli_connect($con)); ?>
<html>
<head>
	<title>Edit Hospital Details</title>
	<script type="text/javascript" language="javascript">
		function showArea(str)
		{
			if (str=="")
			{
				document.getElementById("area_name").innerHTML="";
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
					document.getElementById("area_name").innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","area_details.php?r="+str,true);
			xmlhttp.send();
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
		<span>Edit Hospital Details</span>
	</h2>
	</div>
	<!--//banner-->
 	<!--content-->
	<br>
	<div class="banner">
    	<h1>Add Hospital Details</h1>
		<form method="post">
		<table>
		<tr>
		<td>Hospital_name : </td>
		<td><input type="text" name="hname"/></td>
		</tr>
		<tr>
		<td>City : </td>
		<td><select name="city" onChange="showArea(this.value)">
			<option>--SELECT--</option>
		<?php 
		$query=mysqli_query($con,"select * from city_details") or die(mysqli_error($con));
		while($row=mysqli_fetch_array($query,MYSQLI_BOTH))
		{
		?>
		<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city']; ?></option>
		<?php } ?>
		</select></td>
		</tr>
		<td>Area : </td>
		<td><div id="area_name"></div></td>
		</tr>
		<tr>
		<td>Address : </td>
		<td><textarea name="addr" placeholder="Enter Address"></textarea></td>
		</tr>
		<tr>
		<td>Phone number: </td>
		<td><input type="text" name="phone"></td>
		</tr>
		<tr>
		<td>Website name : </td>
		<td><input type="url" name="web"></td>
		</tr>
		<tr>
		<td><input type="submit" value="Add"></td>
		</tr>
		</table>
		</form>

		<div class="clearfix"> </div>

		<h1>Delete Hospital Details</h1>
		<form method="post">
		<table>
		<tr>
		<td>Hospital_id :</td>
		<td><input type="text" name="id"/></td>
		</tr>
		<tr>
		<td>Hospital_name : </td>
		<td><input type="text" name="name"/></td>
		</tr>
		<tr>
		<td><input type="submit" value="Delete"></td>
		</tr>
		</table>
		</form>

		<div class="clearfix"> </div>

		<h1>View Hospital Details</h1>
		<form method="post">
		<table>
		<tr>
		<td>Hospital_id :</td>
		<td><input type="text" name="id"/></td>
		</tr>
		<tr>
		<td>Hospital_name : </td>
		<td><input type="text" name="name"/></td>
		</tr>
		<tr>
		<td><input type="submit" value="View"></td>
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

