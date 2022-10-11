<?php
$link=new mysqli("localhost","root","","extra") or die(mysqli_error($link));
$hos_name=$_POST['hos_name'];
$cond=$_POST['condition'];
$qry1="SELECT bed_type FROM disease_details WHERE disease_name='$cond'";
$result1=$link->query($qry1);
while ($r=mysqli_fetch_assoc($result1)) {
	# code...
	$output1[]=$r;
	$bed_type=$r['bed_type'];
}
echo json_encode($output1);
echo "<br/>&";
$qry2="SELECT empty_beds,rate_per_day FROM bed_info WHERE hos_name='$hos_name' AND bed_type='$bed_type'";
$result2=$link->query($qry2);
while ($r=mysqli_fetch_assoc($result2)) {
	# code...
	$output2[]=$r;
}
echo json_encode($output2);
echo "<br/>&";
$qry3="SELECT madiclaim FROM hospital_details WHERE hospital_name='$hos_name'";
$result3=$link->query($qry3);
while ($r=mysqli_fetch_assoc($result3)) {
	# code...
	$output3[]=$r;
}
echo json_encode($output3);
?>