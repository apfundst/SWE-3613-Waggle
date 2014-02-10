<?php
session_start();
ob_start();
include_once('connection.php');
include_once('other_funcs.php')

if($_POST['file_path']){
	$path = $_POST['file_path'];

	if (is_file($path)){
	   if(unlink($path)){
	   	do_remove_file($_SESSION['email'], $path);
	   }else{
	   	echo "File could not be deleleted";
	   }

	  }
}