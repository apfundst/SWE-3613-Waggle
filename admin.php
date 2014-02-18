<?
session_start();
include 'other_funcs.php';
include 'admin_funcs.php';
if(!isset($_SESSION["email"]))
{
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
else
{
  $_SESSION['current_group_id'] = '';
  $groups = do_admin_get_groups();
  if(is_null($groups)){
    $groups_html = 'No groups exist yet!';
  }
  else{
    $groups_html = '';
    foreach ($groups as $things) {
      $groups_html .= '<form enctype="multipart/form-data" action="admin.php" method="post">
                        <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
      $groups_html .= $things[1] . '          --       '. $things[2].'"/></form>';
    }
  }
  $threads_html = 'Select a Group!';
  $group_setting_html ='';
  if(isset($_POST["group_id"])){
    $current_group_id = $_POST["group_id"];
    $_SESSION['current_group_id'] = $current_group_id;
    $current_group_name = do_get_group_name($current_group_id);

    $current_threads = do_get_threads($current_group_id);
    if (is_null($current_threads)){
      $threads_html = 'No Threads in this group Yet!';
    }
    else{
      $threads_html = '';

      foreach($current_threads as $things){
        $threads_html .= '<form enctype="multipart/form-data" action="thread.php" method="post">
                          <input type="hidden" name="thread_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
        $threads_html .= $things[3] . '"/></form>';
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
<? include('admin_nav.php'); ?>

<div class="col-lg-12"><div class="group-name"><h1>Admin Panel </h1>
</div>

<div class="container-fluid">
<div class="row">
<div class="col-lg-4">
<div class="panel panel-default">
    <div class="panel-heading">Ban Users/Unban Users</div>
    <div class="panel-body">
          <br><p>Ban Users:</p>
          <form action="ban_user.php" method="post" enctype="multipart/form-data">
                <input type="text" name="member_email" maxlength="20">
                <input type="submit" name="submit" value="Ban User">
                
          </form>

          <br><p>Un-Ban Users:</p>
          <form action="unban_user.php" method="post" enctype="multipart/form-data">
                <input type="text" name="member_email" maxlength="20">
                <input type="submit" name="submit" value="Un-Ban User">
                
          </form>
    </div>
</div>
</div>

<div class="col-lg-4">
  <div class="panel panel-default">
    <div class="panel-heading">All Groups
    <div class="panel-body">
    <ul >
    <?=$groups_html ?>
    </ul>

    </div>
    </div> 
    </div>
</div>

<div class="col-lg-4">
<div class="panel panel-default">
    <div class="panel-heading">Ban Groups/Unban Groups</div>
    <div class="panel-body">
      <!-- have a list of groups, check boxes, delete selected button -->
          <br><p>Ban Groups:</p>
          <form action="ban_group.php" method="post" enctype="multipart/form-data">
                <input type="text" name="member_email" maxlength="20">
                <input type="submit" name="submit" value="Ban Group">   
          </form>

          <br><p>Un-Ban Groups:</p>
          <form action="unban_group.php" method="post" enctype="multipart/form-data">
                <input type="text" name="member_email" maxlength="20">
                <input type="submit" name="submit" value="Un-Ban Group">     
          </form>
    </div>
</div>
</div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>
