<?php
session_start();
include('other_funcs.php');

if(!isset($_SESSION["email"])) {	
	header('Location: http://www.waggle.myskiprofile.com/login.php');
	exit();
}
else{
	if($_POST['new_message']){
			$return_bool = do_edit_message($_SESSION['message_id'], $_POST['new_message']);
		if($return_bool == TRUE){
			header('Location: http://www.waggle.myskiprofile.com/thread.php');
  			exit();
		}
		else{
			header('Location: http://www.waggle.myskiprofile.com/error/error.php?err=Message%20could%20be%20edited');
  			exit();
		}
	}
	else{
		$_SESSION["message_id"] = $_POST["message_id"];
		$old_text = $_POST["message_text"];
	}
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waggle | Student Solution</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
  <body>
  <!-- Create Logo at the top of the screen -->
  <!--Black bar at the top of the screen.-->
    <div class="navbar">
      <img class="logoImg"src="LOGIN/LOGOWAGGLEv4.2.png" height="75">
    </div>
  <!-- Creates a new row to use -->
      <!--Log in bar-->
     <div class="col-lg-4">
        <div class="panel">
          <center>
            <div class="panel-heading">Message</div>
          </center>
            <div class="panel-body">
            <center>
             	    <form method="post" action="thread.php">
     				<label>Edit your original message</label><br>
        			<textarea name="new_message" cols="50" rows="7"><?=$old_text?>
        			</textarea><br>
      				</form>
                	<a href = "http://www.waggle.myskiprofile.com/thread.php">
                	<input type="button" value= "Submit Changes"></a><br>
          </center>
          </div>
          </div>
        </div>
  </body>
</html>


