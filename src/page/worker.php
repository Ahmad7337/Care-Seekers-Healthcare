<?php 
include('../php/db.php');
include("../php/applyjob.php");
include("../php/authentication.php");


$jobsAvail = mysqli_query(db(),"SELECT * FROM jobsavail WHERE status='1'"); 
$jobswCurrent = mysqli_query(db(),"SELECT * FROM jobsavail WHERE (status='2' AND worker='{$_SESSION['authentication']['user']}')"); 
$workerProfileQuery = mysqli_query(db(),"SELECT * FROM workers WHERE mail='{$_SESSION['authentication']['user']}'");

$totaljobs = mysqli_num_rows($jobsAvail);
$resultProfile = mysqli_fetch_array(mysqli_query(db(),"SELECT * FROM users JOIN workers ON users.mail = workers.mail WHERE users.mail='{$_SESSION['authentication']['user']}'"));

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Support Worker</title>
		<script type="text/javascript" src="../script/script.js"> </script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<link rel="stylesheet" type="text/css" href="../style/tbStyle.css">
	</head>
	<body style="background-color: #A6B6FF;position:relative;">
		<div>
			<img src="../img/logo.png" alt="Logo" width="84" height="84" style="float: left; margin-left: 30px;">
			<p class="header">Care Seekers Healthcare</p> 	
		</div>

			<div class="container" style="width:200px;height:400px;float:left; position:fixed;left:50px;">
			<p class="text" id="admin" style="font-size: 24px;">Dashboard</p>
			<div class="buttons" style="position:relative;" onclick="profile();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="profBtn" class="btn" value="Profile"></div>
			<div class="buttons" style="position:relative;" onclick="postjob();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="postBtn"  class="btn" value="Apply for a Job"></div>
			<div class="buttons" style="position:relative;" onclick="msg();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="msgBtn"  class="btn" value="Messaging"></div>
			<div class="buttons" style="position:relative;" onclick="about();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="aboutBtn"  class="btn" value="About"></div>			
			<div class="buttons" style="position:relative;"><form method="POST"><input style="width:160px;padding:4px;font-size:18px;" type="submit" name="logoutBtn"class="btn" value="Log Out"></form></div>		
			</div>
		<div class="appContainer" style="display:none;" id="msgbox">
			<p class="text" id="chatboxTitle" style="font-size: 24px;">Care Seekers Messaging</p>
			<div id="convolist" class="convolist" style="overflow:auto;"></div>
			<div id="chatbox" style="display:none;"><img src="../img/back.png" width="32px" height="32px" class="chatImg" onclick="closechat();">
				<div id="chat" style="overflow:auto;"></div>
				<div id="msgform"><hr>
					<form method="post" id="chatform" onsubmit="return false;">
						<input type="hidden" name="convoID" value="" id="convoID">
						<input type="hidden" name="sender" value="" id="_sender">
						<input type="hidden" name="receiver" value="" id="_receiver">
						<input type="text" name="message" value="" placeholder="Enter message to send" id="msgfield">
						<input type="submit" name="_sendmsg" value="Send" id="msgsend" onclick="msgsendfunc();">
					</form>
				</div>
			</div>
		</div>
		<div class="appContainer" style="display:none;min-height:300px;" id="postjob">
			<p class="text" id="jobTitleHTMLW" style="font-size: 24px;font-weight:bold;">Apply for a Job</p>
			
			<div style="position: relative;top:25px;">
			<input type="button" value="View Current Jobs" id="postjobWBtn" class="jobfield" onclick="revealCurrentWJobs();" style="float:right;height:35px;width:130px;position:absolute;top:-75px;right:25px" >
				<div id="viewCurrentWJob" style="display:none;">
					<table class="tb" style="table-layout:fixed;max-width:950px;word-wrap: break-word;">
						<tr>
							<th class="tbHead" style="width:250px;" colspan=2>Job Information</th>					
							<th class="tbHead" style="width:250px;" colspan=2>Job Details</th>
							<th class="tbHead" colspan=1>Job Description</th>					
							<th class="tbHead" colspan=1>Additional Details</th>
							<th class="tbHead" style="width:100px;" colspan=1>Apply</th>
						</tr>
						<?php 
						if(mysqli_fetch_array($jobswCurrent) > 0){		
							foreach($jobswCurrent as $print){ 
								$posterName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail = '{$print['poster']}'")); 
								?>
								<tr>
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Title : </b>".$print['jobTitle']."<br><b>Job Type : </b>".$print['jobType']."<br><b>Posted By : </b>".$posterName['fname']." ".$posterName['sname']."<br><b>Posted On : </b>".$print['created']."<br>" ?></td>		
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Location : </b>".$print['location']."<br><b>Skills Required : </b>".$print['skills']."<br><b>Estimated Budget : </b>".$print['salary']."<br><b>Contact Phone : </b>".$print['contactPhone'] ?></td>		
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['description']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['requirements']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo '<form method="POST" id="leavejobf'.$print['id'].'"><input type="hidden" value="'.$print['id'].'" name="job_Wid"><input type="submit" name="leaveBtn" id="'.$print['id'].'" onclick="leaveJob(this.id);" class="btn" style="font-size:13px;padding:8px;background-color:#3299ff;margin:4px;:height:33px;width:80px;" value="Leave Job"><br></form>'; echo '<input type="button" name="'.$_SESSION['authentication']['user'].'" id="'.$print['poster'].'" class="btn" onclick="startConvo(this.name, this.id);" style="font-size:12px;padding:4px;background-color:#3299ff;margin:4px;:height:20px;width:80px;" value="Message">'; ?></td>
								</tr>
								<?php 
							}
						}else{ 
							?><tr><td class="tbRow" colspan="7" style="font-size:24px;">You have no ongoing jobs currently, try and apply for a new job!</td></tr>
							<?php 
						} 
						?>
					</table>
				</div>
				<div class="text" id="postedWJob" style="display:block;">
					<table class="tb" style="table-layout:fixed;max-width:950px;word-wrap: break-word;">
						<tr>
							<th class="tbHead" style="width:250px;" colspan=2>Job Information</th>					
							<th class="tbHead" style="width:250px;" colspan=2>Job Details</th>
							<th class="tbHead" colspan=1>Job Description</th>					
							<th class="tbHead" colspan=1>Additional Details</th>
							<th class="tbHead" style="width:100px;" colspan=1>Apply</th>
						</tr>
						<?php 
						if($totaljobs > 0){							
							foreach($jobsAvail as $print){ 
								$posterName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail = '{$print['poster']}'")); 
								?>
								<tr>
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Title : </b>".$print['jobTitle']."<br><b>Job Type : </b>".$print['jobType']."<br><b>Posted By : </b>".$posterName['fname']." ".$posterName['sname']."<br><b>Posted On : </b>".$print['created']."<br>" ?></td>		
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Location : </b>".$print['location']."<br><b>Skills Required : </b>".$print['skills']."<br><b>Estimated Budget : </b>".$print['salary']."<br><b>Contact Phone : </b>".$print['contactPhone'] ?></td>		
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['description']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['requirements']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><form method="POST"><?php echo '<input type="hidden" value="'.$print['id'].'" name="job_id">';		if(mysqli_num_rows(mysqli_query(db(),  "SELECT * FROM applications WHERE (appliedFor = '{$print['id']}') AND (appliedBy = '{$_SESSION['authentication']['user']}')")) > 0){ echo '<input type="button" name="applied" class="btn" style="font-size:18px;padding:8px;color:white;background-color:green;margin:4px;:height:33px;width:80px;" value="Applied!">';}else{ echo '<input type="submit" name="applyBtn" class="btn" style="font-size:18px;padding:8px;background-color:#3299ff;margin:4px;:height:33px;width:80px;" value="Apply">';} echo '<input type="button" name="'.$_SESSION['authentication']['user'].'" id="'.$print['poster'].'" class="btn" onclick="startConvo(this.name, this.id);" style="font-size:12px;padding:4px;background-color:#3299ff;margin:4px;:height:20px;width:80px;" value="Message">';?><br></form></td>
								</tr>
								<?php 
							}
						}else{ 
							?><tr><td class="tbRow" colspan="7" style="font-size:24px;">There are no jobs currently available...come back later!</td></tr>
							<?php 
						} 
						?>
					</table>
				</div>
			</div>
		</div>
			
			<div class="appContainer" style="display:none;" id="about">
				<p class="text" id="admin" style="font-size: 24px;">Care Seekers Healthcare</p>
				<p class="text" style="font-size: 17px;">This web app is designed to connect individuals seeking caregiving services with qualified support workers. People in need of such services can register, post caregiving jobs, and apply for jobs in categories like babysitting, cooking, and personal care. App's security and administration ensures safe and reliable connections. It simplifies the process of finding care or providing caregiving services in a user-friendly way.</p>
				<p class="text" style="font-size: 18px;font-weight:bold;color:blue;" ><a class="btn" href="https://bc190405120s-ultra-awesome-resume.webflow.io/">MY WEBFLOW RESUME</A><P>
				<img src="../img/about.png">
			</div>
			<div class="appContainer" style="display:none;" id="msgbox">
				<p class="text" id="chatboxTitle" style="font-size: 24px;">Care Seekers Messaging</p>
				<div id="convolist" class="convolist" style="overflow:auto;">

				</div>
				<div id="chatbox" style="display:none;"><img src="../img/back.png" width="32px" height="32px" class="chatImg" onclick="closechat();">
					<div id="chat" style="overflow:auto;">
						
					</div>
					<div id="msgform"><hr>
						<form method="post" id="chatform" onsubmit="return false;">
							<input type="hidden" name="convoID" value="" id="convoID">
							<input type="hidden" name="sender" value="" id="_sender">
							<input type="hidden" name="receiver" value="" id="_receiver">
							<input type="text" name="message" value="" placeholder="Enter message to send" id="msgfield">
							<input type="submit" name="_sendmsg" value="Send" id="msgsend" onclick="msgsendfunc();">
						</form>
					</div>
				</div>
			</div>

		<div class="appContainer" style="display:none;" id="profile">
			<p class="text" id="admin" style="font-size: 24px;font-weight:bold;"><?php echo $resultProfile['fname']." ".$resultProfile['sname']; ?>'s Profile</p>
			<div class="text" style="font-size: 17px;display:flex;flex-direction:row;position:relative;top:-50px;">
				<div class="profCol1"> 
					<p><b>First Name : </b><?php echo $resultProfile['fname']; ?></p><br>
					<p><b>Second Name : </b><?php echo $resultProfile['sname']; ?></p><br> 
					<p><b>Email : </b><?php echo $resultProfile['mail']; ?></p><br> 
					<p><b>Phone : </b><?php echo $resultProfile['phone']; ?></p><br>
					<p><b>Role : </b><?php if($resultProfile['role'] == "seeker"){echo "Care Seeker";}elseif($resultProfile['role'] == "worker"){echo "Support Worker";} ?></p><br>
					<p><b>Qualification : </b><?php echo $resultProfile['qualify']; ?></p><br>
					<p><b>Experience : </b><?php echo $resultProfile['xp']; ?></p><br>
					<p><b>Rating : </b><?php if($resultProfile['jobsDone'] > 0) {echo $rating = $resultProfile['rating'] / $resultProfile['jobsDone'];}else{ echo "10";} ?></p><br>
					<p><b>Hourly Rate : </b><?php echo $resultProfile['rate']; ?></p><br> 
				</div>
				<div class="profCol2"> 
					<p><?php echo '<img src="../uploads/'.$resultProfile['pic'] .'" width="338px" height="338px">' ?> </p><br>
					<p><b>Bio : </b><?php echo $resultProfile['bio']; ?></p><br> 
				</div>
			</div>
		</div>
		<footer style="text-align: center;position: fixed;bottom: 0px; z-index:-1;width:100%;">
			<img src="../img/quote.png" alt="Logo" id="quote">
		</footer>
	</body>
</html>
