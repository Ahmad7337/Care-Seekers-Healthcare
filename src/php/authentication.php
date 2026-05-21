<?php
session_start();

if(!isset($_SESSION['authentication']['isAuth'])){
	if($_SERVER['PHP_SELF'] != "/webapp/src/page/login.php" && $_SERVER['PHP_SELF'] != "/webapp/index.php"){
		echo '
			<script type="text/javascript">
			window.location.href="login.php";
			alert("Please log in to continue.");
			</script>
		';
		session_destroy();
		exit();
	}
}else if(isset($_SESSION['authentication']['isAuth'])){
	if($_SERVER['PHP_SELF'] != "/webapp/src/page/".$_SESSION['authentication']['role'].".php"){
		if($_SERVER['PHP_SELF'] == "/webapp/index.php"){
			header("location:./src/page/".$_SESSION['authentication']['role'].".php");
		}else{
			header("location:./".$_SESSION['authentication']['role'].".php");
		}
	exit();
	}
}

if(	isset($_POST['logoutBtn'])){
	unset($_SESSION['authentication']);
	header("location:../page/login.php");
	session_destroy();
	exit();
}

?>