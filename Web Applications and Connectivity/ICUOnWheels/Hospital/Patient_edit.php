<?php
	$con=mysqli_connect("localhost","root","","extra") or die(mysqli_error($con));
	$path = $_SERVER['PHP_SELF']; 
	$page = basename($path);
	$page = basename($path, '.php');
	include("master.php");

	session_start();
	$user=$_SESSION['user'];
		
	$sql="SELECT * FROM hospital_details where user_name='$user'";
	$result = mysqli_query($con,$sql);
	$row1=mysqli_fetch_array($result,MYSQLI_BOTH);
	$hos=$row1['hospital_name'];

	$id=$_GET['id'];
	$query="SELECT patient_name,age,gender,pcondition,admited_date,release_date,address,city,occupation,phone_number,relation,rel_name,mediclaim,doc_id,description FROM patient_details WHERE (hospital_name='$hos' OR hospital_name='Ambulance $hos') AND patient_id=$id";
	$result1 = mysqli_query($con,$query);
	$r=mysqli_fetch_array($result1);
?>
<html>
<head>
	<title>Patient Details</title>
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
			var name=document.forms["add_pat"]["name"].value;
			var age=document.forms["add_pat"]["age"].value;
			var address=document.forms["add_pat"]["addr"].value;
			var occu=document.forms["add_pat"]["occup"].value;
			var phno=document.forms["add_pat"]["phno"].value;
			var rel_name=document.forms["add_pat"]["rel_name"].value;

			var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
            var numeric=/^(\d{1,2}|100)$/;
            var addr=/^[\w][\w\s\,\'\-]+$/;
            var phn=/^[6789]\d{9}$/;
            
			if(!char.test(name)){
				alert("Enter proper name");
				document.forms["add_pat"]["name"].focus();
				return false;
			}
			if(!numeric.test(age)){
				alert("Enter a valid age");
				document.forms["add_pat"]["age"].focus();
                return false;
            }
            if(!addr.test(address)){
            	alert("Enter valid address");
            	document.forms["add_pat"]["addr"].focus();
            	return false;
            }
            if(!char.test(occu)){
				alert("Enter proper Occupation");
				document.forms["add_pat"]["occup"].focus();
				return false;
			}
			if(!phn.test(phno)){
				alert("Enter valid phone number");
				document.forms["add_pat"]["phno"].focus();
                return false;
            }
            if(!char.test(rel_name)){
				alert("Enter proper relative name");
				document.forms["add_pat"]["rel_name"].focus();
				return false;
			}
        }    
</script>

