<?
session_start();
include('other_funcs.php');
$user_status = do_get_ban_status($_SESSION['email']);
if(!isset($_SESSION["email"]))
{
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
elseif($user_status == 0){
  header('Location: http://www.waggle.myskiprofile.com/login.php?err=You%20have%20been%20banned');
  exit();
}
else
{ 
  /*global $current_group_name;

  function populate_group_page($group_id){
    $current_group_id = $group_id;
    $_SESSION['current_group_id'] = $current_group_id;
    $current_group_name = do_get_group_name($current_group_id);
    $group_owner = do_get_creator($current_group_id);
    $_SESSION['current_group_creator'] = $group_owner;
    if($group_owner == $_SESSION['email'] || $_SESSION['is_admin'] == 1){
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
    if($group_owner != $_SESSION['email'] || $_SESSION['is_admin'] != 1){
     $group_setting_html = '<form action="leave_group.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
                          <input type="submit" name="submit" value="Leave Group">
                          </form><p>Group Members:<br>'.$group_member_list.'</p> '.$group_creator_html;
    }
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
      $files_html='';
      foreach($current_files as $files)
      {
        $file_creator = do_get_file_creator($files[2]);
        $files_html .= '<a href="'.$files[2].'" download="'.$files[3].'"id="fileListItem">'.$files[3].' '.$files[4].'   Created by: '.$file_creator.'</a>';
        if($file_creator == $_SESSION['email'] || $_SESSION['email'] == $_SESSION['current_group_creator'] || $_SESSION['is_admin'] == 1){  //add admin to this function checking
           $files_html .= '<form action="delete_file.php" method="post">
                            <input type="hidden" name="file_path" value="'.$files[2].'">
                            <input  class="deleteFile" type="submit" value="Delete File"></form>';
        }
      }
    //files section ends
    }


  }*/

  if($_POST["group_id"]){
    $group_status = do_get_group_ban_status($_POST['group_id']);
    if($group_status == 0){
      header('Location: http://www.waggle.myskiprofile.com/index.php');
      exit();
    }
    else{
      $current_group_id = $_POST['group_id'];
      $_SESSION['current_group_id'] = $current_group_id;
      $current_group_name = do_get_group_name($current_group_id);
      $group_owner = do_get_creator($current_group_id);
      $_SESSION['current_group_creator'] = $group_owner;
      if($group_owner == $_SESSION['email'] || $_SESSION['is_admin'] == 1){
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
       $group_setting_html = '<form action="leave_group.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
                            <input type="submit" name="submit" value="Leave Group">
                            </form><p>Group Members:<br>'.$group_member_list.'</p> '.$group_creator_html;


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
        $files_html='';
        foreach($current_files as $files)
        {
          $file_creator = do_get_file_creator($files[2]);
          $files_html .= '<a href="'.$files[2].'" download="'.$files[3].'"id="fileListItem">'.$files[3].' '.$files[4].'   Created by: '.$file_creator.'</a>';
          if($file_creator == $_SESSION['email'] || $_SESSION['email'] == $_SESSION['current_group_creator'] || $_SESSION['is_admin'] == 1){  //add admin to this function checking
             $files_html .= '<form action="delete_file.php" method="post">
                              <input type="hidden" name="file_path" value="'.$files[2].'">
                              <input  class="deleteFile" type="submit" value="Delete File"></form>';
          }
        }
      //files section ends
      }
    }
  }
  else{
    $group_status = do_get_group_ban_status($_SESSION['current_group_id']);
    if($group_status == 0){
      header('Location: http://www.waggle.myskiprofile.com/index.php');
      exit();
    }else{
      $current_group_id = $_SESSION['current_group_id'];
      //$_SESSION['current_group_id'] = $current_group_id;
      $current_group_name = do_get_group_name($current_group_id);
      $group_owner = do_get_creator($current_group_id);
      $_SESSION['current_group_creator'] = $group_owner;
      if($group_owner == $_SESSION['email'] || $_SESSION['is_admin'] == 1){
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
       $group_setting_html = '<form action="leave_group.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="group_id" value="'. $_SESSION['current_group_id'] . '">
                            <input type="submit" name="submit" value="Leave Group">
                            </form><p>Group Members:<br>'.$group_member_list.'</p> '.$group_creator_html;


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
        $files_html='';
        foreach($current_files as $files)
        {
          $file_creator = do_get_file_creator($files[2]);
          $files_html .= '<a href="'.$files[2].'" download="'.$files[3].'"id="fileListItem">'.$files[3].' '.$files[4].'   Created by: '.$file_creator.'</a>';
          if($file_creator == $_SESSION['email'] || $_SESSION['email'] == $_SESSION['current_group_creator'] || $_SESSION['is_admin'] == 1){  //add admin to this function checking
             $files_html .= '<form action="delete_file.php" method="post">
                              <input type="hidden" name="file_path" value="'.$files[2].'">
                              <input  class="deleteFile" type="submit" value="Delete File"></form>';
          }
        }
      //files section ends
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
  <!-- Take $Get group id-->

<? 
if($_SESSION["is_admin"] == 1){
  include('admin_nav.php');
}
else{ 
  include('nav.php'); 
} 
?>
<div class="col-lg-12"><div class="group-name"><h1><?=$current_group_name?> </h1>
<div class="groupDesc"><?=do_get_group_description($_SESSION['current_group_id']) ?></div>
</div></div>
<div class="row">
<div class="col-lg-4">
  
  <div class="panel panel-default">
    <div class="panel-heading">Files</div>
    <div class="panel-body">
    <?=$files_html; ?>
    <form action="fileupload.php" method="post" enctype="multipart/form-data"><label for="file">Filename:</label>
      <input type="file" name="file" id="file"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
    </div>
  </div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
    <div class="panel-heading">Disscusion Threads<div style="
    float:right;
    display: inline;
    border: 1px solid #ddd;
    background-color: #ecf0f1;
    padding: 3px;
    color:white;
    margin-right: 20px;
    font-size: 15px; "><a href="new_thread.php">Create New Thread</a></div></div>
    <div class="panel-body">
    <?=$threads_html; ?>
   
    </div>
  </div>

<div>linkware: <a style="color:white;" href="http://www.visualpharm.com">here</a>
</div>
</div>
<div class="col-lg-4">
<div class="panel panel-default">
    <div class="panel-heading">Group Information</div>
    <div class="panel-body">
   <?=$group_setting_html;?>
    </div>
  </div>

<div>linkware: <a style="color:white;" href="http://www.visualpharm.com">here</a>
</div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>



