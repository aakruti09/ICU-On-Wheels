<?php

	$con=mysqli_connect("localhost","root","","Extra") or die("Connection : ".mysqli_error($con));	
	$hname=$_POST['hname'];
	$user=$_POST['username'];
	$pwd=$_POST['pwd'];
	$path="upload/".$_FILES['pic']['name'];
	$city=$_POST['city'];
	$area=$_POST['drparea'];
	$address=$_POST['addr'];
	$phone=$_POST['phno'];
	$url=$_POST['wurl'];
	$email=$_POST['email'];
	$madiclaim=$_POST['mediclaim'];
	$doctor=$_POST['doctor'];

	$qty1=$_POST['qty1'];
	$eqty1=$_POST['eqty1'];
	$rate1=$_POST['rate1'];
	$qty2=$_POST['qty2'];
	$eqty2=$_POST['eqty2'];
	$rate2=$_POST['rate2'];
	$qty3=$_POST['qty3'];
	$eqty3=$_POST['eqty3'];
	$rate3=$_POST['rate3'];
	$qty4=$_POST['qty4'];
	$eqty4=$_POST['eqty4'];
	$rate4=$_POST['rate4'];
	$qty5=$_POST['qty5'];
	$eqty5=$_POST['eqty5'];
	$rate5=$_POST['rate5'];
	$qty6=$_POST['qty6'];
	$eqty6=$_POST['eqty6'];
	$rate6=$_POST['rate6'];
	$qty7=$_POST['qty7'];
	$eqty7=$_POST['eqty7'];
	$rate7=$_POST['rate7'];

	if (isset($_FILES['pic']['name'])) {
		if($_FILES['pic']['error']>0){
			echo "Error: ".$_FILES['pic']['error'];
		}else{
			$allowed = array('jpg' => 'image/jpg','jpeg' => 'image/jpeg','gif' => 'image/gif','png' => 'image/png');
			$file_name=$_FILES['pic']['name'];
			$filetype=$_FILES['pic']['type'];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);

			if (!array_key_exists($ext, $allowed)) {
				die("Select a valid Image Format");
			}
			if (in_array($filetype, $allowed)) {
				if (file_exists($path)) {
					die("Image file name already. Rename your file.");
				} else {
					move_uploaded_file($_FILES['pic']['tmp_name'], $path);
					
					$qry1=mysqli_query($con,"INSERT INTO doctor_details(doc_name) VALUES('$doctor')") or die(mysqli_error($con));
					$docid=mysqli_insert_id($con);

					$query=mysqli_query($con,"INSERT INTO hospital_details(hospital_name,user_name,image,city,area,address,phone_no,doc_id,website_name,email,madiclaim) VALUES ('$hname','$user','$path','$city','$area','$address','$phone','$docid','$url','$email','$madiclaim')" ) or die(mysqli_error($con));
					$lastid=mysqli_insert_id($con);
	
					$ins=mysqli_query($con,"insert into login(hospital_id,user_name,password,type,last_login) values('$lastid','$user','$pwd','Hospital',localtimestamp)") or die(mysqli_error($con));


					if($qty1 != '' && $qty1 > 0 && $qty1 >= $eqty1)
					{

						$q1=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Neonatal ICU',$qty1,$eqty1,$qty1-$eqty1,$rate1)") or die(mysqli_error($con));
					}
					if($qty2 != '' && $qty2 > 0 && $qty2 >= $eqty2)
					{
						$q2=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Pediatric ICU',$qty2,$eqty2,$qty2-$eqty2,$rate2)") or die(mysqli_error($con));
					}
					if($qty3 != '' && $qty3 > 0 && $qty3 >= $eqty3)
					{
						$q3=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Neuro ICU',$qty3,$eqty3,$qty3-$eqty3,$rate3)") or die(mysqli_error($con));
					}
					if($qty4 != '' && $qty4 > 0 && $qty4 >= $eqty4)
					{
						$q4=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Surgical ICU',$qty4,$eqty4,$qty4-$eqty4,$rate4)") or die(mysqli_error($con));
					}
					if($qty5 != '' && $qty5 > 0 && $qty5 >= $eqty5)
					{
						$q5=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Coronary ICU',$qty5,$eqty5,$qty5-$eqty5,$rate5)") or die(mysqli_error($con));
					}
					if($qty6 != '' && $qty6 > 0 && $qty6 >= $eqty6)
					{
						$q6=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Psychiatric ICU',$qty6,$eqty6,$qty6-$eqty6,$rate6)") or die(mysqli_error($con));
					}
					if($qty7 != '' && $qty7 > 0 && $qty7 >= $eqty7)
					{
						$q7=mysqli_query($con,"INSERT INTO bed_info(hos_name,bed_type,quantity,empty_beds,reserved_beds,rate_per_day) VALUES('$hname','Trauma ICU',$qty7,$eqty7,$qty7-$eqty7,$rate7)") or die(mysqli_error($con));
					}

					session_start();
					$_SESSION['user'] = $user;
					echo $_SESSION['user'];
					echo $_SESSION['ins'];
					echo "<script>alert('Registration Done :)');document.location='home.php'</script>";
				}
			}
			else{
				die("Invalid format");
			}
		}		
	}
	else {
		echo "Something went wrong :-(<br>Please select image :-)";
	}
?>