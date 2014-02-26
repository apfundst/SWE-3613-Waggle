<?
include_once('connection.php');
include_once('other_funcs.php');
date_default_timezone_set('US/EASTERN');

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

function do_admin_get_users()
{
	// Returns all users for the Admin panel
	$sql = "
		SELECT email, first_name, last_name, authorized
		FROM `user`
	";
	$result = mysql_query($sql);
	if(!$result)
	{
		die("Invalid query: " .mysql_error());
	}	
	else
	{
		$i = 0;
     	while($row = mysql_fetch_row($result)){
     		$data[$i] = $row;
     		$i++; 
     	}
    	return $data;
    }
}

function do_admin_ban_group($group_name){
	// Removes group from User view
	// Retains group in db for records
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
	$sql = "
			UPDATE `group`
		 	SET `authorized` = '0'
		 	WHERE '$group_name' = group_name
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

function do_admin_unban_group($group_name){
	$sql = "
			UPDATE `group`
		 	SET `authorized` = '1'
		 	WHERE '$group_name' = group_name
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

function do_admin_remove_file($file_id) {
	// Removes file from User view
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
	
	/*
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
}

function do_admin_remove_thread($thread_id) {
	//Delete Messages first
	//sql statement that deletes all messages matching the thread id
	do_delete_thread_messages($thread_id);
	
	// Deletes the thread after the messages have all been deleted
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
}

function do_delete_thread_messages($thread_id){
	$sql = "
			DELETE FROM `messages`
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

function do_admin_return_unbanned_users()
{
	$sql = "
		SELECT email, first_name, last_name
		FROM `user`
		WHERE 'authorized' = '1'
	";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query: " .mysql_error());
	}	
	else{
		$i = 0;
     	while($row = mysql_fetch_row($result)){
     		$data[$i] = $row;
     		$i++; 
     	}
    	return $data;
    }
}

function do_admin_return_banned_users()
{
	$sql = "
		SELECT email, first_name, last_name
		FROM `user`
		WHERE 'authorized' = '1'
	";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query: " .mysql_error());
	}	
	else{
		$i = 0;
     	while($row = mysql_fetch_row($result)){
     		$data[$i] = $row;
     		$i++; 
     	}
    	return $data;
    }
}

?>
