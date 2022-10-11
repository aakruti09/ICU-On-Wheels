<html>
<head>
</head>

<body>
<?php
$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
?>
	<select name="drparea" id="selector1">
	<?php
	echo "<option value='0'>Select area</option>";
	$b=$_GET["r"];
	echo $b;
	$qry=mysqli_query($con,"select * from area where city_id=".$b."");
	
	while($row=mysqli_fetch_array($qry))
	{
	echo "<option value=".$row['area_id'].">".$row['area_name']."</option>";
	}
?>
	</select>
</body>
</html>