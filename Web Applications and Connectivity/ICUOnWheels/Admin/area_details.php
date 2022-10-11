<html>
<head>
</head>

<body>
<?php

$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
?>
	<select name="drparea" id="selector1" class="form-control1">
	<?php
	echo "<option>--SELECT AREA--</option>";
	$b=$_GET["r"];
	//echo $b;

	$qry=mysqli_query($con,"select * from area where city_id=".$b."") or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($qry))
	{
	echo "<option value=".$row['area_id'].">".$row['area_name']."</option>";
	}
?>
	</select>
</body>
</html>