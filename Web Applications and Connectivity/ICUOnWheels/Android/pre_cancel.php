<?php
$link=new mysqli("localhost","root","","extra") or die(mysqli_error($link));
$amb=$_POST['amb'];
$qry1="SELECT book_id FROM booking WHERE amb_username='$amb' AND status<>'Cancelled' ORDER BY book_id DESC";
$kaib=$link->query($qry1);
if($kaib->num_rows===0)
{
	echo "No booking";
}
else{
	$result1=$link->query($qry1);
	while ($r=mysqli_fetch_assoc($result1)) {
		$output1[]=$r;
	}
	echo json_encode($output1);
}

?>