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
			$this->Cell(0,10,'Facility List',0,1,'C');
		}
		function footer(){
			$this->SetY(-15);
        	$this->SetFont('Segoe','',12);
        	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Segoe UI Bold','',12);
			$this->Cell(20,10,'Req. ID',1,0);
			$this->Cell(30,10,'Username',1,0);
			$this->Cell(40,10,'Facility Name',1,0);
			$this->Cell(20,10,'Quantity',1,0);
			$this->Cell(40,10,'Request Date',1,0);
			$this->Cell(30,10,'Facility Status',1,1);
		}
		function viewTable() {
			$this->SetFont('Segoe','',11);
			$link=new mysqli("localhost","root","","extra");
			if($link->connect_error){
				die('Connection Failed: '.$link->connect_error);
			}

			$qry1="SELECT to_timestamp FROM facility_pdf ORDER BY ID DESC LIMIT 1";
			$res1=$link->query($qry1);
			$e=mysqli_fetch_assoc($res1);
			$from=$e['to_timestamp'];

			$sql1="SELECT req_id,amb_username,facilty.facility_name,quantity,req_date,fac_status FROM request_facility,facilty WHERE request_facility.fac_id=facilty.facility_id AND request_facility.req_date BETWEEN '$from' AND LOCALTIMESTAMP";
			$result1=$link->query($sql1);
			if ($result1->num_rows>0) {
				while($e1=mysqli_fetch_assoc($result1))
				{
					$this->Cell(20,10,$e1['req_id'],1,0);
					$this->Cell(30,10,$e1['amb_username'],1,0);
					$this->Cell(40,10,$e1['facility_name'],1,0);
					$this->Cell(20,10,$e1['quantity'],1,0);
					$this->Cell(40,10,$e1['req_date'],1,0);
					$this->Cell(30,10,$e1['fac_status'],1,1);
				}
			}
			$sql2="INSERT INTO facility_pdf(from_timestamp,to_timestamp) VALUES('$from',LOCALTIMESTAMP)";
			$result2=$link->query($sql2);
		}
	}

	$pdf=new mypdf();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->headerTable();
	$pdf->viewTable();
	//$pdf->Output();
	$dir='C:/xampp/htdocs/ICUOnWheels/Admin/facility_records/';
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
	echo "<script>document.location='ViewFacilityDetails.php'</script>";
	$link->close();

?> 