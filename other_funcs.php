<?
include_once('connection.php');

function do_post_message($thread_id, $creator,$text){
// needs to post message into database
// will require

// message_id, and date_created autogenerate
$sql = "
		 	INSERT INTO `message`(`thread_id`,`creator`,`message_text`)
		 	VALUES('$thread_id','$creator','$text')
	";

	$result = mysql_query($sql);
	if (!$result) {
		mysql_query('ROLLBACK');
		die("Invalid query: " .mysql_error());
	}
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

function do_create_membership($email, $group_id){
	// Will create a membership for a user if that user
	// does not already belong to group
	$sql = "
		INSERT INTO `group`(`creator`,`group_name`,`group_description`)
		VALUES('$email','$group_name','$group_description')	
	";






}


function do_create_group($email, $group_name, $group_description){
	// WIll insert into database but kick out an insert
	// that has a group name that already exists in db
	// NOTE: WILL NEED TO CHECK IF QUERY FAILS OR IF
	// THE CONNECTION TO DB WAS UNSUCCESSFUL

	// NINJA EDIT: 3 Feb 2014 23:29 made 
	//			   group_name unique


	$sql_check = "
			SELECT * 
			FROM `group` 
			WHERE '$group_name'= group_name
	";
	$check_result = mysql_query($sql_check);
	if(!$check_result){
		return false;
	}
	else {
		$sql = "
		    INSERT INTO `group`(`creator`,`group_name`,`group_description`)
		 	VALUES('$email','$group_name','$group_description')
		";
		$result = mysql_query($sql);
		if(!$result){
			return false;
		}
		else{
			return true;
		}

    }
}


function do_get_groups($email){
		// gets groups from db for user
		// get the group_name from the group table
		// where the email matches the email in the membership table
		// and the group_id matches the group_id in the group table

		$sql = "
		   	SELECT group.group_id, group.group_name 
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
     			while($row = mysql_fetch_assoc($result)){
     				$data[$row['group_id']] = "{$row[group_name]}";
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
    	



?>