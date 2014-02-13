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
				   		header('Location: http://www.waggle.myskiprofile.com/index.php');
			        		exit();
			        }
		        	else{
			   			echo "File could not be deleleted";
			   		}
        	}
	        else{
		   			echo "So not File. Much problem.";
		   	}
		}
	   	else{
	   			echo "U no have Acess!!!!!";
	   		

	
	   	
	   }
}
else{
	echo "NO FILE!!!!!!!!!!";


	 
	 } 

