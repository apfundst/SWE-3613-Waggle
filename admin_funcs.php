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

function do_admin_remove_group(){
	// Removes group from User view
	// Retains group in db for records

}


function do_admin_ban_user_site(){
	// Time based ban

}

function do_admin_ban_group(){
	// Time based ban
}

function do_admin_ban_user_group(){
	// Time based ban
}

function do_admin_remove_file(){
	// Removes file from User view
	// Retains file in db for records

}

function do_admin_remove_message(){
	// Removes message from User view
	// Retains message in db for records
	// Indicates in thread message was banned

}

function do_admin_remove_thread(){
	// Removes thread from User view
	// Retains thread in db for records
}






?>
