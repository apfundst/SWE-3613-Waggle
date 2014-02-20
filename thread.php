<?php 
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}else{
  $thread_id= '';
  $current_group_name = '';
if($_POST['thread_id']){
$current_group_name = do_get_group_name($_SESSION['current_group_id']);
$thread_id = $_POST["thread_id"];
$_SESSION['current_thread_id'] = $thread_id;
$thread_name = do_get_thread_subject($_SESSION['current_thread_id']);
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
  $current_group_name = do_get_group_name($_SESSION['current_group_id']);
  $thread_id = $_SESSION['current_thread_id'];
  $thread_name = do_get_thread_subject($_SESSION['current_thread_id']);
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
if($_SESSION['current_group_id']){

    $current_group_id = $_SESSION['current_group_id'];
  $current_group_name = do_get_group_name($current_group_id);

  $current_threads = do_get_threads($current_group_id);
  $members = do_get_group_members($current_group_id);
  
    foreach ($members as $yolo) {
      $name = do_get_name($yolo[0]);
      $group_member_list .= $name . '<br>';
    }
  
  $create_thread_button_html ='<div style="
    float:right;
    display: inline;
    border: 1px solid #ddd;
    background-color: #ecf0f1;
    padding: 3px;
    color:white;
    margin-right: 20px;
    font-size: 15px; "><a href="new_thread.php">Create New Thread</a></div>';
  if (is_null($current_threads)){
    $threads_html = 'No Threads in this group Yet!<br>';
    //echo $_SESSION['current_group_id'];
  }
  else{
  $threads_html = '';

  foreach($current_threads as $things)
  {
    if($things[0] == $thread_id ){
      $threads_html .= '<form enctype="multipart/form-data" action="thread.php" method="post">
                          <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a_active" value="';
      $threads_html .= $things[3] . '"/></form>';

    }else{
      $threads_html .= '<form enctype="multipart/form-data" action="thread.php" method="post">
                          <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
      $threads_html .= $things[3] . '"/></form>';
    }

  }
  

}

}

if ($_POST['new_message']) {
  $trimmed = trim($_POST['new_message']);
  if(empty($trimmed))
  {
    // Its empty so throw a validation error
    //DO NOTHING Maybe
    //echo 'dope_sauce';
  }
  else{
    do_post_message($_SESSION['current_thread_id'], $_SESSION["email"], $_POST['new_message']);
    //$current_url = '"http://www.waggle.myskiprofile.com/thread.php?thread_id='.$thread_id.'"';
    header('Location: http://www.waggle.myskiprofile.com/thread.php');
    exit();
  }
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
}
else{
  include('nav.php');
}
?>
<div class="col-lg-12"><div class="group-name"><h1><a href="group.php"><?=$current_group_name ?></a></h1></div></div>
<div class="col-lg-8">
  
  <div class="panel panel-default">
    <div class="panel-heading">Thread: <?=$thread_name;?></div>
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
<div class="panel-heading">Disscusion Threads for <?=$current_group_name ?></div>
    <div class="panel-body">

<?=$threads_html ?>


 </div>
  </div>
<div class="panel panel-default">
<div class="panel-heading">Group Members</div>
    <div class="panel-body">

<?=$group_member_list ?>


 </div>
  </div>
  
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>