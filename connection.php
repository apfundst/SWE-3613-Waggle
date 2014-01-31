<?
 	$con = mysql_connect("localhost","jsalvo_group8","waggle_password");
  	$db = mysql_select_db('jsalvo_waggle');
  	if (!$con || !$db ){
    	die('Could not connect: ' . mysql_error());
  	}
?>