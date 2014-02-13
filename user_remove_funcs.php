<?
include_once('connection.php');
include_once('user_get_funcs.php');

function do_leave_group($email, $group_id){
	// Removes user from group by deleting membership
	$creator = do_get_creator($group_id);
	$admin = user_is_admin($email);
	if($email != $creator || $admin){
		$sql = "
			DELETE FROM `membership`
			WHERE '$email' = email AND '$group_id' = group_id
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
	else{
		return false;
	}
}


//Delete Messages (only if admin or creator)
function do_remove_message($email, $message_id)
{
	//function do_remove_message($email, $message_id, $creator, $admin)
	// Deletes messages from the database
	//if email matches the creator OR if admin
	$creator = do_get_message_creator($message_id);
	$admin = user_is_admin($email);
	if($email == $creator || $admin) {
		$sql = "
			DELETE FROM `messages`
			WHERE '$email' = creator AND'$message_id' = message_id
		";
		$result = mysql_query($sql);
		if (!$result) {
			mysql_query('ROLLBACK');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

//Delete Files (only if admin or creator)
function do_remove_file($email, $file_name_path)
{//function do_remove_file($email, $file_name_path, $creator, $admin)
	// Deletes files from the database
	//if email matches the creator OR if admin
	$creator = do_get_file_creator($file_name_path);
	$admin = user_is_admin($email);
	if($email == $creator || $admin)
	{
		$sql = "
			DELETE FROM `file`
			WHERE '$email' = creator AND '$file_name_path' = file_name_path
		";
		$result = mysql_query($sql);
		if (!$result) 
		{
			mysql_query('ROLLBACK');
			return FALSE;
		}
		else 
		{
			return TRUE;
		}
	}
}

//Ban Method
function do_ban_user($email, $admin)
{
	if($admin)
	{
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
		else
		{
			return TRUE;
		}
	}
}

//Reverse a Ban Method
function do_unban_user($email, $admin)
{
	if($admin)
	{
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
		else
		{
			return TRUE;
		}
	}
}

?>