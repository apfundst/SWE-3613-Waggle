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



function do_remove_message($message_id){

	$sql = "
		DELETE FROM `message`
		WHERE message_id =  '$message_id' 
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

function do_edit_message($message_id, $new_text){

	$new_time_stamp = mysql_real_escape_string($new_time_stamp);
	$new_text =  mysql_real_escape_string($new_text);
	$message_id =  mysql_real_escape_string(nl2br($message_id));

	

	$sql = "
		UPDATE `message`
		SET text = '$new_text'
		WHERE message_id = '$message_id'
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


//Delete Files (only if admin or creator)
function do_remove_file($email, $file_name_path)
{//function do_remove_file($email, $file_name_path, $creator, $admin)
	// Deletes files from the database
	//if email matches the creator OR if admin
	//******Drew: taking away back end checking
	//$creator = do_get_file_creator($file_name_path);
	//$admin = user_is_admin($email);
	//if($email == $creator || $admin)
	//{
		/*$sql = "
			DELETE FROM `file`
			WHERE '$email' = creator AND '$file_name_path' = file_name_path
		";*/
		$sql = "
			DELETE FROM `file`
			WHERE  '$file_name_path' = file_name_path
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
	//}
}
?>