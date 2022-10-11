<html><body>
<script type="text/javascript">
	function myfun(){
		var pname=document.f1.pname.value;
		alert(typeof pname);
		//var char=/^[0-9]\d{1}$/;
		var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
		if(!char.test(pname)){
			alert("Enter proper name");
			document.forms["add_pat"]["pname"].focus();
			return false;
		}
	}
</script>	
<?php

$connect=mysqli_connect("localhost","root","","extra") or die(mysqli_error($connect));
session_start();
$user=$_SESSION['user'];
echo $user;
$id=$_GET['id'];
echo $id;
$dt=date("Y-m-d");
echo $dt;
$hos='Zydus Hospital';
$qry1="select * from patient_details where hospital_name='$hos' or hospital_name='Ambulance $hos'";
$res=mysqli_query($connect,$qry1) or die(mysqli_error($connect));
while ($r=mysqli_fetch_array($res,MYSQLI_BOTH)) {
	$did=$r['pcondition'];
	echo $did;
	$qry2="select disease_name from disease_details where disease_id=$did";
	$res1=mysqli_query($connect,$qry2) or die(mysqli_error($connect));
	while ($r1=mysqli_fetch_array($res1,MYSQLI_BOTH)) {
		$dname=$r1['disease_name'];
		echo $dname;
	}
}?>
<form name="f1" onsubmit="return myfun();">
	<input type="text" name="pname"/>
	<input type="submit" name="Hello" />
</form>
</body></html>