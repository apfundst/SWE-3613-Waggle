<?
session_start();
include('other_funcs.php');
if(!isset($_SESSION["email"]))
{
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else
{ 
  $_SESSION['is_admin'] = user_is_admin($_SESSION["email"]);
  $_SESSION['current_group_id'] = '';
  $threads_html = 'Select a Group!';
 

 //if statement to check if admin
 //if admin call $groups = do_admin_get_groups();

$groups = do_get_groups($_SESSION["email"]);
  //endif
if(is_null($groups))
{
  $groups_html = 'You are not in any groups yet!';
}
else{
$groups_html = '';
foreach ($groups as $things) {
  $name = do_get_name($things[2]);
  
  $groups_html .= '<form enctype="multipart/form-data" action="group.php" method="post">
                        <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
    $groups_html .= $things[1] . '          --     Created by:  '. $name.'"/></form>';
  
 
}


 
/*if($_POST["group_id"]){
  $current_group_id = $_POST["group_id"];
  $_SESSION['current_group_id'] = $current_group_id;
  $current_group_name = do_get_group_name($current_group_id);
  $group_owner = do_get_creator($current_group_id);
  $_SESSION['current_group_creator'] = $group_owner;
  if($group_owner == $_SESSION['email']){
    $group_creator_html = '<br><p>Add Group Members:</p><form action="add_member.php" method="post"
  enctype="multipart/form-data">
  <input type="text" name="member_email" maxlength="20">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Add Member to Group">
  
  </form>';

  }

  
  
  $members = do_get_group_members($current_group_id);
  
  foreach ($members as $yolo) {
    $name = do_get_name($yolo[0]);
    $group_member_list .= $name . '<br>';
  }
  $group_setting_html = '  <div class="panel panel-default">
    <div class="panel-heading">Group Settings for '. $current_group_name .'</div>
    <div class="panel-body"><form action="leave_group.php" method="post"
  enctype="multipart/form-data">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Leave Group">
  
  </form><p>Group Members:<br>'.$group_member_list.'</p> '.$group_creator_html.'
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
                        <input type="hidden" name="thread_id" value="'. $things[0] . '">
                        <input type="submit" name="submit" id="input_a" value="';
    $threads_html .= $things[3] . '"/></form>';

  }
}
  //end threads

  //begin files
  $current_files = do_get_files($current_group_id);
  if (is_null($current_files))
  {
    $files_html = 'No files have been uploaded yet!';
  }
  else
  {
  

  foreach($current_files as $files)
  {
    $file_creator = do_get_file_creator($files[2]);
    $files_html .= '<a href="'.$files[2].'" download="'.$files[3].'"id="fileListItem">'.$files[3].' '.$files[4].'   Created by: '.$file_creator.'</a>';
    if($file_creator == $_SESSION['email'] || $_SESSION['email'] == $_SESSION['current_group_creator']){  //add admin to this function checking
       $files_html .= '<form action="delete_file.php" method="post">
      <input type="hidden" name="file_path" value="'.$files[2].'">
      <input  class="deleteFile" type="submit" value="Delete File"></form>';
    }
    
    

  }
  
  //files section ends
}
$file_upload_html = '  <div class="panel panel-default">
    <div class="panel-heading">Upload Files to '. $current_group_name .'</div>
    <div class="panel-body">'.$files_html.'<form action="fileupload.php" method="post"
  enctype="multipart/form-data"><label for="file">Filename:</label>
  <input type="file" name="file" id="file"><br>
  <input type="submit" name="submit" value="Submit">
  
  </form>
    </div>
  </div>';

}*/

/*elseif($_SESSION['current_group_id'] != NULL){

    $current_group_id = $_SESSION['current_group_id'];
  $current_group_name = do_get_group_name($current_group_id);

  
  $group_owner = do_get_creator($current_group_id);

 
  
  $current_group_name = do_get_group_name($current_group_id);
  $group_owner = do_get_creator($current_group_id);
  $_SESSION['current_group_creator'] = $group_owner;
  if($group_owner == $_SESSION['email']){
    $group_creator_html = '<br><p>Add Group Members:</p><form action="add_member.php" method="post"
  enctype="multipart/form-data">
  <input type="text" name="member_email" maxlength="20">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Add Member to Group">
  
  </form>';

  }

  
  
  $members = do_get_group_members($current_group_id);
  
  foreach ($members as $yolo) {
    $name = do_get_name($yolo[0]);
    $group_member_list .= $name . '<br>';
  }
  $group_setting_html = '  <div class="panel panel-default">
    <div class="panel-heading">Group Settings for '. $current_group_name .'</div>
    <div class="panel-body"><form action="leave_group.php" method="post"
  enctype="multipart/form-data">
  <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
  <input type="submit" name="submit" value="Leave Group">
  
  </form><p>Group Members:<br>'.$group_member_list.'</p> '.$group_creator_html.'
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
                        <input type="hidden" name="thread_id" value="'. $things[0] . '">
                        <input type="submit" name="submit" id="input_a" value="';
    $threads_html .= $things[3] . '"/></form>';

  }
}
  //end threads

  //begin files
  $current_files = do_get_files($current_group_id);
  if (is_null($current_files))
  {
    $files_html = 'No files have been uploaded yet!';
  }
  else
  {
  

  foreach($current_files as $files)
  {
    $file_creator = do_get_file_creator($files[2]);
    $files_html .= '<a href="'.$files[2].'" download="'.$files[3].'"id="fileListItem">'.$files[3].' '.$files[4].'   Created by: '.$file_creator.'</a>';
    if($file_creator == $_SESSION['email'] || $_SESSION['email'] == $_SESSION['current_group_creator']){  //add admin to this function checking
       $files_html .= '<form action="delete_file.php" method="post">
      <input type="hidden" name="file_path" value="'.$files[2].'">
      <input  class="deleteFile" type="submit" value="Delete File"></form>';
    }
    
    

  }
  
  //files section ends
}
$file_upload_html = '  <div class="panel panel-default">
    <div class="panel-heading">Upload Files to '. $current_group_name .'</div>
    <div class="panel-body">'.$files_html.'<form action="fileupload.php" method="post"
  enctype="multipart/form-data"><label for="file">Filename:</label>
  <input type="file" name="file" id="file"><br>
  <input type="submit" name="submit" value="Submit">
  
  </form>
    </div>
  </div>';

}**********Not Working like it should**********/ 

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
<?
if($_SESSION["is_admin"] == 1){
  include('admin_nav.php');
}
else{ 
  include('nav.php'); 
}
?>

<div class="col-lg-12">
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
  
</div>
<div class="col-lg-4">
<!--<div class="panel panel-default">
    <div class="panel-heading">User Details</div>
    <div class="panel-body">
   <? echo "Name: ";
      $name = do_get_name($_SESSION['email']);
      echo $name;
      echo '<script>console.log('.json_encode($members).');</script>';
      
      echo "<br> ";
      echo "Email: ".$_SESSION["email"];
      /*echo count($groups);
      echo count($current_threads);
      echo("<script>console.log('PHP: ". json_encode($groups)."');</script>");
      echo("<script>console.log('PHP: ". json_encode($current_threads)."');</script>");*/
       ?>
    </div>-->
  </div>
<div style="color:#f8f8f8">linkware: <a href="http://www.visualpharm.com">here</a>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>