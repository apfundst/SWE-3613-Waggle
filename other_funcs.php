<?
func do_post_message(){
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
		   FROM messages
		   WHERE $thread_id = thread_id
		   ORDER BY date_created  ASC		
";




}




?>