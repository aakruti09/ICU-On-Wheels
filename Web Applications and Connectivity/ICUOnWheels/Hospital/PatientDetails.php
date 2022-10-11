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


	$query="SELECT patient_id,patient_name,age,gender,pcondition,admited_date,release_date,address,city,occupation,phone_number,relation,rel_name,mediclaim,doc_id FROM patient_details WHERE (hospital_name='$hos' OR hospital_name='Ambulance $hos') AND release_date='0000-00-00'";
	$result1 = mysqli_query($con,$query);

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
				<h1>PATIENT DETAILS</h1>
				<div class="simply">
				  	<h2>Add Patient Details</h2>
					<form action="Patient_insert.php" method="post" name="add_pat" onsubmit="return validate();">
						<input type="text" name="name" placeholder="Patient name" required="" /> 
					  	
					  	<p>Disease</p>
						 	<select name="disease">
							<?php
								$qry3="SELECT disease_id,disease_name FROM disease_details,bed_info WHERE disease_details.bed_type=bed_info.bed_type and bed_info.hos_name='Zydus Hospital'";
								$res2=mysqli_query($con,$qry3) or die(mysqli_error($con));
								while ($r2=mysqli_fetch_array($res2,MYSQLI_BOTH)) {
							?>
								<option value="<?php echo $r2['disease_id']; ?>">
									<?php echo $r2['disease_name']; ?>
								</option>
							<?php } ?>
							</select>
						
						<p>Gender</p>
							<input type="radio" name="gender" value="Male" style="margin-right:5px">Male</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="gender" value="Female" style="margin-right:5px" checked="">Female</input><br>
						
						<input type="number" name="age" required="" placeholder="Age" />
						
						<textarea name="addr" placeholder="Address" style="width: 51%"></textarea>
						
						<p>City</p>
						<select name="city">
							<?php
								$res3=mysqli_query($con,"SELECT * FROM city_details") or die(mysqli_error($con));
								while ($r=mysqli_fetch_array($res3,MYSQLI_BOTH)) {
								?>
							<option value="<?php echo $r['city_id']; ?>"><?php echo $r['city']; ?></option>
							<?php } ?>
						</select>

						<input type="text" name="occup" placeholder="Occupation" required="" />
						
						<input type="number" name="phno" placeholder="Phone number" required="" />
						
						<p>Relation</p>
							<select name="relation">
								<option value="Parent">Parent</option>
								<option value="Partner">Partner</option>
								<option value="Sibling">Sibling</option>
								<option value="Cousin">Cousin</option>
								<option value="Relative">Relative</option>
								<option value="Friend">Friend</option>
								<option value="Stranger">Stranger</option>
							</select>
						
						<input type="text" name="rel_name" placeholder="Relative name" required="" />
						
						<p>Will use Mediclaim</p>
							<input type="radio" name="medi" value="Yes" style="margin-right:5px" checked="">Yes</input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="medi" value="No" style="margin-right:5px">No</input>
						
						<p>Doctor</p>
							<select name="doctor">
								<?php 
								$sql=mysqli_query($con,"select * from `doctor_details` where hos_name='$hos' ");
								while($row=mysqli_fetch_array($sql,MYSQLI_BOTH))
								{
								?>
								<option value="<?php echo $row['doctor_id']; ?>"><?php echo $row['doc_name']; ?></option>
								<?php } ?>
							</select>
						
						<textarea name="desc" placeholder="Description"></textarea>

						<input type="submit" value="Add !!"/>
					</form>

					<!--<h2>Delete Patient Details</h2>
					<form method="post" action="Patient_delete.php">
						<select name="pid">
							<?php 
								//$qry1="SELECT patient_id,patient_name FROM `patient_details` WHERE hospital_name='$hos'";
								//$res1=mysqli_query($con,$qry1) or die(mysqli_error($con));
								//while ($r1=mysqli_fetch_array($res1)) {?>
									<option value="<?php// echo $r1['patient_id']?>">
									<?php //echo $r1['patient_id'].". ".$r1['patient_name'];  ?></option>
								<?php// } 	?>
						</select>
						<input type="submit" value="Delete !!"/>
					</form>-->

					<h2>View Patient Details</h2>
					<table border="1">
						<tr>
							<th style="padding-left: 70px"></th>
							<th>ID</th>
							<th>Name</th>
							<th>Age</th>
							<th>Gender</th>
							<th>Disease</th>
							<th>Admit Date</th>
							<th>Release Date</th>
							<th>Address</th>
							<th>Occupation</th>
							<th>Phone number</th>
							<th>Relation</th>
							<th>Relative Name</th>
							<th>Mediclaim</th>
						</tr>
						<?php
						while($race=mysqli_fetch_array($result1,MYSQLI_BOTH)){ ?>
						<tr>
							<?php 
								$pid=$race['patient_id']; 
								echo '<td><a href="Patient_edit.php?id='.$pid.'"><img src="images/edit.png" width="15px" height="15px" style="margin-right: 10px" />Edit</a></td>'; 
							?>
							<td><?php echo $race['patient_id']; ?></td>
							<td><?php echo $race['patient_name']; ?></td>
							<td><?php echo $race['age']; ?></td>
							<td><?php echo $race['gender']; ?></td>
							<td><?php 
									$did=$race['pcondition'];
									$qry2="select disease_name from disease_details where disease_id=$did";
									$res1=mysqli_query($con,$qry2) or die(mysqli_error($con));
									while ($r1=mysqli_fetch_array($res1,MYSQLI_BOTH)) {
										$dname=$r1['disease_name'];
										echo $dname;
									}
								?></td>
							<td><?php echo $race['admited_date']; ?></td>
							<td><?php echo $race['release_date']; ?></td>
							<td><?php echo $race['address']; ?></td>
							<td><?php echo $race['occupation']; ?></td>
							<td><?php echo $race['phone_number']; ?></td>
							<td><?php echo $race['relation']; ?></td>
							<td><?php echo $race['rel_name']; ?></td>
							<td><?php echo $race['mediclaim']; ?></td>
						<?php } ?>
				  	</table>
					<!--<form action="pat_view.php" method="post">
						<input type="text" name="pid" placeholder="Patient id" required="" />
						<input type="text" name="pname" placeholder="Patient name" required="" />
						<input type="submit" value="View !!"/>
					</form>-->
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
