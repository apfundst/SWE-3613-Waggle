<?php
session_start();
include 'admin_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
if($_POST['message_id'] && $_POST['new_text']){
	$return_bool = do_edit_message($_POST['message_id'], $_POST['new_text']);
	if($return_bool == TRUE){
		header('Location: http://www.waggle.myskiprofile.com/thread.php');
  exit();
	}
	else{
		header('Location: http://www.waggle.myskiprofile.com/error/error.php?err=Message%20could%20be%20edited');
  exit();
	}
}
}

?>