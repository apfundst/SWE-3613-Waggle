<?php
session_start();
include 'admin_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
	if($_POST['thread_id']){
		$return_bool = do_admin_remove_thread($_POST['thread_id']);
		if($return_bool == TRUE){
			header('Location: http://www.waggle.myskiprofile.com/group.php');
  			exit();
		}
		else{
			header('http://www.waggle.myskiprofile.com/error/error.php?err=Thread%20could%20not%20be%20deleted');
			exit();
		}
	}
}
?>