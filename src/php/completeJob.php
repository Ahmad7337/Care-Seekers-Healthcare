<?php
		include_once "db.php"; 
		$jobID = mysqli_real_escape_string(db(),$_POST['compjobId']);
		$workerId = mysqli_real_escape_string(db(),$_POST['workerId']);
		$rating = mysqli_real_escape_string(db(),$_POST['rating']);

		mysqli_query(db(),"UPDATE jobsavail SET status = '-1' WHERE id = '$jobID'");
		mysqli_query(db(),"UPDATE users SET rating = rating +'$rating', jobsDone = jobsDone + 1 WHERE mail = '$workerId'");
	
?>