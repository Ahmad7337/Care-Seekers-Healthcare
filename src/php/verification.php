<?php
include('db.php');


if(isset($_GET['token'])){
	$token = $_GET['token'];
	$executeVerification = mysqli_query(db(),"SELECT mail,token,status FROM users WHERE token='$token' LIMIT 1");
	
	if(mysqli_num_rows($executeVerification) > 0){
		$result = mysqli_fetch_array($executeVerification);
		if($result['status'] === "0"){
			$mail = mysqli_real_escape_string(db(),$result['mail']);
			mysqli_query(db(),"UPDATE users SET status='1' WHERE token='$token' LIMIT 1");
			
			$header = '<h3><b>Email Verified</b></h3>';
			$body = 'Your user email has been verified. <br>Please wait for your account approval by admin.<br>You will receive email when your account is approved.';
		}else if($result['status'] === "1"){
			$header = '<h3><b>Already Verified</b></h3>';
			$body = 'This user account is already verified.<br>You will receive email when your account is approved.';
		}else{
			$header = '<h3><b>Already approved</b></h3>';
			$body = 'This user account is already verified and approved by admin!<br>You will receive email when your account is approved.';
		}
	}else{
		$header = '<h3><b style="color:red;">ERROR: Unknown user!</b></h3>';
		$body = 'The user mail you are attempting to verify is unknown!';
	}
}else{
	$header = '<h3><b style="color:red;">ERROR: Illegal operation!</b></h3>';
	$body = 'The operation you are attempting to perform is not allowed!';
}
echo '
	<!DOCTYPE html>
	<html><head><style>
			body {font-family: Arial, sans-serif;margin: 0;padding: 0;}
			.container {width: 100%;max-width: 600px;margin: 0 auto;padding: 20px;text-align: center;}
			.header {background-color: #3498db;color: #ffffff;padding: 20px;}
			.content {padding: 30px;}
			.button {display: inline-block;background-color: #3498db;color: #ffffff;padding: 15px 30px;text-decoration: none;border-radius: 5px;font-weight: bold;}
			.button:hover {background-color: #2980b9;}
			@media screen and (max-width: 600px) {.container {width: 100%;} .button {display: block;margin: 10px auto;}}
		</style></head>
		<body><div class="container"><div class="header"><h1>Care Seekers Healthcare<sup>TM</sup></h1></div>
				<div class="content">'.$header.'<br><br>
					'.$body.'
					<br><br><i>You will be redirected to Care Seekers Heathcare in 10 seconds...</i><br>
					<br><hr><p>Thank you for choosing our service!</p><sub>Project by MUHAMMAD AHMAD | bc190405120</sub>
				</div>
			</div>
		</body>
	</html>
';
header( "refresh:10;url=../../index.php" );
exit();
?>