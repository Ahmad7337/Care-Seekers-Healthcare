<?php

    include('db.php');

    $receiverID = $_SERVER['HTTP_RECEIVER'];
	$senderID = $_SERVER['HTTP_SENDER'];

	if(mysqli_num_rows(mysqli_query(db(),"SELECT * FROM convo where ((sender = '$senderID' AND receiver = '$receiverID') OR (sender = '$receiverID' AND receiver = '$senderID'))")) > 0){
		return false;
	}else{
		mysqli_query(db(), "INSERT INTO convo (sender, receiver) VALUES ('$senderID', '$receiverID')");
	}
?>