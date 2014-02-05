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

}

function do_admin_remove_post(){

}

function do_admin_remove_thread(){

}






?>
