<?php 
include('../php/db.php');
include("../php/authentication.php");
include("../php/postjob.php");
include("../php/acceptApplication.php");

$seekerProfileQuery = mysqli_query(db(),"SELECT * FROM seekers WHERE mail='{$_SESSION['authentication']['user']}'");
$jobsAvail = mysqli_query(db(),"SELECT * FROM jobsavail WHERE status='1'"); 
$jobsbyuser = mysqli_query(db(),"SELECT * FROM jobsavail WHERE poster = '{$_SESSION['authentication']['user']}'"); 
$currentbyuser = mysqli_query(db(),"SELECT * FROM jobsavail WHERE (poster = '{$_SESSION['authentication']['user']}' AND status = '2')"); 
$postedJobs = mysqli_query(db(),"SELECT * FROM applications WHERE status='1'"); 

$totaljobsbyuser = mysqli_num_rows($jobsbyuser);
$totaljobs = mysqli_num_rows($jobsAvail);
$currentbyuserNum = mysqli_num_rows($currentbyuser);

$resultProfile = mysqli_fetch_array(mysqli_query(db(),"SELECT * FROM users JOIN seekers ON users.mail = seekers.mail WHERE users.mail='{$_SESSION['authentication']['user']}'"));

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Care Seeker</title>
		<link rel="icon" type="image/x-icon" href="../img/logo.png">
		<script type="text/javascript" src="../script/script.js"> </script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../style/style.css">
		<link rel="stylesheet" type="text/css" href="../style/tbStyle.css">
	</head>
	<body style="background-color: #A6B6FF;position:relative;">
		<div >
			<img src="../img/logo.png" alt="Logo" width="84" height="84" style="float: left; margin-left: 30px;">
			<p class="header">Care Seekers Healthcare</p> 	
		</div>
		<div class="container" style="width:200px;height:400px;float:left; position:fixed;left:50px;">
			<p class="text" id="admin" style="font-size: 24px;">Dashboard</p>
			<div class="buttons" style="position:relative;" onclick="profile();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="profBtn" class="btn" value="Profile"></div>
			<div class="buttons" style="position:relative;" onclick="postjob();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="postBtn"  class="btn" value="Post a Job"></div>
			<div class="buttons" style="position:relative;" onclick="appsjob();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="appsBtn"  class="btn" value="View Applications"></div>
			<div class="buttons" style="position:relative;" onclick="msg();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="msgBtn"  class="btn" value="Messaging"></div>
			<div class="buttons" style="position:relative;" onclick="about();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" onclick="changestyle(this.id);" id="aboutBtn"  class="btn" value="About"></div>			
			<div class="buttons" style="position:relative;"><form method="POST"><input style="width:160px;padding:4px;font-size:18px;" type="submit" name="logoutBtn"class="btn" value="Log Out"></form></div>		
		</div>
		
		<div class="appContainer" style="display:none;min-height:300px;padding-bottom:50px;overflow:auto;" id="viewapps">
			<p class="text" id="appsTitleHTML" style="font-size: 24px;font-weight:bold;">Jobs Posted by You</p>
			
			<div style="position: relative;top:25px;">
			<input type="button" value="View Ongoing Jobs" id="viewCurrentBtn" class="jobfield" onclick="viewcurrentbtn();" style="float:right;height:35px;width:130px;position:absolute;top:-75px;right:25px" >
				<div id="viewCurrent" style="display:none;">
					<table class="tb" style="table-layout:fixed;min-height:150px;max-width:950px;word-wrap: break-word;">
						<tr>
							<th class="tbHead" style="width:250px;" colspan=2>Job Information</th>					
							<th class="tbHead" style="width:250px;" colspan=3>Job Details</th>
							<th class="tbHead" colspan=1>Job Description</th>					
							<th class="tbHead" colspan=1>Additional Details</th>
							<th class="tbHead" style="width:140px;" colspan=1>Complete Job</th>
						</tr>
						<?php 
						if($currentbyuserNum > 0){							
							foreach($currentbyuser as $print){ 
								$posterName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail = '{$print['poster']}'")); 
								$workerName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT * FROM users WHERE mail = '{$print['worker']}'")); 
								
								?>
								<tr>
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=8> <?php echo '<b>Support Worker on the job : </b>'.$workerName['fname'].' '.$workerName['sname']; ?></td>
								</tr>
								<tr>
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Title : </b>".$print['jobTitle']."<br><b>Job Type : </b>".$print['jobType']."<br><b>Posted By : </b>".$posterName['fname']." ".$posterName['sname']."<br><b>Posted On : </b>".$print['created']."<br>" ?></td>		
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=3><?php echo "<b>Job Location : </b>".$print['location']."<br><b>Skills Required : </b>".$print['skills']."<br><b>Estimated Budget : </b>".$print['salary']."<br><b>Contact Phone : </b>".$print['contactPhone'] ?></td>		
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['description']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['requirements']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1>
											<?php 
												echo '
											<form id="completeJob'.$print['id'].'">
												<input type="hidden" name="compjobId" value="'.$print['id'].'">
												<input type="hidden" name="workerId" value="'.$print['worker'].'">
												<input type="hidden" name="rating" id="compjobRating'.$print['id'].'" value="10">
												<input type="button" id="'.$print['id'].'" name="completeBtn" class="btn" onclick="completeJob(this.id);" style="font-size:14px;padding:4px;background-color:#3299ff;margin:4px;:height:33px;width:120px;" value="Complete Job">
											</form>
											<input type="button" name="'.$_SESSION['authentication']['user'].'" id="'.$print['poster'].'" class="btn" onclick="startConvo(this.name, this.id);" style="font-size:12px;padding:4px;background-color:#3299ff;margin:4px;:height:20px;width:80px;" value="Message">'
											;
											?>
											<br>
									</td>
								</tr>
								<?php 
							}
						}else{ 
							?><tr><td class="tbRow" colspan="8" style="font-size:24px;">There is no ongoing job yet.</td></tr>
							<?php 
						} 
						?>
					</table>
				</div>
				<div id="viewApplicant" style="display:none;">
				
				</div>
				<div class="text" id="viewUserJob" style="display:block;">
					<table class="tb" style="table-layout:fixed;min-height:150px;max-width:950px;word-wrap: break-word;">
						<tr>
							<th class="tbHead" style="width:250px;" colspan=2>Job Information</th>					
							<th class="tbHead" style="width:250px;" colspan=3>Job Details</th>
							<th class="tbHead" colspan=1>Job Description</th>					
							<th class="tbHead" colspan=1>Additional Details</th>
							<th class="tbHead" style="width:140px;" colspan=1>Applications</th>
						</tr>
						<?php 
						if($totaljobsbyuser > 0){							
							foreach($jobsbyuser as $print){ 
								$posterName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail = '{$print['poster']}'")); 
								?>
								<tr>
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Title : </b>".$print['jobTitle']."<br><b>Job Type : </b>".$print['jobType']."<br><b>Posted By : </b>".$posterName['fname']." ".$posterName['sname']."<br><b>Posted On : </b>".$print['created']."<br>" ?></td>		
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=3><?php echo "<b>Job Location : </b>".$print['location']."<br><b>Skills Required : </b>".$print['skills']."<br><b>Estimated Budget : </b>".$print['salary']."<br><b>Contact Phone : </b>".$print['contactPhone'] ?></td>		
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['description']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['requirements']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1>
										<form method="POST">
											<?php 
											if($print['status'] == -1){
												echo '<input type="button" id="" name="viewApplBtn" class="btn" onclick="return false;" style="font-size:14px;padding:4px;background-color:green;color:white;margin:4px;:height:33px;width:120px;" value="Finished!">';
											}else if($print['status'] == 2){
												echo '<input type="button" id="" name="viewApplBtn" class="btn" onclick="return false;" style="font-size:14px;padding:4px;background-color:#3299ff;color:white;margin:4px;:height:33px;width:120px;" value="Job Ongoing">';
											}else{
												echo '<input type="button" id="'.$print['id'].'" name="viewApplBtn" class="btn" onclick="viewApplicants(this.id);" style="font-size:14px;padding:4px;background-color:#3299ff;margin:4px;:height:33px;width:120px;" value="View Applications">';
											}
											?>
											<br>
										</form>
									</td>
								</tr>
								<?php 
							}
						}else{ 
							?><tr><td class="tbRow" colspan="8" style="font-size:24px;">You've posted no job yet.</td></tr>
							<?php 
						} 
						?>
					</table>
				</div>
			</div>
		</div>
		
		<div class="appContainer" style="display:none;min-height:300px;" id="postjob">
			<p class="text" id="jobTitleHTML" style="font-size: 24px;font-weight:bold;">Post a new Job</p>
			
			<form action="" method="POST" enctype="multipart/form-data" style="position: relative;top:25px;">
			<input type="button" value="View Posted Jobs" id="postjobBtn" class="jobfield" onclick="revealPostedJobs();" style="float:right;height:35px;width:130px;position:absolute;top:-75px;right:25px" >
				<div id="postaJob" style="display:block;">
				<div class="text" style="font-size: 17px;display:flex;flex-direction:row;position:relative;top:-50px;">
					<div class="profCol1"> <br>
						<p><b>Job Title : </b><input type="text" id="jobTitle" name="jobTitle" class="jobfield" style="position:relative;right:-75px;" required></p><br>
						<p><b>Job Location : </b><input type="text" id="location" name="location" class="jobfield" style="position:relative;right:-45px;" required></p><br> 
						<p><b>Skills required : </b><input type="text" id="skills" name="skills" class="jobfield" style="position:relative;right:-35px;"></p><br> 
						<p><b>Estimated Budget : </b><input type="text" id="salary" name="salary" class="jobfield" style="position:relative;right:-5px;"></p><br>
						<p><b>Job Type :</b><select id="jobType" name="jobType" class="jobfield" style="height:27px;width:150px;position:relative;right:-85px;">
									<option value="Full Time">Full Time</option>
									<option value="Part Time">Part Time</option>
									</select></p><br>
						<p><b>Contact Phone : </b><input type="tel" id="contactPhone" name="contactPhone" class="jobfield" style="position:relative;right:-32px;"><p><br><br>
					</div>
					<div class="profCol2"> <br>
						<p>Job Description:<br><br><textarea id="description" name="description" class="jobfield" style="height:120px;width:300px;margin-left:15px;" required></textarea><br><br> </p><br>
						<p>Job Requirements:<br><br><textarea id="requirements" name="requirements" class="jobfield" style="height:120px;width:300px;margin-left:15px;" required></textarea><br><br><br> 
					</div>
					
				</div>
				<input type="submit" name="postjob" value="Post Job" class="jobfield" style="font-weight:bold;font-size: 17px;position:relative;top:-75px;height:35px;width:130px;">
				</div>
				<div class="text" id="postedJob" style="display:none;">
					<table class="tb" style="table-layout:fixed;min-height:150pxmax-width:950px;word-wrap: break-word;">
						<tr>
							<th class="tbHead" style="width:250px;" colspan=2>Job Information</th>					
							<th class="tbHead" style="width:250px;" colspan=3>Job Details</th>
							<th class="tbHead" colspan=1>Job Description</th>					
							<th class="tbHead" colspan=1>Additional Details</th>
						</tr>
						<?php 
						if($totaljobs > 0){							
							foreach($jobsAvail as $print){ 
								$posterName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail = '{$print['poster']}'")); 
								?>
								<tr>
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><?php echo "<b>Job Title : </b>".$print['jobTitle']."<br><b>Job Type : </b>".$print['jobType']."<br><b>Posted By : </b>".$posterName['fname']." ".$posterName['sname']."<br><b>Posted On : </b>".$print['created']."<br>" ?></td>		
									<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=3><?php echo "<b>Job Location : </b>".$print['location']."<br><b>Skills Required : </b>".$print['skills']."<br><b>Estimated Budget : </b>".$print['salary']."<br><b>Contact Phone : </b>".$print['contactPhone'] ?></td>		
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['description']?></td>
									<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1><?php echo $print['requirements']?></td>
								</tr>
								<?php 
							}
						}else{ 
							?><tr><td class="tbRow" colspan="7" style="font-size:24px;">No jobs are available yet!</td></tr>
							<?php 
						} 
						?>
					</table>
				</div>
			</form>
		</div>
		<div class="appContainer" style="display:none;" id="about">
			<p class="text" id="admin" style="font-size: 24px;">Care Seekers Healthcare</p>
			<p class="text" style="font-size: 17px;">This web app is designed to connect individuals seeking caregiving services with qualified support workers. People in need of such services can register, post caregiving jobs, and apply for jobs in categories like babysitting, cooking, and personal care. App's security and administration ensures safe and reliable connections. It simplifies the process of finding care or providing caregiving services in a user-friendly way.</p>
			<p class="text" style="font-size: 18px;font-weight:bold;color:blue;" ><a class="btn" href="https://bc190405120s-ultra-awesome-resume.webflow.io/">MY WEBFLOW RESUME</A><P>
			<img src="../img/about.png">
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
		<div class="appContainer" style="display:none;" id="profile">
			<p class="text" id="admin" style="font-size: 24px;font-weight:bold;"><?php echo $resultProfile['fname']." ".$resultProfile['sname']; ?>'s Profile</p>
			<div class="text" style="font-size: 17px;display:flex;flex-direction:row;position:relative;top:-50px;">
				<div class="profCol1"> 
					<p><b>First Name : </b><?php echo $resultProfile['fname']; ?></p><br>
					<p><b>Second Name : </b><?php echo $resultProfile['sname']; ?></p><br> 
					<p><b>Email : </b><?php echo $resultProfile['mail']; ?></p><br> 
					<p><b>Phone : </b><?php echo $resultProfile['phone']; ?></p><br>
					<p><b>Role : </b><?php if($resultProfile['role'] == "seeker"){echo "Care Seeker";}elseif($resultProfile['role'] == "worker"){echo "Support Worker";} ?></p><br>
					<p><b>Address : </b><?php echo $resultProfile['address']; ?></p><br>
					<p><b>Rating : </b><?php if($resultProfile['jobsDone'] > 0) {echo $rating = $resultProfile['rating'] / $resultProfile['jobsDone'];}else{ echo "10";} ?></p><br>
				</div>
				<div class="profCol2"> 
					<p><?php echo '<img src="../uploads/'.$resultProfile['pic'] .'" width="338px" height="338px">' ?> </p><br>
					<p><b>Bio : </b><?php echo $resultProfile['_bio']; ?></p><br> 
				</div>
			</div>
		</div>
		<footer style="text-align: center;position: fixed;bottom: 0px; z-index:-1;width:100%;">
			<img src="../img/quote.png" alt="Logo" id="quote">
		</footer>
	</body>
</html>
