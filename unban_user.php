<?php
session_start();
include 'admin_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
if($_POST['member_email']){
	$return_bool = do_admin_unban_user($_POST['member_email']);
	if($return_bool == TRUE){
		header('Location: http://www.waggle.myskiprofile.com/admin.php');
  exit();
	}
	else{
		echo "mucho errors. Please contact the web admin!";
	}
}
}

?>