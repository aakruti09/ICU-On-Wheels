<?php
$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
$path = $_SERVER['PHP_SELF']; 
$page = basename($path);
$page = basename($path, '.php');
include("master.php");

	session_start();
	$user=$_SESSION['user'];
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);

?>
<html>
<head>
<script type="text/javascript">

		function validate()
		{
			var name=document.forms["my"]["name"].value;
			var char=/^[a-zA-Z]*$/
            
			if(!char.test(treat)){
				alert("Enter proper disease name");
				return false;
			}
        }    
</script>

<title>Disease View</title>
</head>
<body>

<div class="single">
		<div class="container">
					<div class="single-grid">
					  <div class="lone-line">
						<h1>DISEASE DETAILS</h1>
						<div class="simply">



<?php
	$id=$_POST['id'];
	$query="SELECT * FROM disease_details where disease_id='$id'";
	$result2 = mysqli_query($con,$query);
	$row=mysqli_fetch_array($result2,MYSQLI_BOTH);
		
?>


<h2>View Disease Details</h2>
<form name="my" method="post" onSubmit="return validate()">
<input type="text" name="id" required="required" placeholder="Disease id" value="<?php echo $row['disease_id']?>" readonly="readonly">
<input type="text" name="name" required="required" placeholder="Disease name" value="<?php echo $row['disease_name']?>">
<textarea name="desc" placeholder="Description" required=""><?php echo $row['description']?></textarea>
<input type="submit" name="submit" value="Update"></td>
</form>
</div>
				</div>
			</div>
		</div>
	</div>
<!--//blog-->
<!--address-->
	<div class="address">
		<div class="container">
			<div class=" address-more">
				<h3>Address</h3>
				<div class="col-md-4 address-grid">
					<i class="glyphicon glyphicon-map-marker"></i>
					<div class="address1">
						<p><?php echo $row1['hospital_name']; ?></p>
						<p><?php echo $row1['address']; ?></p>
					</div>
						<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-phone"></i>
						<div class="address1">
							<p><?php echo $row1['phone_no']; ?></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="col-md-4 address-grid ">
					<i class="glyphicon glyphicon-envelope"></i>
						<div class="address1">
							<p><a href="mailto:<?php echo $row1['email']; ?>"><?php echo $row1['email']; ?></a></p>
						</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>


</body>
</html>
