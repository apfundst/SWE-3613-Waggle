<?
include_once('connection.php');


function do_leave_group($email, $group_id){
	// Removes user from group by deleting membership
	$sql = "
		DELETE FROM `membership`
		WHERE '$email' = email AND '$group_id' = group_id
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

function do_post_message($thread_id, $creator,$text){
	// needs to post message into database
	// will require

	// message_id, and date_created autogenerate
	$message = nl2br($text);
	$message = mysql_real_escape_string($message);

	$sql = "
		 	INSERT INTO `message`(`thread_id`,`creator`,`message_text`)
		 	VALUES('$thread_id','$creator','$message')
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


function do_create_thread($group_id, $creator, $subject){

	$scrubbed_subject = mysql_real_escape_string($subject);

	$sql = "
		INSERT INTO `thread`(`group_id`,`creator`,`subject`)
		VALUES('$group_id','$creator','$scrubbed_subject')
	";
	$result = mysql_query($sql);
	if(!$result){
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return mysql_insert_id();
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

	$scrubbed_group_name = mysql_real_escape_string($group_name);
	$scrubbed_group_description = mysql_real_escape_string($group_description);
	
	$sql = "
		   INSERT INTO `group`(`creator`,`group_name`,`group_description`)
		   VALUES('$email','$scrubbed_group_name','$scrubbed_group_description')
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