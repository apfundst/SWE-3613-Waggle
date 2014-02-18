<?
include_once('connection.php');

function do_get_thread_subject($thread_id){
	$sql = "
		   SELECT subject
		   FROM `thread`
		   WHERE '$thread_id' = thread_id	
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
     	// Get the information from the result set
		$row = mysql_fetch_array($result);
    	return $row['subject'];
    }
    die;
}

function do_get_creator($group_id){

	$sql = "
		   SELECT creator
		   FROM `group`
		   WHERE '$group_id' = group_id	
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
       	// Get the information from the result set
		$row = mysql_fetch_array($result);
    	return $row['creator'];
    }
    die;
}

function do_get_messages($thread_id){
	// loads messages on to page
	// need to pass thread_id from session

	// ordering in ascending order starting
	// with oldest at top
	$sql = "
		   SELECT *
		   FROM `message`
		   WHERE '$thread_id' = thread_id
		   ORDER BY date_created  ASC		
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
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
    die;
}

function do_get_group_id($creator, $group_name){
	// Gets group_id from group table

	// NOT THREAD SAFE 
	// NEEDS TO HAVE MORE ROBUST FAIL SAFE IF COMMITT FAILS

	$sql = "
		SELECT group_id 
		FROM `group` 
		WHERE '$group_name'= group_name AND
			  '$creator' = creator
		";
	$result = mysql_query($sql);
	if(!$result){
		return FALSE;
	}
	else{
		$row = mysql_fetch_array($result);
		return $row['group_id'];
	}
}

function do_get_name($email){
	$sql = "
		SELECT first_name, last_name 
		FROM `user` 
		WHERE '$email'= email
		";
	$result = mysql_query($sql);
	if(!$result){
		return FALSE;
	}
	else{
		$row = mysql_fetch_array($result);
		$fname = $row['first_name'];
		$lname = $row['last_name'];
		return $fname .' ' . $lname;
	}

}


function do_get_groups($email){
		// gets groups from db for user
		// get the group_name from the group table
		// where the email matches the email in the membership table
		// and the group_id matches the group_id in the group table

		$sql = "
		   	SELECT group.group_id, group.group_name, group.creator
		   	FROM `group`
		   	INNER JOIN `membership`
		   	ON group.group_id = membership.group_id 
		   	AND '$email' = membership.email   
		   	ORDER BY group.group_name ASC		
		";
		$result = mysql_query($sql);
		if(!$result){
			die("Invalid query: " .mysql_error());
		}	
		else{
			if(mysql_num_rows($result)==0){
				return NULL;
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
    	die;
}


function do_get_group_name($group_id){
	// gets groups from db for user
	// get the group_name from the group table
	// where the email matches the email in the membership table
	// and the group_id matches the group_id in the group table

	$sql = "
	   	SELECT group_name 
	   	FROM `group`
	   	WHERE group_id = '$group_id'	   	
		";
	$result = mysql_query($sql);
	if(!$result){
		die("Invalid query: " .mysql_error());
	}	
	else{
		if(mysql_num_rows($result)==0){
			return NULL;
		}
		else{
     		// Get the information from the result set
     		$row = mysql_fetch_assoc($result);
     		$data = $row['group_name'];
    		return $data;
    	}
    }
    die;
}

function do_get_group_members($group_id){
	$sql = "
		SELECT email
		FROM `membership`
		WHERE '$group_id' = group_id
		ORDER BY date_created ASC		
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
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

function do_get_group_description($group_id){
	$sql = "
		SELECT group_description
		FROM `group`
		WHERE '$group_id' = group_id	
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
     	// Get the information from the result set
    	$row = mysql_fetch_assoc($result);
     	$data = $row['group_description'];
    	return $data;
  	}
}




function do_get_threads($group_id){
	// gets threads from group from db

	// get the threads_name from the group table
	// where the email matches the email in the membership table
	// and the group_id matches the group_id in the group table
	$sql = "
		   SELECT * 
		   FROM `thread`
		   WHERE '$group_id' = group_id
		   ORDER BY date_created ASC		
	";
	$result = mysql_query($sql);
		if(!$result){
			die("Invalid query: " .mysql_error());
		}	
		else{
			if(mysql_num_rows($result)==0){
				return NULL;
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
    	die;
}

//Retreives all files that are posted in the specified group
function do_get_files($group_id){
	$sql = "
		   SELECT * 
		   FROM `file`
		   WHERE '$group_id' = group_id
		   ORDER BY date_created ASC		
	";
	$result = mysql_query($sql);
		if(!$result){
			die("Invalid query: " .mysql_error());
		}	
		else{
			if(mysql_num_rows($result)==0){
				return NULL;
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
    	die;
}

//Retreives file creator from database
function do_get_file_creator($file_name_path){
	$sql = "
		   SELECT creator
		   FROM `file`
		   WHERE '$file_name_path' = file_name_path	
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
       	// Get the information from the result set
		$row = mysql_fetch_array($result);
    	return $row['creator'];
    }
    die;
}

//Retreives message creator from database
function do_get_message_creator($message_id){
	$sql = "
		   SELECT creator
		   FROM `message`
		   WHERE '$message_id' = message_id	
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
       	// Get the information from the result set
		$row = mysql_fetch_array($result);
    	return $row['creator'];
    }
    die;
}

//Returns 1 or 0 based on admin status
function user_is_admin($email){
	$sql = "
		   SELECT admin
		   FROM `user`
		   WHERE '$email' = email	
	";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
       	// Get the information from the result set
		$row = mysql_fetch_array($result);
    	return $row['admin'];
    }
    die;
}

function do_get_ban_status($email){
	$sql = "
		   SELECT authorized
		   FROM `user`
		   WHERE '$email' = email	
		";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		return NULL;
	}
	else{
       	// Get the information from the result set
		$row = mysql_fetch_array($result);
    	return $row['admin'];
    }
    die;
}

?>