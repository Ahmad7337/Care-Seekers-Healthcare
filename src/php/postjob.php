<?php 
	if(isset($_POST['postjob'])){
		include_once "db.php";
		$jobTitle = mysqli_real_escape_string(db(),$_POST['jobTitle']);
		$location = mysqli_real_escape_string(db(),$_POST['location']);
		$skills = mysqli_real_escape_string(db(),$_POST['skills']);
		$salary = mysqli_real_escape_string(db(),$_POST['salary']);
		$jobType = mysqli_real_escape_string(db(),$_POST['jobType']);
		$contactPhone = mysqli_real_escape_string(db(),$_POST['contactPhone']);
		$description = mysqli_real_escape_string(db(),$_POST['description']);
		$requirements = mysqli_real_escape_string(db(),$_POST['requirements']);
		$poster = $_SESSION['authentication']['user'];
		
		$sql = mysqli_query(db(),  "INSERT INTO jobsAvail (jobTitle, location, skills, salary, jobType, contactPhone, description, requirements, poster) 
									VALUES ('$jobTitle', '$location' ,'$skills' ,'$salary' ,'$jobType' ,'$contactPhone' ,'$description' ,'$requirements' ,'$poster')");
		echo '
			<script type="text/javascript">
			alert("Success! Your job has been posted successfully and is now visible to all Support Workers!");
			window.location.href="login.php";
			</script>
		';
		 //header( "Location: {$_SERVER['REQUEST_URI']}", true, 303 );
		 exit();
	}
?>