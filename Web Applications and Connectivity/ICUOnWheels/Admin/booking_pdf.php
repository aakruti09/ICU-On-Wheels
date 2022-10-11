<?php
	//Cell(float width, float height, string txt , mixed border(0,1,L,T,R,B) , int newline(0,1,2), string align(L,C,R), boolean fill (true,false))
	require('fpdf/fpdf.php');
	$link=new mysqli("localhost","root","","extra");
	class mypdf extends FPDF{	
		function header(){
			$this->AddFont('Segoe','','segoeui.php');
			$this->AddFont('Segoe UI Bold','','Segoe UI Bold.php');
			$this->SetFont('Segoe UI Bold','',18);
			$this->image('images/pdf_icon.png',10,6,18,18,'png');
			$this->Cell(0,10,'ICU ON WHEELS',0,1,'C');
			$this->SetFont('Segoe','',14);
			$this->Cell(0,10,'Booking List',0,1,'C');
		}
		function footer(){
			$this->SetY(-15);
        	$this->SetFont('Segoe','',12);
        	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Segoe UI Bold','',12);
			$this->Cell(20,10,'Book ID',1,0);
			$this->Cell(25,10,'Patient ID',1,0);
			$this->Cell(30,10,'Username',1,0);
			$this->Cell(45,10,'Hospital Name',1,0);
			$this->Cell(55,10,'Patient Condition',1,0);
			$this->Cell(40,10,'Booking Date',1,0);
			$this->Cell(20,10,'Status',1,0);
			$this->Cell(40,10,'Cancelled Date',1,1);
		}
		function viewTable() {
			$this->SetFont('Segoe','',11);
			$link=new mysqli("localhost","root","","extra");
			if($link->connect_error){
				die('Connection Failed: '.$link->connect_error);
			}

			$qry1="SELECT to_timestamp FROM pdf_generated ORDER BY ID DESC LIMIT 1";
			$res1=$link->query($qry1);
			$e=mysqli_fetch_assoc($res1);
			$from=$e['to_timestamp'];

			$sql1="SELECT * FROM booking WHERE booking.date_time BETWEEN '$from' AND LOCALTIMESTAMP";
			$result1=$link->query($sql1);
			if ($result1->num_rows>0) {
				while($e1=mysqli_fetch_assoc($result1))
				{
					$this->Cell(20,10,$e1['book_id'],1,0);
					$this->Cell(25,10,$e1['patient_id'],1,0);
					$this->Cell(30,10,$e1['amb_username'],1,0);
					$this->Cell(45,10,$e1['hos_name'],1,0);
					$this->Cell(55,10,$e1['patient_condition'],1,0);
					$this->Cell(40,10,$e1['date_time'],1,0);
					$this->Cell(20,10,$e1['status'],1,0);
					$this->Cell(40,10,$e1['canceled_datetime'],1,1);
				}
			}
			$sql2="INSERT INTO pdf_generated(from_timestamp,to_timestamp) VALUES('$from',LOCALTIMESTAMP)";
			$result2=$link->query($sql2);
		}
	}
	$pdf=new mypdf();
	$pdf->AliasNbPages();
	$pdf->AddPage('L');
	$pdf->headerTable();
	$pdf->viewTable();
	$dir='C:/xampp/htdocs/ICUOnWheels/Admin/booking_records/';
	$filename=date('d-m-Y').".pdf";
	$pdf->Output($dir.$filename,'F');
	/*$sql1="SELECT * FROM booking WHERE date_time >= '2019-02-01'";
	$result1=$link->query($sql1);
	if ($result1->num_rows>0) {
		while($e1=mysqli_fetch_assoc($result1))
		{
			echo $e1['book_id'];	
			
		}
	}
	else {
		echo "No records";
	}*/
	echo "<script>document.location='ViewBookingDetails.php'</script>";
	$link->close();
?> 