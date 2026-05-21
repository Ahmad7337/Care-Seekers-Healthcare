<?php
include('db.php');

function loginUser(){	
	$mail = mysqli_real_escape_string(db(),$_POST['email']);
	$pass = mysqli_real_escape_string(db(),$_POST['pass']);
	
	$loginQuery = mysqli_query(db(),"SELECT * FROM users WHERE mail='$mail' AND pass='$pass'");
	
	if(mysqli_num_rows($loginQuery) > 0){
		$result = mysqli_fetch_array($loginQuery);
		if($result['status'] === "0"){
			echo '
            <script type="text/javascript">
			window.location.href="login.php";
            alert("Your email is currently unverified.Please check your inbox for verification email.");
            </script>
			';
			exit();
		}else if($result['status'] === "1"){
			echo '
            <script type="text/javascript">
			window.location.href="login.php";
            alert("Your account is currently unapproved. Please wait a period of 1-3 days for account approval.");
            </script>
			';
			exit();
		}else{
			session_start();
			$_SESSION['authentication']['isAuth'] = true;
			$_SESSION['authentication']['user'] = $result['mail'];
			$_SESSION['authentication']['role'] = $result['role'];
			header("location:./".$_SESSION['authentication']['role'].".php");
			exit();
		}
	}else{
		echo '
            <script type="text/javascript">
			window.location.href="login.php";
            alert("ERROR: Login Failed : Incorrect email or password");
            </script>
        ';
		exit();
	}
}

?>