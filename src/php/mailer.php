<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


function sendMail($fname,$sname, $email, $token,$body){
	$mail = new PHPMailer(true);

	try {
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'careseeker@caremail.com';                     //SMTP username
		$mail->Password   = 'carepassword';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		$mail->setFrom('careseeker@caremail.com', 'Care Seekers Healthcare');
		$mail->addAddress($email);     
		
		$mail->isHTML(true);                                  //Set email format to HTML
		if($body == "reg"){
			$mail->Subject = 'Email Verification from Care Seekers!';
			$mail->Body    = '
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
							<div class="content"><p>Dear '.$fname.' '.$sname.',</p>
								<p>Thank you for registering with our service. To complete the registration process, please click the button below to verify your email address:</p>
								<a class="button" href="http://localhost/webapp/src/php/verification.php?token='.$token.'">Verify Email</a>
								<br><p>Thank you for choosing our service!</p><hr><sub>Project by MUHAMMAD AHMAD | bc190405120</sub>
							</div>
						</div>
					</body>
				</html>
			';
		}else if($body == "acp"){
			$mail->Subject = 'Care Seekers Healtcare Account Approval';
			$mail->Body    = '
				<!DOCTYPE html>
				<html><head><style>
						body {font-family: Arial, sans-serif;margin: 0;padding: 0;}
						.container {width: 100%;max-width: 600px;margin: 0 auto;padding: 20px;text-align: center;}
						.header {background-color: #3498db;color: #ffffff;padding: 20px;}
						.content {padding: 30px;}
						.button {display: inline-block;background-color: #3498db;color: #ffffff;padding: 15px 30px;text-decoration: none;border-radius: 5px;font-weight: bold;}
						.button:hover {background-color: #2980b9;}
					</style></head>
					<body><div class="container"><div class="header"><h1>Care Seekers Healthcare<sup>TM</sup></h1></div>
							<div class="content"><p>Dear '.$fname.' '.$sname.',</p>
								<p>Congratulations, your account has been approved by the admin of Care Seekers Healthcare.</p>
								<p>You can log in now through the button below!.</p>
								<a class="button" href="http://localhost/webapp/src/page/login.php">Log in now</a>
								<br><p>Thank you for choosing our service!</p><hr><sub>Project by MUHAMMAD AHMAD | bc190405120</sub>
							</div>
						</div>
					</body>
				</html>
			';
		}
		else if($body == "rjt"){
			$mail->Subject = 'Care Seekers Healtcare Account Approval';
			$mail->Body    = '
				<!DOCTYPE html>
				<html><head><style>
						body {font-family: Arial, sans-serif;margin: 0;padding: 0;}
						.container {width: 100%;max-width: 600px;margin: 0 auto;padding: 20px;text-align: center;}
						.header {background-color: #3498db;color: #ffffff;padding: 20px;}
						.content {padding: 30px;}
					</style></head>
					<body><div class="container"><div class="header"><h1>Care Seekers Healthcare<sup>TM</sup></h1></div>
							<div class="content"><p>Dear '.$fname.' '.$sname.',</p>
								<p>Unfortunately, your account was not approved by the admin of Care Seekers Healthcare.</p>
								<p>You can try again after a period of 14 to 21 days.</p><br>
								<p>Thank you for choosing our service!</p><hr><sub>Project by MUHAMMAD AHMAD | bc190405120</sub>
							</div>
						</div>
					</body>
				</html>
			';
		}else if($body == "JobAC"){
			$mail->Subject = 'Care Seekers Healtcare Job Status';
			$mail->Body    = '
				<!DOCTYPE html>
				<html><head><style>
						body {font-family: Arial, sans-serif;margin: 0;padding: 0;}
						.container {width: 100%;max-width: 600px;margin: 0 auto;padding: 20px;text-align: center;}
						.header {background-color: #3498db;color: #ffffff;padding: 20px;}
						.content {padding: 30px;}
					</style></head>
					<body><div class="container"><div class="header"><h1>Care Seekers Healthcare<sup>TM</sup></h1></div>
							<div class="content"><p>Dear '.$fname.' '.$sname.',</p>
								<p>The Job you\'ve applied on was successfully accepted by the concerned Care Seeker!</p><br>
								<p>Thank you for choosing our service!</p><hr><sub>Project by MUHAMMAD AHMAD | bc190405120</sub>
							</div>
						</div>
					</body>
				</html>
			';
		}else if($body == "JobRJ"){
			$mail->Subject = 'Care Seekers Healtcare Job Status';
			$mail->Body    = '
				<!DOCTYPE html>
				<html><head><style>
						body {font-family: Arial, sans-serif;margin: 0;padding: 0;}
						.container {width: 100%;max-width: 600px;margin: 0 auto;padding: 20px;text-align: center;}
						.header {background-color: #3498db;color: #ffffff;padding: 20px;}
						.content {padding: 30px;}
					</style></head>
					<body><div class="container"><div class="header"><h1>Care Seekers Healthcare<sup>TM</sup></h1></div>
							<div class="content"><p>Dear '.$fname.' '.$sname.',</p>
								<p>Unfortunately, your application for job was not approved by the concerned Care Seeker.</p>
								<p>You can try again after a period of 14 to 21 days.</p><br>
								<p>Thank you for choosing our service!</p><hr><sub>Project by MUHAMMAD AHMAD | bc190405120</sub>
							</div>
						</div>
					</body>
				</html>
			';
		}
		
		$mail->send();	
		
	} catch (Exception $e) {
		echo "
		<script type=\"text/javascript\">
		alert(\" Message could not be sent. Mailer Error: {$mail->ErrorInfo}\");
		</script>
		";
	}
}
?>