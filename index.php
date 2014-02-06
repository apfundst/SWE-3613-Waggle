<?
session_start();
include 'other_funcs.php';
if(!isset($_SESSION["email"]))
{
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else
{
  $_SESSION['current_group_id'] = '';
  $threads_html = 'Select a Group!';
 $file_upload_html = '';
 $group_setting_html ='';
 $files_html = '';
  $groups = do_get_groups($_SESSION["email"]);
if(is_null($groups))
{
  $groups_html = 'You are not in any groups yet!';
}
else{
$groups_html = '';
foreach ($groups as $things) {
  
  $groups_html .= '<form enctype="multipart/form-data" action="index.php" method="post">
                        <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
    $groups_html .= $things[1] . '          --       '. $things[2].'"/></form>';
  
 
}

 /*$threads_html = 'Select a Group!';
 $file_upload_html = '';
 $group_setting_html ='';*/
 $create_thread_button_html ='';
 $group_creator_html = '';
 $group_member_list = '';
if($_POST["group_id"]){
  $current_group_id = $_POST["group_id"];
  $_SESSION['current_group_id'] = $current_group_id;
  $current_group_name = do_get_group_name($current_group_id);
  $group_owner = do_get_creator($current_group_id);
  if($group_owner == $_SESSION['email']){
    $group_creator_html = '<br><p>Add Group Members:</p><form action="add_member.php" method="post"
  enctype="multipart/form-data">
  <input type="text" name="member_email" maxlength="20">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Add Member to Group">
  
  </form>';

  }

  
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
  
  </form>'.$group_creator_html.'
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
  //start threads
  $current_threads = do_get_threads($current_group_id);
  if (is_null($current_threads)){
    $threads_html = 'No Threads in this group Yet!';
  }
  else{
  $threads_html = '';

  foreach($current_threads as $things)
  {
    $threads_html .= '<form enctype="multipart/form-data" action="thread.php" method="post">
                        <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
    $threads_html .= $things[3] . '"/></form>';

  }
  //end threads

  //begin files
  $current_files = do_get_file($current_group_id);
  if (is_null($current_files))
  {
    $files_html = 'No files have been uploaded yet!';
  }
  else
  {
  $files_html = '';

  foreach($current_files as $files)
  {
    //TO DO: html for andrew
    $files_html .= '<a href="'.$files[2].'"'
    

  }
  //files section ends
}

}
elseif($_SESSION['current_group_id']){

    $current_group_id = $_SESSION['current_group_id'];
  $current_group_name = do_get_group_name($current_group_id);

  $current_threads = do_get_threads($current_group_id);
  $group_owner = do_get_creator($current_group_id);
  if($group_owner == $_SESSION['email']){
    $group_creator_html = '<br><p>Add Group Members:</p><form action="add_member.php" method="post"
  enctype="multipart/form-data">
  <input type="text" name="member_email" maxlength="20">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Add Member To Group">
  
  </form>';

  }
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
  
  </form>'.$group_member_list.' '.$group_creator_html.'
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
<? include('nav.php'); ?>
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
    <div class="panel-heading">Disscusion Threads for <?=$current_group_name ?>
    <?=$create_thread_button_html ?></div>
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
<?=$file_upload_html;?>
<?= $group_setting_html; ?>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>
