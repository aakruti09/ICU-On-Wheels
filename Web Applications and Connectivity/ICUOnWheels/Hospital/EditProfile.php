<?php

	$con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con));
	$path = $_SERVER['PHP_SELF']; 
	$page = basename($path);
	$page = basename($path, '.php');
	include("master.php");
	session_start();
	$user=$_SESSION['user'];
	
	$sql="SELECT * FROM `hospital_details` WHERE user_name='$user'";
	$result = mysqli_query($con,$sql);
	$r1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$r1['hospital_name'];

?>
<html>
<head>
	<title>Edit Profile</title>
	<style type="text/css">
		.simply input[type="number"] {
			background: none;
			outline: none;
			border: 1px solid #BDBCBC;
			width: 51%;
			padding: 0.7em;
			margin: 0 0 1em 0;
			font-size: 1em;
		  	color:#7E7D7D;
		}
	</style>
</head>

<body>
<script type="text/javascript">
function validate()
{
	//hos name, doc name=alphabet
	//Address =special
	//phno = lenght =10

	var name=document.forms["edit_pro"]["hname"].value;
	var phno=document.forms["edit_pro"]["phno"].value;
	var addr=document.forms["edit_pro"]["addr"].value;
	var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
	var desc_pat=/^[\w][\w\s\-\&\.\,\']+$/;
	var phn=/^[16789]\d{9,12}$/;
            
	if(!char.test(name)) {
		alert("Enter proper Hospital Name");
		document.forms["edit_pro"]["hname"].focus();
		return false;
	}
	if(!phn.test(phno)){
				alert("Enter valid phone number");
				document.forms["edit_pro"]["phno"].focus();
                return false;
    }
	if(!desc_pat.test(addr)) {
		alert("Enter proper address");
		document.forms["edit_pro"]["addr"].focus();
		return false;
	}
} 
</script>
<div class="single">
	<div class="container">
		<div class="single-grid">
			<div class="lone-line">
				<h1>Edit Profile</h1><hr>
				<div class="simply">
					<form action="Profile_update.php" name="edit_pro" method="POST" onSubmit="return validate()">
						<input type="text" name="hname" value="<?php echo $hos; ?>" required="required" placeholder="Hospital name">
						<input type="text" name="uname" readonly="readonly" value="<?php echo $user; ?>">
						<textarea name="addr" placeholder="Address"><?php echo $r1['address']?></textarea>
						<input type="number" name="phno" value="<?php echo $r1['phone_no']?>" placeholder="Phone Number" required="" />

						<select name="doctor">
							<?php
								$did=$r1['doc_id'];
								$q1="SELECT * FROM doctor_details WHERE doctor_id=$did";
								$r2=mysqli_query($con,$q1) or die(mysqli_error($con));
								$q2=mysqli_fetch_array($r2,MYSQLI_BOTH);?>

							<option value="<?php echo $q2['doctor_id']; ?>">
								<?php echo $q2['doc_name'] ?>
							</option>

							<?php
								$qry3="SELECT * FROM doctor_details WHERE doctor_id<>$did AND hos_name='$hos'";
								$res2=mysqli_query($con,$qry3) or die(mysqli_error($con));
								while ($r3=mysqli_fetch_array($res2,MYSQLI_BOTH)) {
							?>
								<option value="<?php echo $r3['doctor_id'];?>">
									<?php echo $r3['doc_name']; ?>
								</option>
							<?php } ?>
						</select>
						<input type="url" name="website" value="<?php echo $r1['website_name']?>" placeholder="Website URL" />
						<input type="email" name="emailid" value="<?php echo $r1['email']?>" placeholder="Email ID" />
						<p>Mediclaim facility: </p>
							<?php $medi=$r1['madiclaim']; ?>
							<input type="radio" name="mediclaim" 
								<?php if ($medi=="Yes Cashless") {
									echo "checked";
								} ?> 
							value="Yes Cashless" style="margin-right:5px">Yes (Cashless available)</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="mediclaim" <?php if ($medi=="Yes Cash") {
								echo "checked";
							} ?> value="Yes Cash" style="margin-right:5px">Yes (With Cash available)</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="mediclaim" <?php if ($medi=="No") {
								echo "checked";
							} ?> value="No" style="margin-right:5px">Not available</input><br><br>
						<input type="submit" value="Update" />
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
					<p ><?php echo $r1['hospital_name']; ?></p>
					<p><?php echo $r1['address']; ?></p>
				</div>
					<div class="clearfix"> </div>
			</div>
			<div class="col-md-4 address-grid ">
				<i class="glyphicon glyphicon-phone"></i>
					<div class="address1">
						<p><?php echo $r1['phone_no']; ?></p>
					</div>
				<div class="clearfix"> </div>
			</div>
			<div class="col-md-4 address-grid ">
				<i class="glyphicon glyphicon-envelope"></i>
					<div class="address1">
						<p><a href="mailto:<?php echo 'krishna.aakruti@gmail.com'; ?>"><?php echo $r1['email']; ?></a></p>
					</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
</body>
</html>
