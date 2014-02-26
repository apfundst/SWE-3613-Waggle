<?
session_start();
include 'other_funcs.php';
include 'admin_funcs.php';
if(!isset($_SESSION["email"]))
{
  header('Location: http://www.waggle.myskiprofile.com/login.php');
  exit();
}
elseif ($_SESSION["is_admin"] != 1) {
  header('Location: http://www.waggle.myskiprofile.com/index.php');
  exit();
}
else
{
/*
  $_SESSION['current_group_id'] = '';
  $groups = do_admin_get_groups();
  if(is_null($groups)){
    $groups_html = 'No groups exist yet!';
  }
  else{
    $groups_html = '';
    foreach ($groups as $things) {
      $groups_html .= '<form enctype="multipart/form-data" action="group.php" method="post">
                        <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="input_a" value="';
      $groups_html .= $things[1] . '          --       '. $things[2].'"/></form>';
    }
  }
  */
    $groups = do_admin_get_groups();
    if(is_null($groups))
    {
        $groups_html = 'No groups exist yet!';
    } 
    else
    {
        $groups_html = '';
        $bgroups_html = '';
        foreach($groups as $things)
        {
            $group_status = do_get_group_ban_status($things[0]);
            if($group_status == 1)
            {
                $name = do_get_name($things[2]);
                $group_creator = do_get_creator($things[0]);
                $group_authorized = 'Unbanned';

                $groups_html .= '<tr class="tr_clickable" id="goups_background"><td id="main_data">';
                $groups_html .= '<form enctype="multipart/form-data" action="group.php" method="post">
                            <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="table_contents" value="';
                $groups_html .= $things[1] . '"/></form></td><td id="side_data_s">'.$group_creator.'</td><td id="side_data_s">'.$group_authorized.'</td><td id="side_data_s">'.'</tr>';
            }
            elseif ($group_status == 0) 
            {            
                $name = do_get_name($things[2]);
                $group_creator = do_get_creator($things[0]);
                $group_authorized = 'Banned';

                $bgroups_html .= '<tr class="tr_clickable" id="goups_background"><td id="main_data">';
                $bgroups_html .= '<form enctype="multipart/form-data" action="group.php" method="post">
                            <input type="hidden" name="group_id" value="'. $things[0] . '"><input type="submit" name="submit" id="table_contents" value="';
                $bgroups_html .= $things[1] . '"/></form></td><td id="side_data_s">'.$group_creator.'</td><td id="side_data_s">'.$group_authorized.'</td><td id="side_data_s">'.'</tr>';
            } 
        }
    }

    $users = do_admin_get_users();
    if(is_null($users))
    {
        $users_html = 'No users found!';
        $busers_html = 'No users found!';
    }
    else
    {
        $users_html = '';
        $busers_html = '';
        foreach($users as $things)
        {
            $authorized = $things[3];
            if($authorized == 1)
            {
                $email = $things[0];
                $first_name = $things[1];
                $last_name = $things[2];

                $users_html .= '<tr class="tr_clickable" id="goups_background"><td id="main_data">'. $email.'</td><td id="side_data_s">'. $first_name.
                                '</td><td id="side_data_s">'.$last_name.'</td><td id="side_data_s">'.'Unbanned'.'</td><td id="side_data_s">';
                $users_html .= '<td id="side_data_s"><form action="ban_user.php" method="post">
                                <input type="hidden" name="file_path" value="'.$email.'">
                                <input  class="banUser" type="submit" value="Ban User"></form></td>';
                $users_html .= '</tr>';
            }
            elseif ($authorized == 0) 
            {
                $email = $things[0];
                $first_name = $things[1];
                $last_name = $things[2];

                $busers_html .= '<tr class="tr_clickable" id="goups_background"><td id="main_data">'. $email.'</td><td id="side_data_s">'. $first_name.
                                '</td><td id="side_data_s">'.$last_name.'</td><td id="side_data_s">'.'Banned'.'</td><td id="side_data_s">';
                $busers_html .= '<td id="side_data_s"><form action="unban_user.php" method="post">
                                <input type="hidden" name="file_path" value="'.$email.'">
                                <input  class="unbanUser" type="submit" value="Unban User"></form></td>';
                $busers_html .= '</tr>';
            }
        }
    }
    /* Button stuff
    if($_SESSION['is_admin'] == 1)
    { 
        if($group_status == 1)
        {
            //Ban Button
            $files_html .= '<td id="side_data_s"><form action="delete_file.php" method="post"><input type="hidden" name="file_path" value="'.$files[2].'">
                        <input  class="deleteFile" type="submit" value="Delete File"></form></td>';
        }
        elseif ($group_status == 0) 
        {
            //Unban Button
        }
    }
    */
}
/*

Number of Threads
Number of Members
Creator

  */
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
<!--
<div class="col-lg-4">
  <div class="panel panel-default">
    <div class="panel-heading">All Groups</div>
    <div class="panel-body">
    <ul >
    <?=$groups_html ?>
    </ul>

    </div>
    </div> 
