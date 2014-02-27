<?php
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
	if($_POST['group_id'] && $_POST['member_email'] && !empty($_POST['member_email']) ) {
		$return_bool = do_create_membership($_POST['member_email'], $_POST['group_id']);
		if($return_bool == TRUE){
			header('Location: http://www.waggle.myskiprofile.com/group.php');
  			exit();
		}
		else{
			header('Location: http://www.waggle.myskiprofile.com/error/error.php?err=Member%20Not%20Added%20Invalid%20Email');
			exit(); 
		}
	}
	else{
		header('Location: http://www.waggle.myskiprofile.com/error/error.php?err=Member%20Not%20Added%20Invalid%20Email');
		exit(); 
	}
}
?>