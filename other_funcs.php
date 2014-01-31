<?

function do_post_message($thread_id, $creator,$text){
// needs to post message into database
// will require

// message_id, and date_created autogenerate
$sql_insert = "
		 	INSERT INTO message(thread_id,creator,message_text)
		 	VALUES($thread_id,$creator,$text)
	";



}

function do_get_messages($thread_id){
	// loads messages on to page
	// need to pass thread_id from session

	// ordering in ascending order starting
	// with oldest at top
	$sql = "
		   SELECT *
		   FROM message
		   WHERE $thread_id = thread_id
		   ORDER BY date_created  ASC		
	";
	// Run the query
	$result = mysql_query(sql);
	// Give result set back to caller
	return mysql_fetch_assoc($result);
}


function do_get_groups($email){
  $con = mysql_connect("localhost","jsalvo_group8","waggle_password");
  $db = mysql_select_db('jsalvo_waggle');
  if (!$con || !$db ){
    die('Could not connect: ' . mysql_error());
  }
  else{


	// gets groups from db for user

	// get the group_name from the group table
	// where the email matches the email in the membership table
	// and the group_id matches the group_id in the group table
	$sql = "
		   SELECT group.group_name 
		   FROM group
		   INNER JOIN membership
		   ON group.group_id = membership.group_id 
		   AND $email = membership.email   
		   ORDER BY group.group_name ASC		
	";
	$result = mysql_query(sql);
     // Get the information from the result set
    return mysql_fetch_assoc($result);
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
		   FROM thread
		   WHERE $group_id = group_id
		   ORDER BY date_created ASC		
	";
	// Send query to db
	$result = mysql_query(sql);
	// Give result set back to caller
	return mysql_fetch_assoc($result);

}

?>