</div>
-->
<div class="col-lg-6">
  <div class="panel panel-default">
    <div class="panel-heading">All Groups</div>
    <div class="panel-body">
    <div class="scroll_table_files">
    <table id="goups_background">
        <thead>

        <tr class="tr_non_clickable"id="goups_background">
        <th id="main_data" style="background-color:#222;color:white;">
        Group Name

        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Creator
        </th>

        <th id="side_data_s" style="background-color:#222;color:white;">
        Status
        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Options
        </th>

        </tr>

        </thead>

        <tbody >
        <?=
            $groups_html;
            $bgroups_html;
         ?>
        </tbody>
        
    </table>
    </div>
    </div>
  </div> 
</div>

<div class="col-lg-6">
  <div class="panel panel-default">
    <div class="panel-heading">All Users</div>
    <div class="panel-body">
    <div class="scroll_table_files">
    <table id="goups_background">
        <thead>

        <tr class="tr_non_clickable"id="goups_background">
        <th id="main_data" style="background-color:#222;color:white;">
        Email

        </th>
        <th id="side_data_l" style="background-color:#222;color:white;">
        First Name
        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Last Name
        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Status
        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Options
        </th>

        </tr>

        </thead>

        <tbody >
        <?=
            $users_html; 
            $busers_html;
        ?>
        </tbody>
        
    </table>
    </div>
    </div>
  </div> 
</div>
<!--
<div class="col-lg-4">
  <div class="panel panel-default">
    <div class="panel-heading">Banned Users</div>
    <div class="panel-body">
    <div class="scroll_table_files">
    <table id="goups_background">
        <thead>

        <tr class="tr_non_clickable"id="goups_background">
        <th id="main_data" style="background-color:#222;color:white;">
        Email

        </th>
        <th id="side_data_l" style="background-color:#222;color:white;">
        First Name
        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Last Name
        </th>

        <th id="side_data_l" style="background-color:#222;color:white;">
        Options
        </th>
        </tr>

        </thead>

        <tbody >
        <?=$busers_html; ?>
        </tbody>
        
    </table>
    </div>
    </div>
  </div> 
</div>
-->
<!--
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

          <br><p>Ban Groups:</p>
          <form action="ban_group.php" method="post" enctype="multipart/form-data">
                <input type="text" name="group_id" maxlength="20">
                <input type="submit" name="submit" value="Ban Group">   
          </form>

          <br><p>Un-Ban Groups:</p>
          <form action="unban_group.php" method="post" enctype="multipart/form-data">
                <input type="text" name="group_id" maxlength="20">
                <input type="submit" name="submit" value="Un-Ban Group">     
          </form>
    </div>
    </div>
    </div>

    <div class="col-lg-4">
    <div class="panel panel-default">
    <div class="panel-heading">Ban Groups/Unban Groups</div>
    <div class="panel-body">
      
    </div>
    </div>

-->
</div>
</div>

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Inconsolata">

</body>
</html>
