<?
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}else{
$_SESSION['current_group_id'] = '';
$groups = do_get_groups($_SESSION["email"]);
if(is_null($groups)){
  $groups_html = 'You are not in any groups yet!';
}
else{
$groups_html = '';
foreach ($groups as $key => $value) {
  
  $groups_html .= '<form enctype="multipart/form-data" action="index.php" method="post">
                        <input type="hidden" name="group_id" value="'. $key . '"><input type="submit" name="submit" id="input_a" value="';
  
    $groups_html .= $value . '"/></form>';
  
 
}
}
 $threads_html = 'Select a Group!';
if(isset($_POST["group_id"])){
  $current_group_id = $_POST["group_id"];
  $_SESSION['current_group_id'] = $current_group_id;
  $current_group_name = do_get_group_name($current_group_id);

  $current_threads = do_get_threads($current_group_id);
  $threads_html = '';

  foreach($current_threads as $things){
    $threads_html .= '<a href="http://www.waggle.myskiprofile.com/thread.php?thread_id='. $things[0];
    $threads_html .= '"><li id="listItem">'. $things[3] . '<span class="postInfo">';
    $threads_html .= $things[2] . ' - '. $things[4]. '</li></a>';


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
<nav class="navbar-default navbar" role="navigation">
<img class="logoImg"src="LOGOWAGGLEv2.3.png" height="60">

<div style="float: right;">
  <ul>
    
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</div>
</nav>
<div class="col-lg-8">
  <div class="panel panel-default">
    <div class="panel-heading">Groups<div style="
    float:right;
    display: inline;
    border: 1px solid #ddd;
    background-color: #ecf0f1;
    padding: 3px;
    color:white;
    margin-right: 20px;
    font-size: 15px; "><a href="new_group.php">Create New Group</a></div></div>
    <div class="panel-body">

<ul >
   <?=$groups_html ?>
  </ul>

 </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">Disscusion Threads for <?=$current_group_name ?></div>
    <div class="panel-body">

<ul >
    <?=$threads_html ?>
  </ul>
</form>

 </div>
  </div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
    <div class="panel-heading">User Details</div>
    <div class="panel-body">
   <? echo "Name: ";
      echo $_SESSION["first_name"] ;
      echo " ";
      echo $_SESSION["last_name"] ;
      echo "<br> ";
      echo "Email: ".$_SESSION["email"];
      /*echo count($groups);
      echo count($current_threads);
      echo("<script>console.log('PHP: ". json_encode($groups)."');</script>");
      echo("<script>console.log('PHP: ". json_encode($current_threads)."');</script>");*/
       ?>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">Group memebers</div>
    <div class="panel-body"><form action="fileupload.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>
    </div>
  </div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>
