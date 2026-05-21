<?php 
	include_once "db.php";
	
	if(isset($_POST['applyBtn'])){
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}
		$applicantID = $_SESSION['authentication']['user'];
		$appliedFor = mysqli_real_escape_string(db(),$_POST['job_id']);
		
		$sql =  mysqli_query(db(),  "SELECT * FROM applications WHERE (appliedFor = '$appliedFor') AND (appliedBy = '$applicantID')");
		
		if(mysqli_num_rows($sql) > 0){
			echo "
				<script type=\"text/javascript\">
				window.location.href=\"login.php\";
				alert(\"ERROR: You've already applied for this job!\");
				</script>
			";
			exit();
		}else{
			$sql = mysqli_query(db(),  "INSERT INTO applications (appliedBy, appliedFor) 
										VALUES ('$applicantID', '$appliedFor')");
			echo '
				<script type="text/javascript">
				alert("Applied for the job successfully! Please await approval! Keep checking for any messages from the employer.");
				window.location.href="login.php";
				</script>
			';
			 exit();
		}
	}
?>