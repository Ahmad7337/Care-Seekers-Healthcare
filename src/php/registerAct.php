<?php
include('db.php');
include('mailer.php');

function registerUser(){	

	$fname =  mysqli_real_escape_string(db(),$_POST['fname']);
	$sname = mysqli_real_escape_string(db(),$_POST['sname']);
	$phone = mysqli_real_escape_string(db(),$_POST['mobile']);
	$mail = mysqli_real_escape_string(db(),$_POST['email']);
	$pass = mysqli_real_escape_string(db(),$_POST['pass']);
	$cnPass = mysqli_real_escape_string(db(),$_POST['cnPass']);
	$role = mysqli_real_escape_string(db(),$_POST['role']);
	$token = md5(rand());
	
	$pic = $_FILES["pic"]["name"];
	$tmpname = $_FILES["pic"]["tmp_name"];
	$folder = "../uploads/" . $pic;
	$body = "reg";	
	move_uploaded_file($tmpname, $folder);
	
	$insertUsersQ = "INSERT INTO users (mail, fname, sname, phone, pass, role, pic, token) 
				VALUES ('$mail', '$fname', '$sname', '$phone', '$pass', '$role','$pic','$token')";	
	$mailCheckQ = "SELECT mail FROM users WHERE mail='$mail' LIMIT 1";
	
	$query_mailCheck = mysqli_query(db(), $mailCheckQ);
	
	if(mysqli_num_rows($query_mailCheck) > 0){
		echo "
			<script type=\"text/javascript\">
			window.location.href=\"login.php\";
			alert(\"ERROR: Registration Failed : The entered email already exists!\");
			</script>
		";
		exit();
	}else{
		if($role == "worker"){
			mysqli_query(db(), $insertUsersQ);
			registerWorker();
			sendMail($fname,$sname,$mail,$token,$body);
			echo "
			<script type=\"text/javascript\">
			window.location.href=\"login.php\";
			alert(\" Registered as Support Worker successfully! Check your inbox for account activation email.\");
			</script>
			";
			exit();
		}else{
			mysqli_query(db(), $insertUsersQ);
			registerSeeker();
			sendMail($fname,$sname,$mail,$token,$body);
			echo "
			<script type=\"text/javascript\">
			window.location.href=\"login.php\";
			alert(\" Registered as Care Seeker successfully! Check your inbox for account activation email.\");
			</script>
			";
			exit();
		}
	}

}
function registerWorker(){
	
	$mail = mysqli_real_escape_string(db(),$_POST['email']);
	$bio = mysqli_real_escape_string(db(),$_POST['bio']);
	$qualify = mysqli_real_escape_string(db(),$_POST['qualify']);
	$xp = mysqli_real_escape_string(db(),$_POST['xp']);
	$rate = mysqli_real_escape_string(db(),$_POST['rate']);
	
	mysqli_query(db(), 
				"INSERT INTO workers (mail, bio, qualify, xp, rate) 
				VALUES ('$mail', '$bio', '$qualify', '$xp', '$rate')"
	);
}

function registerSeeker(){
	
	$mail = mysqli_real_escape_string(db(),$_POST['email']);
	$_bio = mysqli_real_escape_string(db(),$_POST['_bio']);
	$address = mysqli_real_escape_string(db(),$_POST['address']);
	
	mysqli_query(db(), 
				"INSERT INTO seekers (mail, _bio, address) 
				VALUES ('$mail', '$_bio', '$address')"
	);
}

?>