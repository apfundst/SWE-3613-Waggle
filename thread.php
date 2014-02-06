<?php 
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"])) {
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}else{
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
  $file_upload_html = '  <div class="panel panel-default">
    <div class="panel-heading">Upload Files to '. $current_group_name .'</div>
    <div class="panel-body"><form action="fileupload.php" method="post"
  enctype="multipart/form-data"><label for="file">Filename:</label>
  <input type="file" name="file" id="file"><br>
  <input type="submit" name="submit" value="Submit">
  
  </form>
    </div>
  </div>';
  $group_setting_html = '  <div class="panel panel-default">
    <div class="panel-heading">Group Settings for '. $current_group_name .'</div>
    <div class="panel-body"><form action="leave_group.php" method="post"
  enctype="multipart/form-data">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Leave Group">
  
  </form>
    </div>
  </div>';
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
    $threads_html .= '<form enctype="multipart/form-data" action="thread.php" method="post">
                        <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
    $threads_html .= $things[3] . '"/></form>';

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
<div class="col-lg-12"><div class="group-name"><h1><?=$current_group_name ?></h1></div></div>
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
    <div class="panel-heading">User Details</div>
    <div class="panel-body">
    <? echo "Name: ";
      $name = do_get_name($_SESSION['email']);
      echo $name;
      
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
<div class="panel-heading">Disscusion Threads for <?=$current_group_name ?></div>
    <div class="panel-body">

<?=$threads_html ?>


 </div>
  </div>

  <?=$file_upload_html ?>
  <?=$group_setting_html ?>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>