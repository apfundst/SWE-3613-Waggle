<?
include_once('connection.php');

function do_admin_get_groups(){
	// Returns all groups
	$sql = "
		SELECT group_id, group_name, creator
		FROM `group`
	";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query: " .mysql_error());
	}	
	else{
     	// Get the information from the result set
		$i = 0;
     	while($row = mysql_fetch_row($result)){
     		$data[$i] = $row;
     		$i++; 
     	}
    	return $data;
    }
}

function do_admin_remove_group($group_id){
	// Removes group from User view
	// Retains group in db for records

	//*******************************************************************************
	// Allowed to delete data from database?
	/*
	$sql = "
			DELETE FROM `group`
			WHERE '$group_id' = group_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}
	*/
	// Not allowed to delete data from database
	/*
	$sql = "
			UPDATE `group`
		 	SET `authorized` = '0'
		 	WHERE '$group_id' = group_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}
	*/
	//*******************************************************************************
}

function do_admin_ban_user($email) {
	$sql = "
		UPDATE `user`
		SET `authorized` = '0'
		WHERE '$email' = email
	";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else {
		return TRUE;
	}
}

function do_admin_unban_user($email) {
	$sql = "
		UPDATE `user`
	 	SET `authorized` = '1'
	 	WHERE '$email' = email
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

function do_admin_ban_user_site() {
	// Time based ban
}

function do_admin_ban_group() {
	// Time based ban
}

function do_admin_ban_user_group() {
	// Time based ban
}

function do_admin_remove_file($file_id) {
	// Removes file from User view
	// Retains file in db for records

	//*******************************************************************************
	// Allowed to delete data from database?
	/*
	$sql = "
			DELETE FROM `file`
			WHERE '$file_id' = file_id
		";
	$result = mysql_query($sql);
	if (!$result){
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}
	
	// Not allowed to delete stuff from DB
	$sql = "
			UPDATE `file`
		 	SET `authorized` = '0'
		 	WHERE '$file_id' = file_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else {
		return TRUE;
	}
	*/
	//*******************************************************************************
}

function do_admin_remove_message($message_id) {
	// Removes message from User view
	// Retains message in db for records
	// Indicates in thread message was banned
	
	//*******************************************************************************
	// Allowed to delete data from database?
	/*
	$sql = "
			DELETE FROM `message`
			WHERE '$message_id' = message_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else {
		return TRUE;
	}
	//Add banned message
	// Not allowed to delete stuff from DB
	$sql = "
			UPDATE `message`
		 	SET `authorized` = '0'
		 	WHERE '$message_id' = message_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else {
		return TRUE;
	}
	//Add banned message
	*/
	//*******************************************************************************
}

function do_admin_remove_thread($thread_id) {
	// Removes thread from User view
	// Retains thread in db for records

	//*******************************************************************************
	// Allowed to delete data from database?
	/*
	$sql = "
			DELETE FROM `thread`
			WHERE '$thread_id' = thread_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}
	*/
	// Not allowed to delete data from database
	/*
	$sql = "
			UPDATE `thread`
		 	SET `authorized` = '0'
		 	WHERE '$thread_id' = thread_id
		";
	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		return FALSE;
	}
	else{
		return TRUE;
	}
	*/
	//*******************************************************************************
}

function do_admin_add_admin($email) {
	$sql = "
		UPDATE `user`
	 	SET `admin` = '1'
	 	WHERE '$email' = email
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

function do_admin_remove_admin($email) {
	$sql = "
		UPDATE `user`
	 	SET `admin` = '0'
	 	WHERE '$email' = email
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

?>
