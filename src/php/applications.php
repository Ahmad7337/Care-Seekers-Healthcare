<?php
		session_start();
		include_once "db.php";

		$jobID = mysqli_real_escape_string(db(),$_GET['jobID']);
		$job = mysqli_fetch_assoc(mysqli_query(db(),"SELECT * FROM jobsavail WHERE id = '$jobID'")); 
		$posterName = mysqli_fetch_assoc(mysqli_query(db(),"SELECT fname,sname FROM users WHERE mail = '{$job['poster']}'")); 
		$appQuery = mysqli_query(db(),"SELECT * FROM applications WHERE appliedFor = '$jobID'");
		$applications = mysqli_fetch_assoc($appQuery); 
		
		$output = '';
		
		echo '<img src="../img/back.png" width="32px" height="32px" class="chatImg" onclick="closeapplicant();">
			<table class="tb" style="table-layout:fixed;min-height:150pxmax-width:950px;word-wrap: break-word;">
				<tr>
					<th class="tbHead" style="width:250px;" colspan=2>Job Information</th>					
					<th class="tbHead" style="width:250px;" colspan=3>Job Details</th>
					<th class="tbHead" colspan=1>Job Description</th>					
					<th class="tbHead" colspan=1>Additional Details</th>
				</tr>
				<tr>
					<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=2><b>Job Title : </b>'.$job['jobTitle'].'<br><b>Job Type : </b>'.$job['jobType'].'<br><b>Posted By : </b>'.$posterName['fname'].' '.$posterName['sname'].'<br><b>Posted On : </b>'.$job['created'].'<br></td>		
					<td style="background-color: #CEE6F3;text-align:left;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=3><b>Job Location : </b>'.$job['location'].'<br><b>Skills Required : </b>'.$job['skills'].'<br><b>Estimated Budget : </b>'.$job['salary'].'<br><b>Contact Phone : </b>'.$job['contactPhone'].'</td>		
					<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1>'.$job['description'].'</td>
					<td style="background-color: #CEE6F3;border-top:8px;border-right:1px;border-style:solid;border-color: white;padding: 5px;" colspan=1>'.$job['requirements'].'</td>
				</tr>
			</table>
		';
		if(mysqli_num_rows($appQuery) > 0){
			$output = '
				<table class="tb" style="table-layout:fixed;min-height:150px;max-width:950px;word-wrap: break-word;">
					<tr>
						<td class="tbRow" colspan="7" style="font-size:18px;"><br><b>Following Support Workers applied for this job :</b><br><br></td>
					</tr>
					<tr>
						<th class="tbHead" style="width:84px" colspan=1>Applicant Picture</th>					
						<th class="tbHead" style="width:260px;" colspan=2>Applicant Information</th>
						<th class="tbHead" style="width:210px;"colspan=2>Job Information</th>					
						<th class="tbHead">Applicant Bio</th>
						<th class="tbHead" style="width:80px">Approval</th>
					</tr>
			';							
			foreach($appQuery as $print){ 
				$applicant = mysqli_fetch_assoc(mysqli_query(db(),"SELECT * FROM users JOIN workers ON users.mail = workers.mail WHERE users.mail = '{$print['appliedBy']}'")); 
				if($applicant['jobsDone'] > 0) {$rating = $applicant['rating'] / $applicant['jobsDone'];}else{ $rating = "10";}
				$output .=' 
					<tr>
						<td style="background-color: #CEE6F3;border:2px solid white;" colspan=1><img src="../uploads/'.$applicant['pic'] .'" width="84" height="84"></td>		
						<td style="background-color: #CEE6F3;text-align:left;border:2px solid white;font-size:16px;" colspan=2><b>Full name : </b>'.$applicant['fname'].' '.$applicant['sname'].'<br><b>Phone # : </b>'.$applicant['phone'].'<br><b>Email : </b>'.$applicant['mail'].'</td>		
						<td style="background-color: #CEE6F3;text-align:left;border:2px solid white;font-size:16px;" colspan=2><b>Hourly Rate : </b>'.$applicant['rate'].'<br><b>Experience : </b>'.$applicant['xp'].'<br><b>Qualification : </b>'.$applicant['qualify'].'<br><b>Rating : </b>'.$rating.' </td>
						<td style="background-color: #CEE6F3;border:2px solid white;">'.$applicant['bio'].'</td>
						<td style="background-color: #CEE6F3;border:2px solid white;"><form method="POST"><input type="hidden" value="'.$applicant['mail'].'" name="applicantMail"><input type="hidden" value="'.$jobID.'" name="JobID"><input type="submit" name="acceptJobBtn" class="btn" style="font-size:16px;padding:4px;background-color:green;margin:2px" value="Accept"><input type="submit" name="rejectJobBtn" class="btn" style="font-size:16px;padding:4px;background-color:red;margin:2px" value="Reject"></form> <input type="button" name="'.$job['poster'].'" id="'.$print['appliedBy'].'" class="btn" onclick="startConvo(this.name, this.id);" style="font-size:12px;padding:4px;background-color:#3299ff;margin:4px;:height:20px;width:80px;" value="Message"></td>
					</tr>
				';
			}
			$output .= '</table>';
			echo $output;
		}else{ 
			echo '<tr><td class="tbRow" colspan="7" style="font-size:24px;"><br><br><b>No one has applied for this job yet.</b></td></tr>';
		}
?>












