<?php

		include_once "db.php"; 
		session_start();
		
		$jobID = mysqli_real_escape_string(db(),$_POST['job_Wid']);
		$workerId = $_SESSION['authentication']['user'];

		mysqli_query(db(),"UPDATE jobsavail SET status = '-1' WHERE id = '$jobID'");
		mysqli_query(db(),"UPDATE users SET rating = rating - 7, jobsDone = jobsDone + 1 WHERE mail = '$workerId'");

?>