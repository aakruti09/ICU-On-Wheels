<?php $con=mysqli_connect("localhost","root","","Extra") or die(mysqli_error($con)); ?>

<html>
	<head>
		<title>ICU On Wheels | Registration</title>
		<link rel="icon" type="image/ico" href="images/icon.png" />
		<link rel="stylesheet" type="text/css" href="Registration.css"/>
		<script type="text/javascript">
			function show1(){
				if(document.getElementById("qty1").value > 0){
					document.getElementById("eqty1").readOnly=false;
					document.getElementById("rate1").readOnly=false;
				}
				else{
					document.getElementById("eqty1").readOnly=true;
					document.getElementById("rate1").readOnly=true;
					document.getElementById("eqty1").value='';
					document.getElementById("rate1").value='';
				}
				if(document.getElementById("qty2").value > 0){
					document.getElementById("eqty2").readOnly=false;
					document.getElementById("rate2").readOnly=false;
				}
				else {
					document.getElementById("eqty2").readOnly=true;
					document.getElementById("rate2").readOnly=true;
					document.getElementById("eqty2").value='';
					document.getElementById("rate2").value='';
				}
				if(document.getElementById("qty3").value > 0){
					document.getElementById("eqty3").readOnly=false;
					document.getElementById("rate3").readOnly=false;
				}
				else {
					document.getElementById("eqty3").readOnly=true;
					document.getElementById("rate3").readOnly=true;
					document.getElementById("eqty3").value='';
					document.getElementById("rate3").value='';
				}
				if(document.getElementById("qty4").value > 0){
					document.getElementById("eqty4").readOnly=false;
					document.getElementById("rate4").readOnly=false;
				}
				else {
					document.getElementById("eqty4").readOnly=true;
					document.getElementById("rate4").readOnly=true;
					document.getElementById("eqty4").value='';
					document.getElementById("rate4").value='';
				}
				if(document.getElementById("qty5").value > 0){
					document.getElementById("eqty5").readOnly=false;
					document.getElementById("rate5").readOnly=false;
				}
				else {
					document.getElementById("eqty5").readOnly=true;
					document.getElementById("rate5").readOnly=true;
					document.getElementById("eqty5").value='';
					document.getElementById("rate5").value='';
				}
				if(document.getElementById("qty6").value > 0){
					document.getElementById("eqty6").readOnly=false;
					document.getElementById("rate6").readOnly=false;
				}
				else {
					document.getElementById("eqty6").readOnly=true;
					document.getElementById("rate6").readOnly=true;
					document.getElementById("eqty6").value='';
					document.getElementById("rate6").value='';
				}
				if(document.getElementById("qty7").value > 0){
					document.getElementById("eqty7").readOnly=false;
					document.getElementById("rate7").readOnly=false;
				}
				else {
					document.getElementById("eqty7").readOnly=true;
					document.getElementById("rate7").readOnly=true;
					document.getElementById("eqty7").value='';
					document.getElementById("rate7").value='';
				}
			}
		function showArea(str)
		{
			if (str=="")
			{  
			  document.getElementById("area").innerHTML="";
			  return;
			} 
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    	document.getElementById("area").innerHTML=xmlhttp.responseText;
			    }
			}
			xmlhttp.open("GET","area_details.php?r="+str,true);
			xmlhttp.send();
		}
		</script>
	</head>
	<body>
		<script type="text/javascript">

		function validate()
		{
			var name=document.forms["reg_form"]["hname"].value;
			var doc_name=document.forms["reg_form"]["doctor"].value;
			var address=document.forms["reg_form"]["addr"].value;
			var phno=document.forms["reg_form"]["phno"].value;
			var username=document.forms["reg_form"]["username"].value;
			var pwd=document.forms["reg_form"]["pwd"].value;
			var cpwd=document.forms["reg_form"]["cpwd"].value;

			var char=/^[a-zA-Z][a-zA-Z\s]{1,40}$/;
			var user_pat=/^[a-zA-Z][a-zA-Z]{1,32}$/;
            var addr=/^[\w][\w\s\,\'\-]+$/;
            var phn=/^[6789]\d{9}$/;
            
			if((!char.test(name)) || (!char.test(doc_name))){
				alert("Enter proper hospital name or doctor name.");
				document.forms["reg_form"]["name"].focus();
				return false;
			}
            if(!addr.test(address)){
            	alert("Enter valid address");
            	document.forms["reg_form"]["addr"].focus();
            	return false;
            }
            if(!user_pat.test(username)){
            	alert("Enter valid username");
            	document.forms["reg_form"]["username"].focus();
            	return false;
            }
			if(!phn.test(phno)){
				alert("Enter valid phone number");
				document.forms["reg_form"]["phno"].focus();
                return false;
            }
            if(pwd!=cpwd){
            	alert('Both the passwords are different');
            	document.forms["reg_form"]["pwd"].focus();
                return false;
            }
        }    
</script>
	<div>
		<h1>Registration Form</h1>
		<form action="reg_ins.php" name="reg_form" method="post" enctype="multipart/form-data" onsubmit="return validate();">
			<table class="maintbl">
				<tr>
					<td colspan="4" class="heading">Hospital Personal Information<hr></td>
				</tr>
				<tr>
					<td>Hospital Name</td>
					<td colspan="3"><input type="text" id="hname" placeholder="Hospital name" name="hname" required="required" /></td>
				</tr>
				<tr>
					<td>Username</td>
					<td colspan="3"><input type="text" id="username" placeholder="Username" name="username" required="required"/></td>
				</tr>
				<tr>
					<td>Password</td>
					<td colspan="3"><input type="password" id="pwd" placeholder="Password" name="pwd" required="required" /></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td colspan="3"><input type="password" id="cpwd" placeholder="Confirm Password" name="cpwd" required="required"/></td>
				</tr>
				<tr>
					<td>Hospital Image</td>
					<td colspan="3"><input type="file" id="pic" name="pic" required="required" /></td>
				</tr>
				<tr>
					<td>City</td>
					<td colspan="3"><select id="city" name="city" onchange="showArea(this.value);" required="required">
						<option value="0">Select city</option>
						<?php 
							$query=mysqli_query($con,"select * from `city_details` ");
							while($row=mysqli_fetch_array($query)){ ?>
							<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city']; ?></option>
						<?php } ?>
					</select></td>
				</tr>
				<tr>
					<td>Area</td>
					<td colspan="3"><div id="area"></div></td>
				</tr>
				<tr>
					<td>Address</td>
					<td colspan="3"><textarea id="addr" cols="50" rows="4" placeholder="Address" name="addr" required="required"></textarea></td>
				</tr>
				<tr>
					<td>Phone number</td>
					<td colspan="3"><input type="number" id="phno" onchange="validphno(this)" placeholder="Phone number" name="phno" required="required"/></td>
				</tr>
				<tr>
					<td>Doctor name</td>
					<td colspan="3"><input type="text" name="doctor" placeholder="Doctor name" id="doctor" required="required" /></td>
				</tr>
				<tr>
					<td>Website URL</td>
					<td colspan="3"><input type="url" id="wurl" placeholder="URL" name="wurl" /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td colspan="3"><input type="email" id="email" placeholder="Email" name="email" required="required"/></td>
				</tr>
				<tr>
					<td rowspan="3">Mediclaim details</td>
					<td colspan="3" class="td_content"><input type="radio" name="mediclaim" value="Yes Cashless" checked="checked" class="except">Yes (Cashless available)</td>
				</tr>
				<tr>
					<td colspan="3" class="td_content"><input type="radio" class="except" name="mediclaim" value="Yes Cash">Yes (With Cash)</td>
				</tr>
				<tr>
					<td colspan="3" class="td_content"><input type="radio" class="except" name="mediclaim" value="No">Not available</td>
				</tr>
			
				<tr>
					<td colspan="4" class="heading">ICU Bed Details<hr></td>
				</tr>
				<tr>
					<td>Neonatal ICU bed</td>		
					<td><input type="text" id="qty1" placeholder="Quantity" name="qty1" onchange="show1();"/></td>
					<td><input type="text" id="eqty1" placeholder="Empty bed quantity" name="eqty1" readonly="" /></td>
					<td><input type="text" id="rate1" name="rate1" placeholder="Rate Per Day" readonly=""></td>
				</tr>
				<tr>
					<td>Pediatric ICU bed</td>
					<td><input type="text" id="qty2" placeholder="Quantity" name="qty2" onchange="show1();"/></td>
					<td><input type="text" id="eqty2" placeholder="Empty bed quantity" name="eqty2" readonly=""  /></td>
					<td><input type="text" id="rate2" name="rate2" placeholder="Rate Per Day" readonly="" ></td>
				</tr>
				<tr>
					<td>Neuro ICU bed</td>
					<td><input type="text" id="qty3" placeholder="Quantity" name="qty3" onchange="show1();"/></td>
					<td><input type="text" id="eqty3" placeholder="Empty bed quantity" name="eqty3" readonly="" /></td>
					<td><input type="text" id="rate3" name="rate3" placeholder="Rate Per Day" readonly=""></td>
				</tr>
				<tr>
					<td>Surgical ICU bed</td>
					<td><input type="text" id="qty4" placeholder="Quantity" name="qty4" onchange="show1();"/></td>
					<td><input type="text" id="eqty4" placeholder="Empty bed quantity" name="eqty4" readonly="" /></td>
					<td><input type="text" id="rate4" name="rate4" placeholder="Rate Per Day" readonly="" /></td>
				</tr>
				<tr>
					<td>Coronary ICU bed</td>
					<td><input type="text" id="qty5" placeholder="Quantity" name="qty5" onchange="show1();"/></td>
					<td><input type="text" id="eqty5" placeholder="Empty bed quantity" name="eqty5" readonly="" /></td>
					<td><input type="text" id="rate5" name="rate5" placeholder="Rate Per Day" readonly=""></td>
				</tr>
				<tr>
					<td>Psychiatric ICU bed</td>
					<td><input type="text" id="qty6" placeholder="Quantity" name="qty6" onchange="show1();"/></td>
					<td><input type="text" id="eqty6" placeholder="Empty bed quantity" name="eqty6" readonly="" /></td>
					<td><input type="text" id="rate6" name="rate6" placeholder="Rate Per Day" readonly=""></td>
				</tr>
				<tr>
					<td>Trauma ICU bed</td>
					<td><input type="text" id="qty7" placeholder="Quantity" name="qty7" onblur="show1();"/></td>
					<td><input type="text" id="eqty7" placeholder="Empty bed quantity" name="eqty7" readonly="" /></td>
					<td><input type="text" id="rate7" name="rate7" placeholder="Rate Per Day" readonly=""></td>
				</tr>
				<tr>
					<td colspan="4" id="btn_td">
						<input  id="btn" type="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	</div>
	</body>
</html>