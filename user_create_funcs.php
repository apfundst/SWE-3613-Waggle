<?
include_once('connection.php');

date_default_timezone_set('US/EASTERN');

function do_create_user($email, $random_password, $first_name, $last_name, $student_id){
	$sql = "
		 INSERT INTO `user`(`email`,`password`,`first_name`,`last_name`,`student_id`)
		 VALUES('$email','$random_password','$first_name','$last_name','$student_id')
	";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}
}

function do_check_user($email){
	$sql = "
		SELECT *
		FROM `user` 
		WHERE email = '$email';
	";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count > 0){
		return TRUE;
	}
	else{
		return FALSE;
	}

}

function do_check_user_password($email, $entered_password){
	$sql = "
		SELECT password
		FROM `user` 
		WHERE email = '$email';
	";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$current_password = $row['password'];
	if( strcmp($current_password, $entered_password) != 0 ){
		return FALSE;
	}
	else{
		return TRUE;
	}
}

function do_send_new_user_email($email, $first_name, $last_name, $random_password){
	
	$subject = 'Your NEW Waggle Account';
	$message = 'Congratulations '.$first_name.' '.$last_name.'! 
	This email confirms your successful registration for WAGGLE. Please go to waggle.myskiprofile.com and login in with your SPSU email 
	address and temporary password. Do not respond to this email address as it is not monitored. 
	Your temporary password is: '.$random_password;

	$headers = 'From: admin@waggle.com'."\r\n" . 'X-Mailer: PHP/'. phpversion();

	$successful = mail($email,$subject,$message,$headers);
	if($successful){
		return TRUE;
	}
	else{
		return FALSE;
	}
}

function do_create_random_password(){
    $legals = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*()";
    $password = "";
    $legalsLength =  strlen($legals) - 1;
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $legalsLength);
        $password .= $legals[$n];
    }
    return $password;
}

function do_change_password($email,$new_password){
	$new_password = mysql_real_escape_string($new_password);
	$sql = "
			UPDATE `user`
			SET password = '$new_password'
			WHERE email = '$email'
	"; 
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}

}

function do_forgot_password($email,$student_id){
	//Checks to see if user exists in db and information is correct
	$sql = "
			SELECT email, student_id
			FROM `user`
			WHERE email = '$email' AND
			student_id = '$student_id'
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return FALSE;
	}
	else{
		$random_password = do_create_random_password();
		$subject = 'RESET Waggle Account Password';
		$message = 'Dear'.$first_name.' '.$last_name.': 
		This email confirms your password reset for the WAGGLE website for the email address '.$email.'. Please go to waggle.myskiprofile.com and login in with your SPSU email address and RESET password. Do not respond to this email address as it is not monitored. 
		Your RESET password is: '.$random_password;
		$headers = 'From: admin@waggle.com'."\r\n" . 'X-Mailer: PHP/'. phpversion();

		$successful = mail($email,$subject,$message,$headers);
		if($successful){
			$sql = "
				UPDATE `user`
				SET password = '$random_password'
				WHERE email = '$email'
			"; 
			$result = mysql_query($sql);
			if (!$result) {
				mysql_query('ROLLBACK');
				return FALSE;
			}
			else{
				return $random_password;
			}
		}
		else{
			return FALSE;
		}
	}
}

function do_post_message($thread_id, $creator,$text){
	// needs to post message into database
	// will require

	// message_id, and date_created autogenerate
	$message = nl2br($text);
	$message = strip_tags($message,'<br>'); //altered to prevent cross site and potential leak 
	$message = mysql_real_escape_string($message);

	$new_time_stamp = date('Y-m-d H:i:s');

	$sql = "
		 	INSERT INTO `message`(`thread_id`,`creator`,`message_text`,`date_created`)
		 	VALUES('$thread_id','$creator','$message','$new_time_stamp')
	";

	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		mysql_query(" UPDATE `thread` SET last_update = '$new_time_stamp' WHERE thread_id = '$thread_id' ");
		$other_result = mysql_query(" SELECT group_id FROM `thread` WHERE thread_id = '$thread_id' "); 
		$row = mysql_fetch_assoc($other_result);
     	$group_id = $row['group_id'];
		mysql_query(" UPDATE `group` SET last_update = '$new_time_stamp' WHERE group_id = '$group_id' ");

		return TRUE;
	}
}


function do_create_thread($group_id, $creator, $subject){

	$scrubbed_subject = strip_tags($subject);
	$scrubbed_subject = mysql_real_escape_string($scrubbed_subject);

	$new_time_stamp = date('Y-m-d H:i:s');

	$sql = "
		INSERT INTO `thread`(`group_id`,`creator`,`subject`,`last_update`,`date_created`)
		VALUES('$group_id','$creator','$scrubbed_subject','$new_time_stamp','$new_time_stamp')
	";
	$result = mysql_query($sql);
	$last_row = mysql_insert_id();
	if(!$result){
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		mysql_query(" UPDATE `group` SET last_update = '$new_time_stamp' WHERE group_id = '$group_id' ");
		return $last_row;
	}
}

function do_create_membership($email, $group_id){
	// Will create a membership for a user if that user
	// does not already belong to group

	// NOT THREAD SAFE 
	// NEEDS TO HAVE MORE ROBUST FAIL SAFE IF COMMITT FAILS

	$sql = "
		INSERT INTO `membership`(`group_id`,`email`)
		VALUES('$group_id', (SELECT email FROM `user` WHERE '$email' = email) )
	";

	$result = mysql_query($sql);
	$last_row = mysql_insert_id();
	if(!$result){
		return FALSE;
	}
	else{
		return TRUE;
	}
}

function do_create_group($email, $group_name, $group_description){
	// WIll insert into database but kick out an insert
	// that has a group name that already exists in db
	// NOTE: WILL NEED TO CHECK IF QUERY FAILS OR IF
	// THE CONNECTION TO DB WAS UNSUCCESSFUL

	// NINJA EDIT: 3 Feb 2014 23:29 made 
	//			   group_name unique
	$scrubbed_group_name = strip_tags($group_name);
	$scrubbed_group_name = mysql_real_escape_string($scrubbed_group_name);

	$scrubbed_group_description = strip_tags($group_description);
	$scrubbed_group_description = mysql_real_escape_string($scrubbed_group_description);

	$new_time_stamp = date('Y-m-d H:i:s');
	$sql = "
		   INSERT INTO `group`(`creator`,`group_name`,`group_description`,`last_update`,`date_created`)
		   VALUES('$email','$scrubbed_group_name','$scrubbed_group_description','$new_time_stamp','$new_time_stamp')
	";
	$result = mysql_query($sql);
	$temp_id = mysql_insert_id();
	if(!$result){
		return FALSE;
	}
	else{
		do_create_membership($email, $temp_id);
		return TRUE;
	}

  }


?>