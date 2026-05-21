<?php 

include("../php/authentication.php");
include("../php/adminInfo.php")

?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript"> 
		function reveal(){
			var x = document.getElementById("applications");
			var y = document.getElementById("about");
			if(x.style.display === 'none'){
				x.style.display = 'block';
				y.style.display = 'none';
				document.getElementById("btn").value = "Hide Applications";
			}else{
				x.style.display = 'none';
				document.getElementById("btn").value = "Account Approval";
			}
		}
		function revealAbout(){
			var x = document.getElementById("about");
			var y = document.getElementById("applications");
			var i = document.getElementById("quote");
			if(x.style.display === 'none'){
				x.style.display = 'block';
				y.style.display = 'none';
			}else{
				x.style.display = 'none';
			}
		}
	</script>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" type="text/css" href="../style/tbStyle.css">
	</head>
<body style="background-color: #A6B6FF;position:relative;">
	<div>
		<img src="../img/logo.png" alt="Logo" width="84" height="84" style="float: left; margin-left: 30px;">
		<p class="header">Care Seekers Healthcare</p> 	
	</div>
	<div>
		<div class="container" style="width:200px;height:400px;float:left; position:fixed;left:50px;">
			<p class="text" id="admin" style="font-size: 24px;">Admin Panel</p>
			<div class="buttons" style="position:relative;" onclick="reveal();" ><input  style="width:160px;padding:4px;font-size:18px;" type="submit" class="btn" id="btn" value="Account Approval"><?php if($appNum > 0) echo '<div class="notif" id="notifications">'. $appNum.'</div>'?></div>
			<div class="buttons" style="position:relative;" onclick="revealAbout();"><input style="width:160px;padding:4px;font-size:18px;" type="submit" class="btn" value="About"></div>	
			<div class="buttons" style="position:relative;"><form method="POST"><input style="width:160px;padding:4px;font-size:18px;" type="submit" name="logoutBtn"class="btn" value="Log Out"></form></div>		
		</div>
		<div class="appContainer" style="display:none;" id="about">
		<p class="text" id="admin" style="font-size: 24px;">Care Seekers Healthcare</p>
		<p class="text" style="font-size: 17px;">This web app is designed to connect individuals seeking caregiving services with qualified support workers. People in need of such services can register, post caregiving jobs, and apply for jobs in categories like babysitting, cooking, and personal care. App's security and administration ensures safe and reliable connections. It simplifies the process of finding care or providing caregiving services in a user-friendly way.</p>
		<p class="text" style="font-size: 18px;font-weight:bold;color:blue;" ><a class = "btn" href="https://bc190405120s-ultra-awesome-resume.webflow.io/">MY WEBFLOW RESUME</A><P>
		<img src="../img/about.png">
		</div>
		<div class="appContainer" style="display:none;" id="applications">
			<table class="tb" style="table-layout:fixed;max-width:950px;word-wrap: break-word;">
				<tr>
					<th class="tbHead" style="width:96px">Picture</th>					
					<th class="tbHead" style="width:260px;" colspan=2>General Information</th>
					<th class="tbHead" style="width:210px;"colspan=2>Job Information</th>					
					<th class="tbHead">Bio</th>
					<th class="tbHead" style="width:80px">Approval</th>
				</tr>
				<?php 
				if($appNum > 0){
					if(mysqli_num_rows($workAPP) > 0){
						foreach($workAPP as $print){ 
							?>
							<tr>
								<td style="background-color: #CEE6F3;border:2px solid white;"><?php echo '<img src="../uploads/'.$print['pic'] .'" width="84" height="84">' ?></td>		
								<td style="background-color: #CEE6F3;text-align:left;border:2px solid white;font-size:16px;" colspan=2><?php echo "<b>Full name : </b>".$print['fname']." ".$print['sname']."<br><b>Email : </b>".$print['mail']."<br><b>Phone # : </b>".$print['phone'] ?></td>		
								<td style="background-color: #CEE6F3;text-align:left;border:2px solid white;font-size:16px;" colspan=2><?php echo "<b>Role : </b>".$print['role']."<br><b>Hourly Rate : </b>".$print['rate']."<br><b>Experience : </b>".$print['xp']."<br><b>Qualification : </b>".$print['qualify'] ?></td>
								<td style="background-color: #CEE6F3;border:2px solid white;"><?php echo $print['bio']?></td>
								<td style="background-color: #CEE6F3;border:2px solid white;"><form method="POST"><?php echo '<input type="hidden" value="'.$print['mail'].'" name="email">' ?><input type="submit" name="acceptBtn" class="btn" style="font-size:16px;padding:4px;background-color:green;margin:2px" value="Accept"><br><input type="submit" name="rejectBtn" class="btn" style="font-size:16px;padding:4px;background-color:red;margin:2px" value="Reject"></form></td>
							</tr>
							<?php 
						}
					}
					if(mysqli_num_rows($seekAPP) > 0){
						foreach($seekAPP as $print){ 
							?>
							<tr>
								<td style="background-color: #CEE6F3;border:2px solid white;"><?php echo '<img src="../uploads/'.$print['pic'] .'" width="84" height="84">' ?></td>		
								<td style="background-color: #CEE6F3;text-align:left;border:2px solid white;font-size:16px;" colspan=2><?php echo "<b>Full name : </b>".$print['fname']." ".$print['sname']."<br><b>Email : </b>".$print['mail']."<br><b>Phone # : </b>".$print['phone'] ?></td>		
								<td style="background-color: #CEE6F3;text-align:left;border:2px solid white;font-size:16px;" colspan=2><?php echo "<b>Role : </b>".$print['role']."<br><b>Address : </b>".$print['address'] ?></td>
								<td style="background-color: #CEE6F3;border:2px solid white;"><?php echo $print['_bio']?></td>
								<td style="background-color: #CEE6F3;border:2px solid white;"><form method="POST"><?php echo '<input type="hidden" value="'.$print['mail'].'" name="email">' ?><input type="submit" name="acceptBtn" class="btn" style="font-size:16px;padding:4px;background-color:green;margin:2px" value="Accept"><br><input type="submit" name="rejectBtn" class="btn" style="font-size:16px;padding:4px;background-color:red;margin:2px" value="Reject"></form></td>
							</tr>
							<?php
						}
					}
				}else{ 
					?><tr><td class="tbRow" colspan="7" style="font-size:24px;">Hooray!! No accounts pending approval!!</td></tr>
					<?php 
				} 
				?>
			</table>
		</div>
		
	</div>
    <footer style="text-align: center;position: fixed;bottom: 0px; z-index:-1;width:100%;">
		<img src="../img/quote.png" alt="Logo" id="quote">
    </footer>
</body>
</html>
