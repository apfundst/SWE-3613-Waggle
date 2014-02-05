<?php 
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}else{
if($_POST['thread_id']){

$thread_id = $_POST["thread_id"];
$_SESSION['current_thread_id'] = $thread_id;
$thread = do_get_messages($thread_id);
if(is_null($thread)){
  $messages_html = 'No Posts Yet';
}
else{
$messages_html = '';
foreach ($thread as $value) {
  $messages_html .= '<li id="threadItem">' . $value['3'] . '<br><br>';
  $messages_html .= '<span class="postInfo">' . $value['2'] . ' -- ' . $value['4'];
  $messages_html .= '</span></li>';
 
}
}
}
elseif(isset($_SESSION['current_thread_id']))
{
  $thread_id = $_SESSION['current_thread_id'];
 
  $thread = do_get_messages($thread_id);
  if(is_null($thread)){
    $messages_html = 'No Posts Yet';
  }
  else{
    $messages_html = '';
    foreach ($thread as $value) {
      $messages_html .= '<li id="threadItem">' . $value['3'] . '<br><br>';
      $messages_html .= '<span class="postInfo">' . $value['2'] . ' -- ' . $value['4'];
      $messages_html .= '</span></li>';
     
    }
  }
}
if ($_POST['new_message']) {
  do_post_message($_SESSION['current_thread_id'], $_SESSION["email"], $_POST['new_message']);
  //$current_url = '"http://www.waggle.myskiprofile.com/thread.php?thread_id='.$thread_id.'"';
  header('Location: http://www.waggle.myskiprofile.com/thread.php');
  exit();
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
<!--<div id="header"> header </div>
<div id="left-sidebar"> left-sidebar </div>
<div id="content"> content </div>-->
<div class="container-fluid">
<? if($_SESSION['email'] == 'admin@spsu.edu'){
  include('admin_nav.php');
}else{
  include('nav.php');
}
 ?>

<div class="col-lg-8">
  
  <div class="panel panel-default">
    <div class="panel-heading">Thread Name</div>
    <div class="panel-body">

      <ul >
      <?=$messages_html ?>
      </ul>
      <form method="post" action="thread.php">
      <label>Enter your comments here...</label><br>
        <textarea name="new_message" cols="50" rows="7">
        
        </textarea><br>
        <input type="submit" value="Submit" />
      </form>


  </div>
  </div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading">Disscusion Threads</div>
    <div class="panel-body">

<ul >
    <li id="listItem">item 1</li>
    <li id="listItem">item 2</li>
    <li id="listItem">item 3</li>
    <li id="listItem">item 1</li>
    <li id="listItem">item 2</li>
    <li id="listItem">item 3</li>
  </ul>


 </div>
  </div>
<div class="panel panel-default">
    <div class="panel-heading">User Details</div>
    <div class="panel-body">
    <? 
    echo $_SESSION["first_name"];
      echo $_SESSION["last_name"];
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