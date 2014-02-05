<?php
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}else{
if($_POST['group_id']){
	$return_bool = do_leave_group($_SESSION['email'], $_POST['group_id']);
	if($return_bool == TRUE){
		header('Location: http://www.waggle.myskiprofile.com/index.php');
  exit();
	}
	else{
		echo "mucho errors. Please contact the web admin!";
	}


}
}
?>