<div class="single">
	<div class="container">
		<div class="single-grid">
			<div class="lone-line">
				<h1>Edit Patient Details</h1>
				<div class="simply">
				  	<br/>
				  	<!--patient_id,patient_name,age,gender,pcondition,admited_date,release_date,address,city,occupation,phone_number,relation,rel_name,mediclaim,doc_id-->
					<form action="Patient_update.php" method="post" name="add_pat" onsubmit="return validate();">
						<input type="hidden" name="pat_id" value="<?php echo $id; ?>" />
				
						<input type="text" name="name" value="<?php echo $r['patient_name']; ?>" placeholder="Patient name" required="" /> 
					  	
					  	<input type="hidden" name="oldcond" value="<?php echo $r['pcondition']; ?>">
					  	<p>Disease</p>
						 	<select name="disease">
							<?php
								$did=$r['pcondition'];
								$q1="SELECT disease_name FROM disease_details,bed_info WHERE disease_details.bed_type=bed_info.bed_type and bed_info.hos_name='Zydus Hospital' AND disease_id=$did";
								$r2=mysqli_query($con,$q1) or die(mysqli_error($con));
								$q2=mysqli_fetch_array($r2,MYSQLI_BOTH);?>

								<option value="<?php echo $did; ?>">
									<?php echo $q2['disease_name']; ?>
								</option>

								<?php
								$qry3="SELECT disease_id,disease_name FROM disease_details,bed_info WHERE disease_details.bed_type=bed_info.bed_type and bed_info.hos_name='Zydus Hospital' AND disease_id<>'$did'";
								$res2=mysqli_query($con,$qry3) or die(mysqli_error($con));
								while ($r2=mysqli_fetch_array($res2,MYSQLI_BOTH)) {
							?>
								<option value="<?php echo $r2['disease_id']; ?>">
									<?php echo $r2['disease_name']; ?>
								</option>
							<?php } ?>
							</select>
						
						<p>Gender</p>
							<?php $gender=$r['gender']; ?>
							<input type="radio" name="gender" <?php if ($gender=="Male") {
								echo "checked";
							} ?> value="Male" style="margin-right:5px">Male</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="gender" <?php if ($gender=="Female") {
								echo "checked";
							} ?> value="Female" style="margin-right:5px">Female</input><br>
						
						<input type="number" name="age" required="" value="<?php echo $r['age']; ?>" placeholder="Age" />

						<p>Admit Date</p>
						<input type="date" name="adate" required="" value="<?php echo strftime('%Y-%m-%d',strtotime($r['admited_date'])); ?>" />
						
						<textarea name="addr" placeholder="Address" style="width: 51%"><?php echo $r['address']; ?></textarea>
						
						<p>City</p>
						<select name="city">
							<?php
								$res3=mysqli_query($con,"SELECT * FROM city_details") or die(mysqli_error($con));
								while ($rc=mysqli_fetch_array($res3,MYSQLI_BOTH)) {
								?>
							<option value="<?php echo $rc['city_id']; ?>"><?php echo $rc['city']; ?></option>
							<?php } ?>
						</select>

						<input type="text" name="occup" value="<?php echo $r['occupation']; ?>" placeholder="Occupation" required="" />
						
						<input type="number" name="phno" value="<?php echo $r['phone_number']; ?>" placeholder="Phone number" required="" />
						
						<p>Relation</p>
							<select name="relation">
								<option value="<?php echo $r['relation']; ?>"><?php echo $r['relation']; ?></option>
								<option value="Parent">Parent</option>
								<option value="Partner">Partner</option>
								<option value="Sibling">Sibling</option>
								<option value="Cousin">Cousin</option>
								<option value="Relative">Relative</option>
								<option value="Friend">Friend</option>
								<option value="Stranger">Stranger</option>
							</select>
						
						<input type="text" name="rel_name" value="<?php echo $r['rel_name']; ?>" placeholder="Relative name" required="" />
						
						<p>Will use Mediclaim</p>
						<?php $medi=$r['mediclaim']; ?>
							<input type="radio" name="medi" <?php if ($medi=="Yes") {
								echo "checked";
							}?> value="Yes" style="margin-right:5px" checked="">Yes</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="medi" <?php if ($medi=="No") {
								echo "checked";
							}?> value="No" style="margin-right:5px">No</input>
						
						<p>Doctor</p>
							<select name="doctor">
							<?php 
								$docid=$r['doc_id'];
								$sqld=mysqli_query($con,"select doc_name from `doctor_details` where hos_name='$hos' AND doctor_id=$docid");
								$rowd=mysqli_fetch_array($sqld,MYSQLI_BOTH);
								?>
							<option value="<?php echo $docid; ?>"><?php echo $rowd['doc_name']; ?></option>
							<?php 
								$sqldr=mysqli_query($con,"select * from `doctor_details` where hos_name='$hos' AND doctor_id<>$docid");
								while($rowdr=mysqli_fetch_array($sqldr,MYSQLI_BOTH)) { ?>
							<option value="<?php echo $rowdr['doctor_id']; ?>"><?php echo $rowdr['doc_name']; ?></option>
							<?php } ?>
							</select>
						
						<textarea name="desc" placeholder="Description"><?php echo $r['description']; ?></textarea>

						<input type="submit" value="Update !!"/>
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
