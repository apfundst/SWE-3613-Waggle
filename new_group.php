<?php
session_start();
ob_start();
$error_message = '';
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else{
if(isset($_POST["group_name"])){
  if(strlen($_POST['group_name']) < 5){
      $error_message = 'Group Name Must be 5 characters Long!';
  }
  elseif(strlen($_POST['group_desc']) < 20)
    {
      $error_message = 'Group Name Must be at least 5 characters long and group descripton must be at least 20 characters long!';
  }
  else{
    $bool = do_create_group($_SESSION["email"], $_POST["group_name"], $_POST["group_desc"]);
    if($bool == TRUE){
      ob_clean();
      header('Location: http://www.waggle.myskiprofile.com/index.php');
      exit();

    }
    elseif($bool == FALSE){
      $error_message = 'Name already taken, Try again!';
    }
    else{
      $error_message = 'else block';
    }
  }
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waggle | Student Solution</title>
<link rel="stylesheet" type="text/css" href="css.css">
</head>

 
<body>
<!--<div id="header"> header </div>
<div id="left-sidebar"> left-sidebar </div>
<div id="content"> content </div>-->
<div class="container-fluid">
<? if($_SESSION['email'] == 'admin@spsu.edu'){
  include('admin_nav.php');
}
else{
  include('nav.php');
}
?>
<div class="col-lg-8">
  <div class="panel panel-default">
    <div class="panel-heading">Create Group</div>
    <div class="panel-body">

      <center>
        <p><? echo $error_message; ?></p>
        <form action="new_group.php" method="post"enctype="multipart/form-data">
        <label for="group_name">Group Name:</label>
        <input type="text" name="group_name" for="group_name" maxlength="50"><br>
        <label for="group_desc">Group Description:</label>
       <textarea name="group_desc" cols="50" rows="7">
        
        </textarea><br>
        <input type="submit" name="submit" value="Create Group">
        <a href="/index.php">
        <input type="button" value="Cancel"/></a>
        </form>
      </center>
 </div>
  </div>
  </div>
  
<div class="col-lg-4">
<div class="panel panel-default">
    <div class="panel-heading">User Details</div>
    <div class="panel-body">
   <? 
      echo "Name: ";
      echo $_SESSION["first_name"] ;
      echo " ";
      echo $_SESSION["last_name"] ;
      echo "<br> ";
      echo "Email: ".$_SESSION["email"];
      //echo $_SESSION['current_group_id'];
      /*echo count($groups);
      echo count($current_threads);
      echo("<script>console.log('PHP: ". json_encode($groups)."');</script>");
      echo("<script>console.log('PHP: ". json_encode($current_threads)."');</script>");*/
       ?>
    </div>
  </div>
  
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>