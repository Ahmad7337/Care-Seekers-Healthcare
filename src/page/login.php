<?php
	include("../php/authentication.php");
	include('../php/loginAct.php');
	if(	isset($_POST['loginBtn'])){
		loginUser();
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body style="background-color: #A6B6FF;">
	<img src="../img/logo.png" alt="Logo" width="84" height="84" style="float: left; margin-left: 30px;">
		<p class="header">Care Seekers Web App</p>    
	<div class="container" style="width:600px;">
		<a href="../../index.php" class="backBtn"> << </a>
		<p class="text" style="font-size: 32px;">Welcome!</p>
		<form method="POST">
		<div style="text-align:center;" >
			<label>Email : </label> <input type="email" id="email" name="email" style="margin-left:20px;" required><br><br>
			<labels>Password : </label><input type="password" id="password" name="pass" required>
			
			<div class="buttons" style="text-align:center;"><input type="submit" name="loginBtn"class="btn" value="Login"></div>
		</div>
		</form>
    </div>
	
    <footer>
		<img src="../img/quote.png">
    </footer>
</body>
</html>
