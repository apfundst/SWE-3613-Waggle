<?
ob_start();
session_start();
include('other_funcs.php');
include('nav.php');

if(!isset($_SESSION["email"])) {	
	header('Location: http://www.waggle.myskiprofile.com/login.php');
	exit();
}
else{
	if($_POST['new_message']){
			$return_bool = do_edit_message($_SESSION['message_id'], $_POST['new_message']);
		if($return_bool == 1){
			header('Location: http://www.waggle.myskiprofile.com/thread.php');
  			exit();
		}
		else{
			header('Location: http://www.waggle.myskiprofile.com/index.php');
  			exit();
		}
	}
}

$_SESSION["message_id"] = $_POST["message_id"];
$old_text = strip_tags($_POST["message_text"]);
$old_text = trim($old_text, "");
ob_flush();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waggle | Student Solution</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
  <body>
     <div class="col-lg-6">
        <div class="panel">
          <center>
            <div class="panel-heading">Edit Message</div>
          </center>
            <div class="panel-body">

             	    <form method="post" action="edit_message.php">
     				<label>Edit your original message</label><br>
        			<textarea name="new_message" style="width:100%; height:100px;"><?=$old_text?></textarea>
        			<input type="submit" value= "Submit Changes"/><a href="/thread.php"><input type="button" value= "Cancel"/></a><br>
                	</form>

          </div>
          </div>
        </div>
  </body>
</html>


