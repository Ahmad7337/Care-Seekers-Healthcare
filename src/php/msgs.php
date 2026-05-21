<?php
		session_start();
		include_once "db.php";
		//$sender = mysqli_real_escape_string(db(),$_POST['sender']);
		//$receiver = mysqli_real_escape_string(db(),$_POST['receiver']);
		$convoID = mysqli_real_escape_string(db(),$_GET['convoID']);
		
		$output = '';
		$sql = mysqli_query(db(),"SELECT * FROM messages WHERE convoID = '$convoID' ORDER BY msgID  ASC");
		
		if(mysqli_num_rows($sql) > 0){
			while($row = mysqli_fetch_assoc($sql)){
				if($row['msgSender'] === $_SESSION['authentication']['user']){
					$output .= '<div class="outgoingM"><span>'.$row['msg'].'</span><br><label>'.$row['datetime'].'</label></div>';
				}else{
					$output .= '<div class="incomingM"><span>'.$row['msg'].'</span><br><label>'.$row['datetime'].'</label></div>';
				}
			}
		}
	echo $output;
?>