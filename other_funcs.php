<?
func do_post_message($thread_id, $creator,$text){
// needs to post message into database
// will require

// message_id, and date_created autogenerate
$sql_insert = "
		 	INSERT INTO message(thread_id,creator,message_text)
		 	VALUES($thread_id,$creator,$text)
	";



}

func do_get_messages(){
// loads messages on to page
// need to pass thread_id from session
$thread_id;

// ordering in ascending order starting
// with oldest at top
$sql_query = "
		   SELECT *
		   FROM group
		   WHERE $thread_id = thread_id
		   ORDER BY date_created  ASC		
";
}


func do_get_groups($email){
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


func do_get_threads($group){
// gets threads from group from db

// get the thread_name from the group table
// where the email matches the email in the membership table
// and the group_id matches the group_id in the group table
$sql_query = "
		   SELECT thread.thread_name 
		   FROM group
		   INNER JOIN membership
		   ON group.group_id = membership.group_id 
		   AND $email = membership.email   
		   ORDER BY group.group_name ASC		
";

}

?>