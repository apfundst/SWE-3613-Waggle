<?php
session_start();
include 'admin_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
	if($_POST['group_id']){
		$return_bool = do_admin_ban_group($_POST['group_id']);
		if($return_bool == TRUE){
			header('Location: http://www.waggle.myskiprofile.com/admin.php');
 			 exit();
		}
		else{
			echo "Errors encountered! Please contact the web admin!";
		}
	}
}



?>