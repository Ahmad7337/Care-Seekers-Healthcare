<?php
	include('../php/registerAct.php');
	if(	isset($_POST['registerBtn'])){
		registerUser();
	}
?>
<script type="text/javascript"> 
	function reveal(value){
		if(value == "worker"){
			document.getElementById("worker").style.display = "block";
			document.getElementById("seeker").style.display = "none";
		}else if(value == "seeker"){
			document.getElementById("seeker").style.display = "block";
			document.getElementById("worker").style.display = "none";
		}
	}
	function validate(){
		let pass = document.getElementById("pass").value;
		let cnPass = document.getElementById("cnPass").value;
		let mobile = document.getElementById("mobile").value;
		let issues = "";
		if(pass != cnPass) issues += "Password confirmation failed! Make sure the passwords entered are same!\n";
		if(isNaN(mobile)) issues += "Invalid number! Make sure the phone number entered is numeric!\n";
		if(issues != ""){
			alert("ERROR :\n"+issues);
			return false;
		}else{
			return true;
		}
	}
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body style="background-color: #A6B6FF;">
	<img src="../img/logo.png" alt="Logo" width="84" height="84" style="float: left; margin-left: 30px;">
	<div>
		<p class="header">Care Seekers Web App</p>  
		<div class="container" style="width:600px;margin-bottom:120px;">
			<a href="../../index.php" class="backBtn"> << </a>
			<p class="text" style="font-size: 32px;">Register now</p>
		
			<form method="POST" enctype="multipart/form-data" onsubmit="return validate();">
				<div style="text-align:left;" >
					<label>First Name:</label>
					<input type="text" id="firstName" name="fname" required> 
					
					<label style="margin-left:30px;">Picture:</label>
					<input type="file" name="pic" accept="image/*" required><br><br>
					
					<label>Last Name:</label>
					<input type="text" id="sname" name="sname" required>
					
					<label style="margin-left:30px;">Mobile No:</label>
					<input type="text" id="mobile" name="mobile" required><br><br>
					
					<label>Password:</label>
					<input type="password" id="pass" name="pass" style="margin-left:8px;" required>
					
					<label style="margin-left:30px;">Email:</label>
					<input type="email" id="email" name="email" style="margin-left:32px;" required><br><br>
					
					<label>Confirm:</label>
					<input type="password" id="cnPass" name="cnPass" style="margin-left:15px;" required><br><br>
					
					<label>Your role :</label>
					<select style="margin-left:6px;" id="role" name="role" onchange="reveal(this.value);">
						<option value=""></option>
						<option value="seeker">Care Seeker</option>
						<option value="worker">Support Worker</option>
					</select><br><br>
					
					<div id="worker" style="display:none;">
						
						<label>Qualification :</label>
						<select id="qualify" name="qualify">
							<option value="Student">Student</option>
							<option value="Intermediate">Intermediate</option>
							<option value="Bachelor">Bachelor</option>
							<option value="Master">Master</option>
						</select><br><br>
						
						<label>Experience:</label>
						<select id="experience" name="xp" style="margin-left:17px;" >
							<option value="1-6 months">1-6 months</option>
							<option value="6-12 months">6-12 months</option>
							<option value="1-2 years">1-2 years</option>
							<option value="2+ years"></option>
						</select><br><br>
						
						<label>Hourly Rate:</label>
						<select id="hourlyRate" name="rate" style="margin-left:10px;" >
							<option value="$5.00">$5.00</option>
							<option value="$7.50">$7.50</option>
							<option value="$10.00">$10.00</option>
							<option value="$12.50">$12.50</option>
							<option value="$15.00">$15.00</option>
							<option value="$17.50">$17.50</option>
							<option value="$20.00">$20.00</option>
							<option value="$22.50">$22.50</option>
							<option value="$25.00">$25.00</option>
						</select><br><br>
						
						<label> Bio:</label>
						<textarea   style="margin-left:65px;" id="bio" name="bio"></textarea><br><br>
						
					</div>
					<div id="seeker" style="display:none;">
						Address : <textarea style="margin-left:25px;" name="address"></textarea><br><br>
						Bio : <textarea style="margin-left:55px;" name="_bio"></textarea>
					</div>
					<div class="buttons" style="text-align:center;"><input type="submit" name="registerBtn" class="btn" value="Register"></div>
				</div>
			</form>
		</div>
    <footer style="text-align: center;">
		<img src="../img/quote.png" alt="Logo">
    </footer>
</body>
</html>
