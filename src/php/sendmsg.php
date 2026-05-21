<?php 
	if(isset($_POST['message'])){
		include_once "db.php";
		$sender = mysqli_real_escape_string(db(),$_POST['sender']);
		$receiver = mysqli_real_escape_string(db(),$_POST['receiver']);
		$convoID = mysqli_real_escape_string(db(),$_POST['convoID']);
		$message = mysqli_real_escape_string(db(),$_POST['message']);
		if(!empty($message)){
			$sql = mysqli_query(db(),"INSERT INTO messages (convoID, msgSender, msgReceiver, msg) VALUES ('$convoID', '$sender' ,'$receiver' ,'$message')");
		}
	}
?>