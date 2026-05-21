<?php
include ('db.php');
include ('mailer.php');

$workAPP = mysqli_query(db(),"SELECT * FROM users JOIN workers ON users.mail = workers.mail WHERE status='1'"); 
$seekAPP = mysqli_query(db(),"SELECT * FROM users JOIN seekers ON users.mail = seekers.mail WHERE status='1'"); 
/*$application = mysqli_query(db(),"SELECT * FROM users JOIN seekers ON users.mail = seekers.mail WHERE users.status = '1'
									UNION ALL
								  SELECT * FROM users JOIN workers ON users.mail = workers.mail WHERE users.status = '1'"
								); */

$appNum = mysqli_num_rows($workAPP) + mysqli_num_rows($seekAPP);

if(	isset($_POST['acceptBtn'])){
	$mail = mysqli_real_escape_string(db(),$_POST['email']);
	mysqli_query(db(),"UPDATE users SET status='2' WHERE mail='$mail'");
	$result = mysqli_fetch_array(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail='$mail'"));
	sendMail($result['fname'],$result['sname'],$mail,"none","acp");
	echo '
		<script type="text/javascript">
		window.location.href="admin.php";
		alert("User successfully approved!");
		</script>
	';
}
if(	isset($_POST['rejectBtn'])){
	$mail = mysqli_real_escape_string(db(),$_POST['email']);
	$result = mysqli_fetch_array(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail='$mail'"));
	sendMail($result['fname'],$result['sname'],$mail,"none","rjt");
	mysqli_query(db(),"DELETE FROM workers WHERE mail='$mail'");
	mysqli_query(db(),"DELETE FROM users WHERE mail='$mail'");
	echo '
		<script type="text/javascript">
		window.location.href="admin.php";
		alert("User successfully rejected!");
		</script>
	';
}
?>