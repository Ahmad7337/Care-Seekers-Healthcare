<?php
    session_start();
    include('db.php');
    $currentUser = $_SESSION['authentication']['user'];
    $getConvo = mysqli_query(db(), "SELECT * FROM convo WHERE receiver = '$currentUser' OR sender = '$currentUser' ORDER BY created DESC");
    $output = "";
    if(mysqli_num_rows($getConvo) == 0){
        $output .= "<br><i style='font-size:20px;'><b>No users are available to chat</b></i>";
    }else if(mysqli_num_rows($getConvo) > 0){
		$row = mysqli_fetch_assoc($getConvo);
		foreach($getConvo as $values) {
			$convoQ = mysqli_query(db(), "SELECT * FROM users WHERE (mail = '{$values['sender']}' OR mail = '{$values['receiver']}') AND mail != '$currentUser'");
			$convo = mysqli_fetch_assoc($convoQ);
			if($currentUser != $values['receiver']){
				if($convo['role'] == "seeker"){$role = "Care Seeker";}elseif($convo['role'] == "worker"){$role = "Support Worker";}else{$role = "<b style='color:green'>Admin</b>";}
				$output .= '
				<div class="convobox" onclick="togglechat('.$values['convoID'].');"><img src="../uploads/'.$convo['pic'].'" width="112px" height="112px">
					<input type="hidden" id="convoSender'.$values['convoID'].'" value="'.$currentUser.'">
					<input type="hidden" id="convoReceiver'.$values['convoID'].'" value="'.$values['receiver'].'">
					<span class="convoN"><b id="_CONVOname'.$values['convoID'].'">'.$convo['fname']." ".$convo['sname'].'</b></span><br>
					<span class="convoD"> Date created : '.$values['created'].'</span><br>
					<span class="convoR">'.$role.'</span>
				</div>
			';
			}else if($currentUser != $values['sender']){
				if($convo['role'] == "seeker"){$role = "Care Seeker";}else if($convo['role'] == "worker"){$role = "Support Worker";}else{$role = "<b style='color:green'>Admin</b>";}
				$output .= '
				<div class="convobox" onclick="togglechat('.$values['convoID'].');"><img src="../uploads/'.$convo['pic'].'" width="112px" height="112px">
					<input type="hidden" id="convoSender'.$values['convoID'].'" value="'.$currentUser.'">
					<input type="hidden" id="convoReceiver'.$values['convoID'].'" value="'.$values['sender'].'">
					<span class="convoN"><b id="_CONVOname'.$values['convoID'].'">'.$convo['fname']." ".$convo['sname'].'</b></span><br>
					<span class="convoD">Date created : '.$values['created'].'</span><br>
					<span class="convoR">'.$role.'</span>
				</div>
			';
			}
		} 
   }
   echo $output;
?>