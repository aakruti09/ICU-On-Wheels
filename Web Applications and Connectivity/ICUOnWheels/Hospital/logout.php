<?php
    session_start();
    session_destroy();
	echo "<script>alert('Successfully Logout');document.location='http://localhost/ICUOnWheels/Hospital/Login/Login.php'</script>";
    
?>
