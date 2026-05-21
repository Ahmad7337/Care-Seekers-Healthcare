<?php
	if(isset($_POST['acceptJobBtn'])){
		session_start();
		include_once "db.php";
		include "mailer.php";
		
		$applicantMail = mysqli_real_escape_string(db(),$_POST['applicantMail']);
		$JobID = mysqli_real_escape_string(db(),$_POST['JobID']);
		
		mysqli_query(db(),"UPDATE applications SET status = '1' WHERE (appliedFor = '$JobID' AND appliedBy = '$applicantMail')");
		mysqli_query(db(),"UPDATE applications SET status = '-1' WHERE (appliedFor = '$JobID' AND appliedBy <> '$applicantMail')");
		mysqli_query(db(),"UPDATE jobsavail SET status = '2', worker = '$applicantMail' WHERE id = '$JobID'");
		$sql = mysqli_fetch_assoc(mysqli_query(db(),"SELECT * FROM users WHERE mail = '$applicantMail'"));
		sendMail($sql['fname'],$sql['sname'], $applicantMail, 0,"JobAC");
		echo '<script type="text/javascript"> alert("Application successfully accepted!"); window.location.href="login.php"; </script>';
	}
	if(isset($_POST['rejectJobBtn'])){
		session_start();
		include_once "db.php";
		
		$applicantMail = mysqli_real_escape_string(db(),$_POST['applicantMail']);
		$JobID = mysqli_real_escape_string(db(),$_POST['JobID']);
		
		$sql = mysqli_query(db(),"UPDATE applications SET status = '-1' WHERE (appliedFor = '$JobID' AND appliedBy = '$applicantMail')");	
		$sql = mysqli_fetch_assoc(mysqli_query(db(),"SELECT * FROM users WHERE mail = '$applicantMail'"));
		sendMail($sql['fname'],$sql['sname'], $applicantMail, 0,"JobRJ");
		echo '<script type="text/javascript"> alert("Application rejected!"); window.location.href="login.php"; </script>';
	}
?>