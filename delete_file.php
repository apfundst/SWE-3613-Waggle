<?php
session_start();
ob_start();
include_once('connection.php');
include_once('other_funcs.php');

if($_POST['file_path']){
	$path = $_POST['file_path'];
	$return = do_remove_file($_SESSION['email'], $path);
	   	if($return == TRUE)
	   	{
	   		if (is_file($path)){
	   				if(unlink($path)){
				   		header('Location: http://www.waggle.myskiprofile.com/group.php');
			        		exit();
			        }
		        	else{
			   			header('http://www.waggle.myskiprofile.com/error/error.php?err=File%20could%20not%20be%20deleleted');
			exit(); 
			   		}
        	}
	        else{
		   			header('http://www.waggle.myskiprofile.com/error/error.php?err=So%20not%20File.%20Much%20problem');
			exit();  
		   	}
		}
	   	else{
	   			header('http://www.waggle.myskiprofile.com/error/error.php?err=YOU%20Don`t%20have%20Access');
			exit();   "U no have Acess!!!!!";
	   			echo $path;
	   		

	
	   	
	   }
}
else{
	echo "NO FILE!!!!!!!!!!";
	header('Location: http://www.waggle.myskiprofile.com/group.php');
			        		exit();


	 
	 } 

