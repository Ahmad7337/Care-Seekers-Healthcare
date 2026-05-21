<?php include("src/php/authentication.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="src/style/style.css">
</head>
<body style="background-color: #A6B6FF;">
	<img src="src/img/logo.png" alt="Logo" width="84" height="84" style="float: left; margin-left: 30px;">
		<p class="header">Care Seekers Web App</p>    
	<div class="container" style="width:600px;">
		<p class="text" style="font-size: 32px;">Welcome!</p>
		How would you like to proceed? <br><br>
		<div class="buttons">
				<a href="src/page/login.php" class="btn">Login</a>
				<a href="src/page/register.php" class="btn">Register</a>
		</div>
		<br>
    </div>
	
    <footer style="text-align: center;">
		<img src="src/img/quote.png" alt="Logo">
    </footer>
</body>
</html>
